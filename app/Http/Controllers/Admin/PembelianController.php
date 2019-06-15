<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PembelianController extends Controller
{
    public function cetaklisttolak(Request $request){
        $tanggal = explode('-',$request->bulan);
        $bln = $tanggal[0];
        $thn = $tanggal[1];

        $datacancel = DB::table('keranjang_cancel')
        ->select(DB::raw('keranjang_cancel.*, tb_barangs.barang_jenis, admins.username'))
        ->leftJoin('tb_barangs','tb_barangs.idbarang','=','keranjang_cancel.idbarang')
        ->leftjoin('admins','admins.id','=','keranjang_cancel.admin')
        ->whereMonth('keranjang_cancel.tgl',$bln)
        ->whereYear('keranjang_cancel.tgl',$thn)
        ->where('keranjang_cancel.status','Y')
        ->orderby('keranjang_cancel.id','desc')
        ->get();

        $totalnya = DB::table('keranjang_cancel')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->whereMonth('keranjang_cancel.tgl',$bln)
        ->whereYear('keranjang_cancel.tgl',$thn)
        ->where('keranjang_cancel.status','Y')
        ->get();

        return view('/pembelian/cetakcancel',['data'=>$datacancel,'databulan'=>$bln,'datatahun'=>$thn,'total'=>$totalnya]);
    }
    //===============================================================
    public function index(){
        $websetting = DB::table('settings')->limit(1)->get();
        $pembelians = DB::table('tb_transaksis')
                    ->select(DB::raw('tb_transaksis.*,tb_users.username,tb_users.telp,tb_bank.nama_bank'))
                    ->leftjoin('tb_users','tb_transaksis.iduser','=','tb_users.id')
                    ->leftjoin('tb_bank','tb_transaksis.pembayaran','=','tb_bank.id')
                    ->where('tb_transaksis.metode','pesan')
                    ->orderby('tb_transaksis.id','desc')
                    ->paginate(40);
        return view('pembelian/index',['pembelians'=>$pembelians,'websettings'=>$websetting]);
    }
    //==========================================================
    public function terima(Request $request){
        $id         = $request->kode;
        $idadmin    = $request->admin;
        $total      = 
        $request->total + $request->ongkir - $request->potongan;
        $ongkir     = $request->ongkir;
        $subtotal   = $request->total;
        DB::table('tb_transaksis')
        ->where('id',$id)
        ->update([
            'total'=>$subtotal,
            'potongan'=>$request->potongan,
            'status'=>'diterima',
            'total_akhir'=>$total,
            'ongkir'=>$ongkir
        ]);
        return back()->with('status','Pembelian Diterima');
    }

    public function tolak(Request $request){
        $kode = $request->kode;
        $iduser = $request->iduser;
        $keterangan = $request->keterangan;
        //-----------------------------------------------------
        $maxkode = DB::table('log_cancel')->max('faktur');
        if($maxkode != NULL){
            $numkode = substr($maxkode, 6);
            $countkode = $numkode+1;
            $newkode = "Cancel".sprintf("%05s", $countkode);
        }else{
            $newkode = "Cancel00001";
        }
        //-----------------------------------------------------
        $transaksi = DB::table('tb_transaksis')
        ->where('id',$kode)
        ->get();
        foreach ($transaksi as $row) {
            DB::table('log_cancel')
            ->insert([
                'faktur'=>$newkode,
                'total_akhir'=>$row->total,
                'tgl'=>date("Y-m-d"),
                'bulan'=>date("m"),
                'status'=>'ditolak',
                'id_user'=>$row->iduser,
                'id_admin'=>$iduser,
                'keterangan'=>$keterangan
            ]);
            $caridetail = DB::table('tb_details')
            ->where('faktur',$row->faktur)
            ->get();
            foreach ($caridetail as $cdl) {
                DB::table('detail_cancel')
                ->insert([
                'idwarna'=>$cdl->idwarna,
                'iduser'=>$cdl->iduser,
                'kode'=>$newkode,
                'tgl'=>$cdl->tgl,
                'jumlah'=>$cdl->jumlah,
                'harga'=>$cdl->harga,
                'barang'=>$cdl->barang,
                'total'=>$cdl->total,
                'diskon'=>$cdl->diskon
                ]);
            }
            DB::table('tb_details')->where('faktur',$row->faktur)->delete();
            DB::table('tb_transaksis')->where('id',$kode)->delete();
        }
       return back()->with('status','Pembelian Ditolak');
    }
    //=========================================================
    
    public function listtolak(){
        $websetting = DB::table('settings')->limit(1)->get();

        $cancels = DB::table('log_cancel')
                    ->select(DB::raw('log_cancel.*,tb_users.username,tb_users.telp'))
                    ->leftjoin('tb_users','log_cancel.id_user','=','tb_users.id')
                    ->orderby('log_cancel.id','desc')
                    ->paginate(40);
        return view('pembelian/listcancel',['cancels'=>$cancels,'websettings'=>$websetting]);
    }
    //========================================================
    public function listcancel(){
        $websetting = DB::table('settings')->limit(1)->get();
        
        $datatgl = DB::table('keranjang_cancel')
        ->select(DB::raw('MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
        ->where('status','Y')
        ->groupby('bulan')
        ->groupby('tahun')
        ->orderby('tgl','desc')
        ->get();

        $data = DB::table('keranjang_cancel')
        ->select(DB::raw('keranjang_cancel.*,tb_barangs.barang_jenis,admins.username'))
        ->leftjoin('tb_barangs','tb_barangs.idbarang','=','keranjang_cancel.idbarang')
        ->leftjoin('admins','admins.id','=','keranjang_cancel.admin')
        ->where('keranjang_cancel.status','Y')
        ->paginate(20);

        return view('pembelian/cancelbarang',['listcancel'=>$data,'websettings'=>$websetting,'datatgl'=>$datatgl]);
    }
    //===========================================================
    public function aksitambahcacel(Request $request){
        $databarang = explode('-',$request->caribarang);
        $namabarang = $databarang[0];
        $kodebarang = $databarang[1];

        $datanya = DB::table('tb_kodes')->where('kode_barang',$kodebarang)->get();
        foreach($datanya as $row){
            $harga = $row->harga_barang;
        }
        DB::table('keranjang_cancel')
        ->insert([
            'tgl'=>date('Y-m-d'),
            'idbarang'=>$databarang[2],
            'jumlah'=>$request->jumlah,
            'harga'=>$harga,
            'total'=>$request->jumlah*$harga,
            'admin'=>Session::get('iduser'),
            'status'=>'Y'
        ]);
        return redirect('/pembelian/listcancel')->with('status','Berhasil Menambahkan Data'); 
    }
    //=========================================================
    public function tambah(){
        $webset = DB::table('settings')->limit(1)->get();

        $barang= DB::table('tb_barangs')->get();
        return view('pembelian/tambahcancel',['websettings'=>$webset,'barangs'=>$barang]);
    }
    //==========================================================
    
    public function sukses($id){
        DB::table('tb_transaksis')
        ->where('id',$id)
        ->update(['status'=>'sukses']);
        
       return back()->with('status','Pembelian Sukses');
    }
    //=========================================================
    public function hapus($id){
        DB::table('tb_details')->where('faktur',$id)->delete();
        DB::table('tb_transaksis')->where('faktur',$id)->delete();
        return back()->with('status','Data Berhasil Dihapus');
    }
    //==========================================================
    public function detail($id){
        $kode = DB::table('tb_transaksis')
        ->select(DB::raw('tb_transaksis.*,tb_users.telp'))
        ->leftjoin('tb_users','tb_users.id','=','tb_transaksis.iduser')
        ->where('tb_transaksis.id',$id)
        ->limit(1)
        ->get();
        foreach ($kode as $row) {
            $kodenya = $row->faktur;
        }
        $data = DB::table('tb_details')
        ->select(DB::raw('tb_details.*,tb_varian.varian'))
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_details.kode_v')
        ->where('tb_details.faktur',$kodenya)
        ->get();
         $websetting = DB::table('settings')->limit(1)->get();
         return view('pembelian/detail',['kode'=>$kode,'data'=>$data,'websettings'=>$websetting]);
    }
}
