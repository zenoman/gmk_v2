<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class pembelianlangsung extends Controller
{
    public function carivariasi($kode){
         $data = DB::table('tb_barangs')
                ->select(DB::raw('tb_barangs.kode,tb_barangs.kode_v,tb_varian.varian'))
                ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
                ->distinct()
                ->where('tb_barangs.kode','=',$kode)
                ->get();
        return response()->json($data);
    }
    public function tampil(){
    	$webinfo = DB::table('settings')->limit(1)->get();
    	return view('transaksilangsung/index',['websettings'=>$webinfo]);
    }
    public function carikode(){
        $tanggal  = date('dmy');
        $kodeuser = sprintf("%02s",session::get('iduser'));
        $lastuser = $tanggal."-".$kodeuser;
        //---------------------------------------------------
        $kode = DB::table('tb_transaksis')
        ->where([
            ['admin','=',$kodeuser],
            ['metode','=','langsung'],
            ['total_akhir','=',null]])
        ->max('faktur');
        //--------------------------------------------------
        if(!$kode){
            $caridata = DB::table('tb_transaksis')
            ->where('faktur','like','%'.$tanggal."-".$kodeuser.'%')
            ->max('faktur');
           
                if(!$caridata){
                    $finalkode = "STA".$tanggal."-".$kodeuser."-000001";
                }else{
                    $newkode    = explode("-", $caridata);
                    $nomer      = sprintf("%06s",$newkode[2]+1);
                    $finalkode  = "STA".$tanggal."-".$kodeuser."-".$nomer;
                }
        }else{
            $caridata = DB::table('tb_transaksis')
            ->where('faktur',$kode)
            ->limit(1)
            ->get();
            //-----------------------------------------------
            foreach ($caridata as $row) {
                if($row->total_akhir==''){
                    $finalkode = $row->faktur;
                }else{
                    $newkode    = explode("-", $kode);
                    $nomer      = sprintf("%06s",$newkode[2]+1);
                    $finalkode  = "STA".$tanggal."-".$kodeuser."-".$nomer;
                }
            }
            
        }
        return response()->json($finalkode);
    }

    public function caribarang(Request $request){
        if($request->has('q')){
        $cari = $request->q;
        $data = DB::table('tb_kodes')
                ->select('barang','kode_barang')
                ->where([['barang','like','%'.$cari.'%'],['tampil','=','Y']])
                ->orwhere([['kode_barang','like','%'.$cari.'%'],['tampil','=','Y']])
                ->get();
        return response()->json($data);
        }
    }
    public function carihasilbarang($kode){
         $data = DB::table('tb_kodes')
                    ->where('kode_barang',$kode)
                    ->get();
            
        return response()->json($data);
    }
    public function cariwarna($kode,$kodewarna){
        $data = DB::table('tb_barangs')
                ->select('idbarang','warna','stok')
                ->where([['kode','=',$kode],['kode_v','=',$kodewarna]])
                ->get();
        return response()->json($data);
    }

    public function tambahdetail(Request $request){
        $kode = $request->faktur;
        $carikode = 
        DB::table('tb_transaksis')->where('faktur',$kode)
        ->count();
        if($carikode > 0){
        }else{
            DB::table('tb_transaksis')
            ->insert([
                'faktur' => $kode,
                'tgl'  => date('Y-m-d'),
                'metode'=>'langsung',
                'admin'=>session::get('iduser')
            ]);
        }
         $websetting = DB::table('settings')->limit(1)->get();
        foreach ($websetting as $ws) {
            $day = date("d")+$ws->max_tgl;
        }
         DB::table('tb_details')
            ->insert([
                'faktur'=>$request->faktur,
                'idwarna'=>$request->idwarna,
                'tgl'=>date("Y-m-d"),
                'tgl_kadaluarsa'=>date("Y")."-".date("m")."-".$day,
                'kode_barang'=>$request->kodebarang,
                'barang'=>$request->barang." ".$request->ukuran,
                'harga'=>$request->harga,
                'jumlah'=>$request->jumlah,
                'total_a'=>$request->totalawal,
                'diskon'=>$request->diskon,
                'total'=>$request->total,
                'admin'=>session::get('iduser'),
                'kode_v'=>$request->kode_v,
                'metode'=>"langsung"
            ]);
    }

    public function caridetailbarang($kode){
         $data = DB::table('tb_details')
         ->select(DB::raw('tb_details.*,tb_barangs.warna,tb_varian.varian'))
         ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_details.idwarna')
         ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
         ->where('tb_details.faktur',$kode)
         ->get();
        return response()->json($data);
    }

    public function hapusdetailbarang($id){
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
    }

    public function simpan(Request $request){
        $faktur = $request->faktur;
        $total = $request->total;

        $caridata = DB::table('tb_transaksis')
        ->where('faktur',$faktur)
        ->count();
        if($caridata > 0){
            DB::table('tb_transaksis')
            ->where('faktur',$faktur)
            ->update([
                'potongan'=>$request->potongan,
                'total'=>$total,
                'total_akhir'=>$request->total_akhir,
                'tgl'=>date('Y-m-d')
            ]);
        }else{
            DB::table('tb_transaksis')
            ->insert([
                'faktur' => $faktur,
                'tgl'  => date('Y-m-d'),
                'metode'=>'langsung',
                'admin'=>session::get('iduser'),
                'potongan'=>$request->potongan,
                'total'=>$total,
                'total_akhir'=>$request->total_akhir
            ]);
        }
    }

    public function list(){
        $webinfo = DB::table('settings')->limit(1)->get();
        $data = DB::table('tb_transaksis')
        ->select(DB::raw('tb_transaksis.*,admins.username'))
        ->leftjoin('admins','admins.id','=','tb_transaksis.admin')
        ->where('tb_transaksis.metode','langsung')
        ->orderby('tb_transaksis.id','desc')
        ->paginate(30);
        return view('transaksilangsung/list',['websettings'=>$webinfo,'data'=>$data]);
    }
    public function caritransaksi($kode){
        $data = DB::table('tb_details')
        ->select(DB::raw('tb_details.*,tb_varian.varian'))
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_details.kode_v')
        ->where('tb_details.faktur',$kode)
        ->get();
        return response()->json($data);
    }
}