<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //========================================================
    public function editprofil(){
        return view('home/editprofile');
    }
    
    //========================================================

    function cekomset(){
        $datasetting = DB::table('settings')->limit(1)->get();
        
        foreach($datasetting as $row){
        $bulanapps = $row->bulansistem;}

        if($bulanapps != date('m')){
            if(date('m')==1){
                $transaksionline = 
                $this->carijumlahtransaksionline($bulanapps,date('Y'),"ny");
                $transaksioffline = 
                $this->carijumlahtransaksioffline($bulanapps,date('Y'),"ny");
                $pemasukanlain =
                $this->caripemasukanlain($bulanapps,date('Y'),"ny");
                $pengeluaran = $this->caripengeluaran($bulanapps,date('Y'),"ny");
                if($transaksionline==''){
                    $transaksionline = 0;
                }else if($transaksioffline==''){
                    $transaksioffline=0;
                }else if($pemasukanlain==''){
                    $pemasukanlain=0;
                }else if($pengeluaran==''){
                    $pengeluaran=0;
                }
                $omset = $transaksionline + $transaksioffline + $pemasukanlain - $pengeluaran;
                DB::table('omset')
                ->insert([
                    'pemasukan_online'=>$transaksionline,
                    'pemasukan_offline'=>$transaksioffline,
                    'pemasukan_lain'=>$pemasukanlain,
                    'pengeluaran'=>$pengeluaran,
                    'omset'=>$omset,
                    'bulan'=>12,
                    'tahun'=>date('Y')-1
                ]);
            }else{
                $transaksionline = 
                $this->carijumlahtransaksionline($bulanapps,date('Y'),"y");
                $transaksioffline = 
                $this->carijumlahtransaksioffline($bulanapps,date('Y'),"y");
                $pemasukanlain =
                $this->caripemasukanlain($bulanapps,date('Y'),"y");
                $pengeluaran = $this->caripengeluaran($bulanapps,date('Y'),"y");
                if($transaksionline==''){
                    $transaksionline = 0;
                }else if($transaksioffline==''){
                    $transaksioffline=0;
                }else if($pemasukanlain==''){
                    $pemasukanlain=0;
                }else if($pengeluaran==''){
                    $pengeluaran=0;
                }
                $omset = $transaksionline + $transaksioffline + $pemasukanlain - $pengeluaran;
                DB::table('omset')
                ->insert([
                    'pemasukan_online'=>$transaksionline,
                    'pemasukan_offline'=>$transaksioffline,
                    'pemasukan_lain'=>$pemasukanlain,
                    'pengeluaran'=>$pengeluaran,
                    'omset'=>$omset,
                    'bulan'=>date('m')-1,
                    'tahun'=>date('Y')
                ]);
            }
            DB::table('settings')
            ->update([
                'bulansistem'=>date('m')
            ]);
        }

    }
    //=========================================================

    public function index()
    {
        $this->cekomset();
        $tgl = date('d-m-Y');
        
        $hapuslogcancel = DB::table('log_cancel')
        ->whereMonth('tgl','!=',date("m"))
        ->delete();

        $hapusdetailcancel = DB::table('detail_cancel')
        ->whereMonth('tgl','!=',date("m"))
        ->delete();

        $hapuscancelkeranjang = DB::table('keranjang_cancel')
        ->where('status','=','N')
        ->whereMonth('tgl','!=',date("m"))
        ->delete();
        
        $datakeranjang = DB::table('tb_details')
        ->whereNull('faktur')
        ->get();
        foreach ($datakeranjang as $row) {
            if($row->tgl_kadaluarsa < date('Y-m-d')){
                DB::table('keranjang_cancel')
                ->insert([
                    'tgl'=>date('Y-m-d'),
                    'idbarang'=>$row->idwarna,
                    'jumlah'=>$row->jumlah
                ]);
                DB::table('tb_details')->where('id',$row->id)->delete();
            }
        }
        $websetting = DB::table('settings')->limit(1)->get();
        return view('home/index',[
            'jumlahuser'=>$this->jumlahuser(),
            'jumlahstok'=>$this->jumlahstok(),
            'jumlahtransaksi' =>$this->jumlahtransaksi(),
            'jumlahtransaksig'=>$this->jumlahtransaksig(),
            'websettings'=>$websetting
        ]);
    }
    //===========================================================
    function jumlahuser(){
        $jumlah = DB::table('tb_users')->count();
        return $jumlah;
    }

    //===========================================================
    function jumlahtransaksi(){
        $bulan = date('m');
        $jumlah = DB::table('tb_transaksis')->where('tgl','like','%'.$bulan.'%')->count();
        return $jumlah;
    }

    //===========================================================
    function jumlahtransaksig(){
        $bulan = date('m');
        $jumlah = DB::table('log_cancel')->where('bulan',$bulan)->count();
        return $jumlah;
    }

    //===========================================================
    function jumlahstok(){
        $jumlah = DB::table('tb_barangs')->sum('stok');
        return $jumlah;
    }

    //===========================================================
    function carijumlahtransaksionline($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('tb_transaksis')
        ->select(DB::raw('SUM(total_akhir) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('status','sukses')
        ->orwhere('status','diterima')
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }

    //===========================================================
    function carijumlahtransaksioffline($bulan,$tahun,$status){
         if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('tb_transaksis')
        ->select(DB::raw('SUM(total_akhir) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('metode','langsung')
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }

    //===========================================================
    function caripemasukanlain($bulan,$tahun,$status){
         if($status=="ny"){ $tahun -=1; }
        $data = DB::table('tb_tambahstoks')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('aksi','kurangi')
        ->get();
        foreach ($data as $row){
            $newdata = $row->totalnya;
        }
        return $newdata;
    }

    //===========================================================
    function caripengeluaran($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('tb_tambahstoks')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('aksi','tambah')
        ->get();
        foreach ($data as $row){
            $newdata = $row->totalnya;
        }
        return $newdata;
    }

    //===========================================================
    public function cektransaksi(){
        $transaksi = DB::table('tb_transaksis')
                    ->select(DB::raw('tb_transaksis.*,tb_users.username'))
                    ->join('tb_users','tb_transaksis.iduser','=','tb_users.id')
                    ->where([['tb_transaksis.status','=','terkirim'],['tb_transaksis.metode','=','pesan']])
                    ->get();
        return response()->json($transaksi);
    }

    //============================================================
    public function updatetransaksi($id){
       DB::table('tb_transaksis')
        ->where('id',$id)
        ->update([
            'status'=>'dibaca'
        ]);
    }

    //============================================================
    public function cekbar(){
        $transaksi = DB::table('tb_transaksis')
                    ->select(DB::raw('tb_transaksis.*,tb_users.username'))
                    ->join('tb_users','tb_transaksis.iduser','=','tb_users.id')
                    ->where([
                        ['tb_transaksis.status','=','terkirim']
                        ,['tb_transaksis.metode','=','pesan']])
                    ->orwhere([['tb_transaksis.status','=','dibaca']
                        ,['tb_transaksis.metode','=','pesan']])
                    ->limit(10)
                    ->get();
        return response()->json($transaksi);
    }
    
}
