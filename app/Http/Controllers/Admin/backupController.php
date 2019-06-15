<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class backupController extends Controller
{
    public function index(){
        if(Session::get('level') != 'admin'){
    	$webinfo = DB::table('settings')->limit(1)->get();
    	return view('backup/index',['websettings'=>$webinfo]);
        }else{
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak punya akses');
        }
    }
    //===================================================
    public function tampil(Request $request){
    	$bulan = $request->bulan;
    	$tahun = $request->tahun;

        $totalpengeluaran = DB::table('tb_tambahstoks')
        ->where('aksi','tambah')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->count();
        $totalpemasukan = DB::table('tb_transaksis')
        ->whereMonth('tb_transaksis.tgl',$bulan)
        ->whereYear('tb_transaksis.tgl',$tahun)
        ->where('tb_transaksis.status','sukses')
        ->orwhere('tb_transaksis.status','diterima')
        ->count();
        $totaldetailpemasukan = DB::table('tb_details')
        ->whereNotNull('faktur')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->count();
        $totalpemasukanlain = DB::table('tb_tambahstoks')
        ->where('aksi','kurangi')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->count();
        $totaltransaksilangsung = DB::table('tb_transaksis')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('metode','langsung')
        ->count();
        $totaldetailtransaksi = DB::table('tb_details')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('metode','langsung')
        ->count();
        $totalcancel = DB::table('keranjang_cancel')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('status','=','Y')
        ->count();
    	$webinfo = DB::table('settings')->limit(1)->get();

    	return view('backup/tampil',[
            'websettings'=>$webinfo,
            'bulan'=>$bulan,
            'tahun'=>$tahun,
            'totalpemasukan'=>$totalpemasukan,
            'totalpengeluaran'=>$totalpengeluaran,
            'totalpemasukanlain'=>$totalpemasukanlain,
            'totaldetailpemasukan'=>$totaldetailpemasukan,
            'totaltransaksi'=>$totaltransaksilangsung,
            'totaldetailtransaksi'=>$totaldetailtransaksi,
            'totalcancel'=>$totalcancel
        ]);
    }
    //==========================================================
    public function hapuspengeluaran($bulan,$tahun){
        DB::table('tb_tambahstoks')
        ->where('tb_tambahstoks.aksi','tambah')
        ->whereMonth('tb_tambahstoks.tgl',$bulan)
        ->whereYear('tb_tambahstoks.tgl',$tahun)
        ->delete();
        return back()->with('status','Data Pengeluaran Berhasil Dihapus');
    }
    public function hapuspemasukan($bulan,$tahun){
         DB::table('tb_transaksis')
        ->whereMonth('tb_transaksis.tgl',$bulan)
        ->whereYear('tb_transaksis.tgl',$tahun)
        ->where('tb_transaksis.status','sukses')
        ->orwhere('tb_transaksis.status','diterima')
        ->delete();

        return back()->with('status','Data Pemasukan Berhasil Dihapus');
    }
    public function hapusdetailpemasukan($bulan,$tahun){
        DB::table('tb_details')
        ->whereMonth('tb_details.tgl',$bulan)
        ->whereYear('tb_details.tgl',$tahun)
        ->delete();
 
        return back()->with('status','Data Detail Pemasukan Berhasil Dihapus');
    }

    public function hapuspemasukanlain($bulan,$tahun){
        DB::table('tb_tambahstoks')
        ->where('tb_tambahstoks.aksi','kurangi')
        ->whereMonth('tb_tambahstoks.tgl',$bulan)
        ->whereYear('tb_tambahstoks.tgl',$tahun)
        ->delete();
        return back()->with('status','Data Pemasukan Lain Berhasil Dihapus');
    }
    public function hapustransaksilangsung($bulan,$tahun){
         DB::table('tb_transaksis')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('metode','langsung')
        ->delete();

        return back()->with('status','Data Transaksi Langsung Berhasil Dihapus');
    }

    public function hapusdetailtransaksilangsung($bulan,$tahun){
        DB::table('tb_details')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('metode','langsung')
        ->delete();

        return back()->with('status','Data Detail Transaksi Langsung Berhasil Dihapus');
    }
    public function hapusdetailcancel($bulan,$tahun){
        DB::table('keranjang_cancel')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->where('status','Y')
        ->delete();

        return back()->with('status','Data List Cancel Berhasil Dihapus');
    }
}
