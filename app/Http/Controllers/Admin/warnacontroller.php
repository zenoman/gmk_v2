<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class warnacontroller extends Controller
{
    public function index()
    {
        $webset = DB::table('settings')->limit(1)->get();
        $data = DB::table('tb_varian')->get();

        return view('warna/index',['data'=>$data,'websettings'=>$webset]);
    }
    public function create()
    {
       $webset = DB::table('settings')->limit(1)->get();
       return view('warna/create',['websettings'=>$webset]);
    }
    public function store(Request $request)
    {
        $rules = ['kode'      => 'unique:tb_varian,kode_v'];
        $customMessages = [
        'unique'  => 'Maaf, :attribute telah dipakai'];
        
        $this->validate($request,$rules,$customMessages);

        DB::table('tb_varian')
        ->insert([
            'kode_v'=>$request->kode,
            'varian'=>$request->label_warna,
            'hex'=>$request->hex
        ]);

        return redirect('warna')->with('status','data berhasil disimpan');

    }

    
    public function show($id)
    {
        $data = DB::table('tb_varian')->where('id',$id)->get();
        $webset = DB::table('settings')->limit(1)->get();

        return view('warna/edit',['data'=>$data,'websettings'=>$webset]);
    }
    public function update(Request $request, $id)
    {
        if($request->kode!=$request->kode2){
        $rules = ['kode'=> 'unique:tb_varian,kode_v'];
        $customMessages = [
        'unique'  => 'Maaf, :attribute telah dipakai'];
        
        $this->validate($request,$rules,$customMessages);
  
        }
       
        DB::table('tb_varian')
        ->where('id',$id)
        ->update([
            'kode_v'=>$request->kode,
            'varian'=>$request->label_warna,
            'hex'=>$request->hex
        ]);

        return redirect('warna')->with('status','data berhasil disimpan');
    }
    public function destroy($id)
    {
        DB::table('tb_varian')->where('id',$id)->delete();
        return redirect('warna')->with('status','data berhasil dihapus');
    }
}
