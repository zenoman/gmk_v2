<?php

namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Catalogcontroller extends Controller
{
    public function unduh($nama){
        $file = public_path().'/img/barang/'.$nama;
        return response()->download($file);
    }
    //==============================================
    public function detailartikel($judul){
    $websetting = DB::table('settings')->limit(1)->get();
       $artikel = DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,kategori_artikel.nama'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->where('tb_artikel.link','=',$judul)
        ->orderby('tb_artikel.id','desc')
        ->get();
        $dataartikel = DB::table('tb_artikel')->where('link',$judul)->get();
        foreach ($dataartikel as $row) {
            $dilihat = $row->dilihat + 1;
            DB::table('tb_artikel')
            ->where('link',$judul)
            ->update([
                'dilihat'=>$dilihat
            ]);
        }
        $kategori = DB::table('kategori_artikel')->where('id','!=',4)->get();
       return view('frontend/detailartikel',['artikel'=>$artikel,'websettings'=>$websetting,'kategori'=>$kategori]);
    }
    //============================================================================
    public function artikel()
    {
       $websetting = DB::table('settings')->limit(1)->get();
       $artikel = DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,kategori_artikel.nama'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->where('tb_artikel.id_kategori','!=',4)
        ->orderby('tb_artikel.id','desc')
        ->paginate(8);
        $kategori = DB::table('kategori_artikel')->where('id','!=',4)->get();
       return view('frontend/artikel',['artikel'=>$artikel,'websettings'=>$websetting,'kategori'=>$kategori]);
    }
    //============================================================================
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
        $kategori = DB::table('tb_kategoris')->get();

    	return view('frontend/semuaproduk',['barangs'=>$barangs,'kategoris'=>$kategori,'websettings'=>$websetting]);
    }
    //============================================================================
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
    //============================================================================
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
    //============================================================================
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

    //===============================================================
    function kategoriartikel($id){
        $websetting = DB::table('settings')->limit(1)->get();
       $artikel = DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,kategori_artikel.nama'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->where('tb_artikel.id_kategori','=',$id)
        ->orderby('tb_artikel.id','desc')
        ->get();
        $kategorinama = DB::table('kategori_artikel')->where('id',$id)->get();
        $kategori = DB::table('kategori_artikel')->get();
       return view('frontend/kategoriartikel',['artikel'=>$artikel,'websettings'=>$websetting,'kategori'=>$kategori,'kategorinama'=>$kategorinama]);
    }
    //=======================================================================
    function testimoni(){
         $websetting = DB::table('settings')->limit(1)->get();
       $artikel = DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,kategori_artikel.nama'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->where('tb_artikel.id_kategori','=',4)
        ->orderby('tb_artikel.id','desc')
        ->paginate(8);
       return view('frontend/testimoni',['artikel'=>$artikel,'websettings'=>$websetting]); 
    }

    function carabelanja(){
         $websetting = DB::table('settings')->limit(1)->get();
         return view('frontend/carabelanja',['websettings'=>$websetting]); 
    }

}
