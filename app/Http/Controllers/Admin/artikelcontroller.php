<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;

class artikelcontroller extends Controller
{
    public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $artikel = 
        DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,admins.username,kategori_artikel.nama'))
        ->leftjoin('admins','admins.id','=','tb_artikel.id_penulis')
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->get();
        return view('artikel/index',['websettings'=>$websetting,'artikel'=>$artikel]);
    }

    public function create()
    {
       $websetting = DB::table('settings')->limit(1)->get();
       $kategori = DB::table('kategori_artikel')->get();
       return view('artikel/create',['websettings'=>$websetting,'kategori'=>$kategori]);
    }
    public function store(Request $request)
    {
         if ($request->hasFile('foto')) {
            $namaexs = $request->file('foto')->getClientOriginalName();
            //membuat nama  file menjadi lower case / kecil semua
            $lower_file_name=strtolower($namaexs);
            //merubah nama file yg ada spasi menjadi -
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $destination = public_path('img/artikel');
            //$destination = base_path('../public_html/img/kategori');
            $request->file('foto')->move($destination,$namagambar);
        }else{
            $namagambar = 'noimage.jpg';
        }
        $judul      = $request->judul;
        $ju         = strtolower($judul);
        $newjudul   = str_replace(' ','-',$ju);
        DB::table('tb_artikel')
        ->insert([
            'judul'         => $request->judul,
            'link'          => $newjudul,
            'isi'           => $request->isi,
            'tgl'           => date('Y-m-d'),
            'gambar'        => $namagambar,
            'id_kategori'   => $request->kategori,
            'id_penulis'    => Session::get('iduser'),
        ]);
        return redirect('artikel')->with('status','Data Berhasil Disimpan');
    }
    public function show($id)
    {
       $websetting = DB::table('settings')->limit(1)->get();
       $kategori = DB::table('kategori_artikel')->get();
       $artikel = DB::table('tb_artikel')->where('id',$id)->get();
       return view('artikel/edit',['artikel'=>$artikel,'websettings'=>$websetting,'kategori'=>$kategori]);
    }
    public function update(Request $request, $id)
    {
        $judul      = $request->judul;
        $ju         = strtolower($judul);
        $newjudul   = str_replace(' ','-',$ju);
        if ($request->hasFile('foto')) {
            File::delete('img/artikel/'.$request->fotolama);
            $namaexs = $request->file('foto')->getClientOriginalName();
            //membuat nama  file menjadi lower case / kecil semua
            $lower_file_name=strtolower($namaexs);
            //merubah nama file yg ada spasi menjadi -
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $destination = public_path('img/artikel');
            //$destination = base_path('../public_html/img/kategori');
            $request->file('foto')->move($destination,$namagambar);

            DB::table('tb_artikel')
            ->where('id',$id)
            ->update([
            'judul'         => $request->judul,
            'link'          => $newjudul,
            'isi'           => $request->isi,
            'tgl'           => date('Y-m-d'),
            'gambar'        => $namagambar,
            'id_kategori'   => $request->kategori,
            'id_penulis'    => Session::get('iduser'),
            ]);
        }else{
            DB::table('tb_artikel')
            ->where('id',$id)
            ->update([
            'judul'         => $request->judul,
            'link'          => $newjudul,
            'isi'           => $request->isi,
            'tgl'           => date('Y-m-d'),
            'id_kategori'   => $request->kategori,
            'id_penulis'    => Session::get('iduser'),
            ]);
        }
        return redirect('artikel')->with('status','Data Berhasil Di ubah');
    }
    public function destroy($id)
    {
        $artikel = DB::table('tb_artikel')->where('id',$id)->get();
        foreach ($artikel as $row) {
           File::delete('img/artikel/'.$row->gambar);
        }
        DB::table('tb_artikel')->where('id',$id)->delete();
        return redirect('artikel')->with('status','Data Berhasil Hapus');
    }
}
