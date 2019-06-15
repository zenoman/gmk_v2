<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exports\omset;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class omsetcontroller extends Controller
{
    public function index()
    {	
    	if(Session::get('level') != 'admin'){
    	$webinfo = DB::table('settings')->limit(1)->get();
	 	$data = DB::table('omset')->get();
		return view('omset/index',['data'=>$data,'websettings'=>$webinfo]);
		 }else{
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak punya akses');
        }
	}

	//===========================================================
	public function exportomset(){
		return Excel::download(new omset(),"laporan_omset.xlsx");
	}
}
