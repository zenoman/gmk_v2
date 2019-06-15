<?php

namespace App\Http\Controllers\admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\models\Kategorimodel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class Kategoricontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $kategoris = Kategorimodel::get();
        return view('kategori/index',['kategori'=>$kategoris,'websettings'=>$websetting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = [
                    'kategori'=>'required|min:2|',
                    'gambar_kategori'=>'image|required|max:2000'
                    ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'max'       => 'Maaf, file terlalu besar'
                    ];
        $this->validate($request,$roles,$customMessages);

        if ($request->hasFile('gambar_kategori')) {
            $namaexs = $request->file('gambar_kategori')->getClientOriginalName();
            //membuat nama  file menjadi lower case / kecil semua
            $lower_file_name=strtolower($namaexs);
            //merubah nama file yg ada spasi menjadi -
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            //$destination = public_path('img/kategori');
            $destination = base_path('../public_html/img/kategori');
            $request->file('gambar_kategori')->move($destination,$namagambar);
        }else{
            $namagambar = 'noimage.jpg';
        }

        Kategorimodel::create([
            'kategori'=>$request->kategori,
            'gambar'=>$namagambar
        ]);
        return redirect('kategori')->with('status','Input Data Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori=Kategorimodel::find($id);

        if($request->hasFile('gambar_kategori')){
            File::delete('img/kategori/'.$kategori->gambar);

            $namaexs = $request->file('gambar_kategori')->getClientOriginalName();
            //membuat nama  file menjadi lower case / kecil semua
            $lower_file_name=strtolower($namaexs);
            //merubah nama file yg ada spasi menjadi -
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            //$destination = public_path('img/kategori');
             $destination = base_path('../public_html/img/kategori');
            $request->file('gambar_kategori')->move($destination,$namagambar);
        }
        
        if($request->hasFile('gambar_kategori')){
        Kategorimodel::find($id)->update([
        'kategori'=>$request->kategori,
        'gambar'=>$namagambar
        ]);
        }else{
        Kategorimodel::find($id)->update([
        'kategori'=>$request->kategori
        ]);
        }
        return redirect('kategori')->with('status','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $kategori = Kategorimodel::find($id);
        $idkategori = $kategori->id;
        $barang = DB::table('tb_kodes')->where('id_kategori',$id)->get();
        $hitungbarang = DB::table('tb_kodes')->where('id_kategori',$id)->count();
        
        if($hitungbarang >0){

            foreach ($barang as $row) {
          $kode = $row->kode_barang;
        

        $gambar = DB::table('gambar')->where('kode_barang',$kode)->get();
        foreach ($gambar as $gmbr) {
            File::delete('img/barang/'.$gmbr->nama);
        }
        DB::table('gambar')->where('kode_barang',$kode)->delete();
        DB::table('tb_barangs')->where('kode',$kode)->delete();
        DB::table('tb_kodes')->where('kode_barang',$kode)->delete();
        }}
        
        if($kategori->gambar != ''){
            File::delete('img/kategori/'.$kategori->gambar);
        }

        Kategorimodel::destroy($id);
        return redirect('kategori')->with('status','Hapus Data Sukses');
    }
    //-------------------- API ANDROID-----------------
    function getKategori(){
        $kat=DB::table('tb_kategoris')->get();
        return response()->json(["data"=>$kat]);
    }
}
