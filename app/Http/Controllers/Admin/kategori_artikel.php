<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class kategori_artikel extends Controller
{
   public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $kategori = DB::table('kategori_artikel')->get();
        return view('artikel/indexkat',['kategori'=>$kategori,'websettings'=>$websetting]);

    }

    public function store(Request $request)
    {
        DB::table('kategori_artikel')
        ->insert([
            'nama'=>$request->nama
        ]);

        return redirect('kategori-artikel')->with('status','data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        DB::table('kategori_artikel')
        ->where('id','=',$id)
        ->update([
            'nama'=>$request->nama
        ]);
        return redirect('kategori-artikel')->with('status','data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         DB::table('kategori_artikel')->where('id',$id)->delete();
        return redirect('kategori-artikel')->with('status','data berhasil dihapus');
    }
}
