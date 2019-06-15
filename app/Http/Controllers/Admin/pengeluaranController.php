<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pengeluaranController extends Controller
{
    public function index(){
    	$webinfo = DB::table('settings')->limit(1)->get();
    	$data = DB::table('tb_tambahstoks')
        ->select(DB::raw('tb_tambahstoks.*,admins.username,tb_barangs.barang_jenis,tb_kodes.harga_beli,tb_varian.varian'))
        ->leftjoin('admins','admins.id','=','tb_tambahstoks.idadmin')
        ->leftjoin('tb_barangs','tb_barangs.idbarang','=','tb_tambahstoks.idwarna')
        ->leftjoin('tb_kodes','tb_kodes.kode_barang','=','tb_tambahstoks.kode_barang')
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
        ->where('tb_tambahstoks.aksi','tambah')
        ->orderby('tb_tambahstoks.id','desc')
        ->paginate(40);
    	return view('pengeluaran/index',['websettings'=>$webinfo,'data'=>$data]);
    }
}
