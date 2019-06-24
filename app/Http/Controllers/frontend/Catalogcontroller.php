<?php

namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Catalogcontroller extends Controller
{
    public function index(){
        $websetting = DB::table('settings')->limit(1)->get();
    	$barangs = DB::table('tb_kodes')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->where('tb_kodes.tampil','=','Y')
            ->groupBy('tb_kodes.kode_barang')
            ->orderby('tb_kodes.id','desc')
            ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
            ->paginate(15);
        $totalkeranjang = DB::table('tb_details')
        ->where([['iduser',Session::get('user_id')],['faktur',null]])
        ->count();

        $totalbayar = DB::table('tb_details')
                        ->select(DB::raw('SUM(total) as newtotal'))
                        ->where([['iduser',Session::get('user_id')],['faktur',null]])
                        ->get();
        $kategori = DB::table('tb_kategoris')->get();
    	return view('frontend/semuaproduk',['barangs'=>$barangs,'kategoris'=>$kategori,'websettings'=>$websetting,'totalkeranjang'=>$totalkeranjang,'totalbayar'=>$totalbayar]);
    }

    public function keranjang(){
        $barangs =  DB::table('tb_details')
                    ->select('tb_details.*','tb_kodes.id as idkode','tb_kodes.diskon','tb_varian.varian')
                    ->leftjoin('tb_kodes','tb_details.kode_barang','=','tb_kodes.kode_barang')
                    ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_details.kode_v')
                    ->where([['tb_details.iduser',Session::get('user_id')],['tb_details.faktur',null]])
                    ->get();

        $subtotal = DB::table('tb_details')
                    ->select(DB::raw('SUM(total) as total'))
                   ->where([['tb_details.iduser',Session::get('user_id')],['tb_details.faktur',null]])
                    ->get();
        $jumlah = DB::table('tb_details')->where([['iduser',Session::get('user_id')],['faktur',null]])->count();
        //dd($jumlah);
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/listkeranjang',['websettings'=>$websetting,'barangs'=>$barangs,'subtotal'=>$subtotal,'jumlah'=>$jumlah]);
    }

    public function show($id){
        $websetting = DB::table('settings')->limit(1)->get();
        $barangs = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->groupBy('tb_kodes.kode_barang')
            ->orderby('tb_kodes.id','desc')
            ->where([['tb_kodes.id',$id],['tb_kodes.tampil','=','Y']])
            ->get();
        $baranglain = DB::table('tb_kodes')
            ->select(DB::raw('tb_kodes.*,tb_kategoris.kategori'))
            ->leftjoin('tb_kategoris','tb_kategoris.id','=','tb_kodes.id_kategori')
            ->inRandomOrder()
            ->limit(3)
            ->get();
        return view('frontend/singleproduk',['baranglain'=>$baranglain,'databarang'=>$barangs,'websettings'=>$websetting]);
    }

    public function masukkeranjang(Request $request)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        foreach ($websetting as $ws){
            $day =  date('Y-m-d', strtotime(' + '.$ws->max_tgl.' days'));
        }

        $datawarna = explode("-", $request->warna);
        $cariwarnas = DB::table('tb_barangs')
                    ->where('idbarang',$datawarna[0])
                    ->get();
        
        foreach ($cariwarnas as $warna) {
           $stokterkini = $warna->stok;
        
        if ($stokterkini<$datawarna[1]) {
            return back()->with('error','Maaf, Stok telah di update silahkan ulangi pemesanan anda');
        }else{
            $caribarang = DB::table('tb_kodes')
                        ->where('kode_barang',$request->kode_barang)
                        ->get();
            foreach ($caribarang as $barang){
                    $nama = $barang->barang;
                    if(Session::get('user_level')=='reseller'){
                        $harga = $barang->harga_reseller;
                    }else{
                        $harga = $barang->harga_barang; 
                    }
                    $diskon = $barang->diskon;
            }
            if(Session::get('user_level')=='reseller'){
                $harga_total = $harga;
            }else{
                $totaldiskon = $diskon/100*$request->jumlah*$harga;
                $harga_total = ($harga*$request->jumlah)-$totaldiskon;
            }             
            DB::table('tb_details')
            ->insert([
                'idwarna'=>$datawarna[0],
                'iduser'=>Session::get('user_id'),
                'tgl'=>date("Y-m-d"),
                'tgl_kadaluarsa'=>$day,
                'kode_barang'=>$request->kode_barang,
                'barang'=>$warna->barang_jenis,
                'harga'=>$harga,
                'jumlah'=>$request->jumlah,
                'total_a'=>($request->jumlah*$harga),
                'diskon'=>$diskon,
                'total'=>$harga_total,
                'metode'=>"pesan",
                'kode_v'=>$request->varian
            ]);
            return back();
        }
    }
    }
    public function tolak(Request $request){
        $kode = $request->kode;
        $iduser = $request->iduser;
        $keterangan = $request->keterangan;

        $maxkode = DB::table('log_cancel')->max('faktur');
        if($maxkode != NULL){
            $numkode = substr($maxkode, 6);
            $countkode = $numkode+1;
            $newkode = "Cancel".sprintf("%05s", $countkode);
        }else{
            $newkode = "Cancel00001";
        }

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
                'status'=>'dicancel',
                'id_user'=>$iduser,
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
        $datauser = DB::table('tb_users')
        ->where('id',Session::get('user_id'))
        ->get();
        foreach ($datauser as $usr) {
            $jumlahcancel = $usr->cancel+1;
            DB::table('tb_users')
            ->where('id',Session::get('user_id'))
            ->update(['cancel'=>$jumlahcancel]);
        }
        if($jumlahcancel >= 3){
            return redirect('/login/logoutuser');
        }else{

           return back();
        }
    }

    public function transaksi(){
        $datauser = DB::table('tb_users')
                    ->where('id',Session::get('user_id'))
                    ->get();

        $barangs = DB::table('tb_details')
                    ->select(DB::raw('tb_details.*,tb_kodes.barang'))
                    ->join('tb_kodes','tb_details.kode_barang','=','tb_kodes.kode_barang')
                    ->where([['tb_details.iduser',Session::get('user_id')],['tb_details.faktur',null]])
                    ->get();

        $subtotal = DB::table('tb_details')
                    ->select(DB::raw('SUM(total) as total'))
                   ->where([['tb_details.iduser',Session::get('user_id')],['tb_details.faktur',null]])
                    ->get();
        $jumlahbarang = DB::table('tb_details')
                        ->where([['tb_details.iduser',Session::get('user_id')],['tb_details.faktur',null]])
                        ->count();
        $rekening = DB::table('tb_bank')->get();
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/transaksi',['websettings'=>$websetting,'barangs'=>$barangs,'subtotal'=>$subtotal,'datauser'=>$datauser,'rekening'=>$rekening,'jumlah'=>$jumlahbarang]);
    }

    public function hapuskeranjang($id){
        $databarang = DB::table('tb_details')
        ->where('id',$id)
        ->get();

        foreach ($databarang as $row) {
        DB::table('keranjang_cancel')
        ->insert([
            'tgl'=>date('Y-m-d'),
            'idbarang'=>$row->idwarna,
            'jumlah'=>$row->jumlah
        ]);
        
        DB::table('tb_details')->where('id',$id)->delete();
        }
        return back();
    }

    public function aksibeli(Request $request){
        $tanggalsekarang = date('dmy');
        $iduser     = Session::get('user_id');
        $kode = DB::table('tb_transaksis')
        ->where([['faktur','like','%'.$tanggalsekarang.'%'],['metode','=','pesan']])
        ->max('faktur');
        if($kode != NULL){
            $numkode = substr($kode, 8);
            $countkode = $numkode+1;
            $newkode = "ST".$tanggalsekarang.sprintf("%05s", $countkode);
        }else{
            $newkode = "ST".$tanggalsekarang."00001";
        }
        $tgl = date("Y-m-d");
        $total = $request->total;
        $alamat = $request->alamat;
        $pembayaran = $request->pembayaran;
        $keterangan = $request->keterangan;

        DB::table('tb_transaksis')
        ->insert([
            'iduser'=>$iduser,
            'faktur'=>$newkode,
            'tgl'=>$tgl,
            'total'=>$total,
            'status'=>'terkirim',
            'alamat_tujuan'=>$alamat,
            'keterangan'=>$keterangan,
            'pembayaran'=>$pembayaran
        ]);
        DB::table('tb_details')
        ->where([['iduser',Session::get('user_id')],['faktur',null]])
        ->update([
            'faktur'=>$newkode
        ]);

         return redirect('transaksisaya');
    }
    public function caribarang(Request $request){
        $websetting = DB::table('settings')->limit(1)->get();
        $barangs = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->where([['tb_kodes.barang','like','%'.$request->cari.'%'],['tb_kodes.tampil','=','Y']])
            ->groupBy('tb_kodes.kode_barang')
            ->orderby('tb_kodes.id','desc')
            ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
            ->get();
        $totalkeranjang = DB::table('tb_details')
        ->where([['iduser',Session::get('user_id')],['faktur',null]])
        ->count();

        $totalbayar = DB::table('tb_details')
                        ->select(DB::raw('SUM(total) as newtotal'))
                        ->where([['iduser',Session::get('user_id')],['faktur',null]])
                        ->get();
         $kategori = DB::table('tb_kategoris')->get();
        return view('frontend/hasilcari',['websettings'=>$websetting,'barangs'=>$barangs,'kategoris'=>$kategori,'websettings'=>$websetting,'totalkeranjang'=>$totalkeranjang,'totalbayar'=>$totalbayar,'status'=>'nama','keynya'=>$request->cari]);
    }
    public function transaksisaya(){
        $transaksi = DB::table('tb_transaksis')->where('iduser',Session::get('user_id'))->paginate(15);
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/transaksisaya',['websettings'=>$websetting,'transaksis'=>$transaksi]);
    }

    public function transaksigagal(){
        $transaksi = DB::table('log_cancel')->where('id_user',Session::get('user_id'))->paginate(15);
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/transaksibatal',['websettings'=>$websetting,'transaksis'=>$transaksi]);
    }

    public function kategori($id){
        $kat = DB::table('tb_kategoris')->where('id',$id)->get();
        $websetting = DB::table('settings')->limit(1)->get();
        $barangs = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->where([['tb_kodes.id_kategori',$id],['tb_kodes.tampil','=','Y']])
            ->groupBy('tb_kodes.kode_barang')
            ->orderby('tb_kodes.id','desc')
            ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
            ->get();
        $totalkeranjang = DB::table('tb_details')
        ->where([['iduser',Session::get('user_id')],['faktur',null]])
        ->count();

        $totalbayar = DB::table('tb_details')
                        ->select(DB::raw('SUM(total) as newtotal'))
                        ->where([['iduser',Session::get('user_id')],['faktur',null]])
                        ->get();

        $kategori = DB::table('tb_kategoris')->get();
        
        return view('frontend/tampilkategor',['websettings'=>$websetting,'barangs'=>$barangs,'kategoris'=>$kategori,'websettings'=>$websetting,'totalkeranjang'=>$totalkeranjang,'totalbayar'=>$totalbayar,'kat'=>$kat]);
    }
}
