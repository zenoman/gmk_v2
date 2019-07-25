<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\models\Barangmodel;
use App\Imports\BarangImport;
use App\Exports\KategoriExport;
use App\Exports\warnaexport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Image;
class Barangcontroller extends Controller
{

    public function editbbt($id){
        $websetting = DB::table('settings')->limit(1)->get();
        $barang = DB::table('tb_kodes')->where('id',$id)->get();
        foreach ($barang as $row) {
            $kode = $row->kode_barang;
        }
        $kategori = DB::table('tb_kategoris')->get();
        $warna = DB::table('tb_barangs')
        ->select(DB::raw('tb_barangs.*,tb_varian.varian'))
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
        ->where('tb_barangs.kode',$kode)
        ->get();
        $variasi = DB::table('tb_varian')->get();
        $fotos = DB::table('gambar')->where('kode_barang',$kode)->get();
        $jumlah_foto = DB::table('gambar')->where('kode_barang',$kode)->count();
        return view('barang/editbbt',['kategori'=>$kategori,'barang'=>$barang,'warna'=>$warna,'fotos'=>$fotos,'idnya'=>$id,'kode'=>$kode,'jumlah_foto'=>$jumlah_foto,'websettings'=>$websetting,'varian'=>$variasi]);
    }
    public function tampilkan($id){
        $carikodes = DB::table('tb_kodes')->where('id',$id)->get();
        foreach($carikodes as $row){
            $caritbs = DB::table('tb_tambahstoks')->where('kode_barang',$row->kode_barang)->get();
            foreach ($caritbs as $ro) {
                $total = $ro->jumlah*$row->harga_beli;
                DB::table('tb_tambahstoks')->where('kode_barang',$row->kode_barang)
                ->update([
                    'total'=>$total
                ]);
            }
        }
        DB::table('tb_kodes')
        ->where('id',$id)
        ->update([
            'tampil'=>'Y'
        ]);
        return back()->with('status','Barang Berhasil Ditampilkan');
    }
    public function belumtampil(){
        $barang = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->groupBy('tb_kodes.kode_barang')
            ->where('tb_kodes.tampil','=','N')
            ->orderby('tb_kodes.id','desc')
            ->paginate(50);
        $websetting = DB::table('settings')->limit(1)->get();
        return view('barang/bbt',['barang'=>$barang,'websettings'=>$websetting]);
    }

    public function index()
    {   
        $barang = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->groupBy('tb_kodes.kode_barang')
            ->where('tb_kodes.tampil','=','Y')
            ->orderby('tb_kodes.id','desc')
            ->paginate(50);
        
        $barangbelum = DB::table('tb_kodes')
        ->where('tampil','=','N')
        ->count();
        $websetting = DB::table('settings')->limit(1)->get();
        return view('barang/index',['barang'=>$barang,'websettings'=>$websetting,'barangbelum'=>$barangbelum]);
    }

    public function importexcel ()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        return view('barang/importexcel',['websettings'=>$websetting]);
    }
    
    public function exsportexcel()
    {
        return Excel::download(new KategoriExport, 'Kategori.xlsx');
    }

    public function exsportwarna()
    {
        return Excel::download(new warnaexport, 'Warna.xlsx');
    }

    public function updatewarna(Request $request, $id){
        $hargaoptional = $request->harga_lain;
        if ($request->oldstok < $request->stok) {
            $stok = $request->stok - $request->oldstok;
            if($hargaoptional != 0){
                $total = $hargaoptional;
            }else{
                $total = $request->harga_beli*$stok;
            }
            DB::table('tb_tambahstoks')
            ->insert([
                'idwarna'=>$id,
                'idadmin'=>Session::get('iduser'),
                'kode_barang'=>$request->kode,
                'jumlah'=>$stok,
                'tgl'=>date("Y-m-d"),
                'total'=>$total,
                'keterangan'=>$request->deskripsi,
                'aksi'=>'tambah'

            ]);
        }elseif($request->oldstok > $request->stok){
            $stok = $request->oldstok - $request->stok;
            if($hargaoptional != 0){
                $total = $hargaoptional;
            }else{
                $total = $request->harga_jual*$stok;
            }
            DB::table('tb_tambahstoks')
            ->insert([
                'idwarna'=>$id,
                'idadmin'=>Session::get('iduser'),
                'kode_barang'=>$request->kode,
                'jumlah'=>$stok,
                'tgl'=>date("Y-m-d"),
                'total'=>$total,
                'keterangan'=>$request->deskripsi,
                'aksi'=>'kurangi'

            ]);
        }
        DB::table('tb_barangs')
        ->where('idbarang',$id)
        ->update([
            'stok' => $request->stok,
            'kode_v'=>$request->variasi,
            'warna' =>$request->warna,
            'barang_jenis'=>$request->nama_brg." ".$request->warna
        ]);
        return back();
    }

    public function hapuswarna($id){
        DB::table('tb_barangs')->where('idbarang',$id)->delete();
        return back();
    }
    public function tambahwarna(Request $request){
        if($request->hrg_lain!=''){
            $total = $request->hrg_lain;
        }else{
            $total = $request->hrgbeli_brg*$request->stok;
        }
        
        DB::table('tb_barangs')
        ->insert([
            'kode'=>$request->kode,
            'warna'=>$request->warna,
            'stok' =>0,
            'kode_v'=>$request->variasi,
            'barang_jenis'=>$request->nama_brg." ".$request->warna
        ]);
        $id = DB::getPdo()->lastInsertId();
        DB::table('tb_tambahstoks')
            ->insert([
                'idwarna'=>$id,
                'idadmin'=>Session::get('iduser'),
                'kode_barang'=>$request->kode,
                'jumlah'=>$request->stok,
                'tgl'=>date("Y-m-d"),
                'total'=>$total,
                'keterangan'=>'menambah pertama kali',
                'aksi'=>'tambah'
        ]);
        return back();
    }
    public function downloadtemplate(){
         $file= public_path(). "/files/template.xlsx";

            $headers = array(
              'Content-Type: application/excel',
            );

    return Response::download($file, 'template.xlsx', $headers);
    return redirect('barang/importexcel');
    }
    public function aksiimportexcel(Request $request)
    {
        if($request->hasFile('file')){
            
        Excel::import(new BarangImport, request()->file('file'));
        }

        return redirect('barang')->with('status','Import excel sukses');
    }

    public function create()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $kode = DB::table('tb_kodes')->max('kode_barang');
        if($kode != NULL){
            $numkode = substr($kode, 3);
            $countkode = $numkode+1;
            $newkode = "BRG".sprintf("%05s", $countkode);
        }else{
            $newkode = "BRG00001";
        }
        $websetting = DB::table('settings')->limit(1)->get();
        $kategori = DB::table('tb_kategoris')->get();
        $warna = DB::table('tb_varian')->get();
        return view('barang/create',['kode'=>$newkode,'kategori'=>$kategori,'websettings'=>$websetting,'warna'=>$warna]);
    }

    public function tambahstok($id){
        $barang = DB::table('tb_barangs')->where('idbarang',$id)->get();
        return view('barang/tambahstok',['barang'=>$barang]);
    }

    public function aksitambahstok(Request $request){
        $idbarang = $request->idbarang;
        DB::table('tb_barangs')
        ->where('idbarang',$idbarang)
        ->update([
            'stok'=> $request->stok_lama + $request->stok
            ]);
        DB::table('tb_tambahstoks')
        ->insert([
            'idbarang'=>$request->idbarang,
            'barang'=>$request->nama_barang,
            'jumlah'=>$request->stok,
            'total'=>$request->stok*$request->harga,
            'tgl'=>date("Y-m-d")
        ]);

        return redirect('barang')->with('status','Tambah Stok Berhasil');
    }
   
    public function store(Request $request)
    {
        $rules = [
            'kode_barang' => 'required|min:3',
            'nama_barang' => 'required',
            "photo.*"  => "required|image|max:3048"
        ];

        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan    terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email',
        'image'     => 'Maaf, file harus berupa gambar',
        'max'       => 'Maaf, file terlalu besar'];

    $this->validate($request, $rules, $customMessages);

    $jumlah_file = sizeof($request->file('photo'));
    if($jumlah_file>4){
        return redirect('barang/create')->with('errorfoto','Maaf, Foto tidak boleh lebih dari 4');
    }
    foreach ($request->file('photo') as $photos){
        $namaexs = $photos->getClientOriginalName();
        $lower_file_name=strtolower($namaexs);
        $replace_space=str_replace(' ', '-', $lower_file_name);
        $namagambar = time().'-'.$replace_space;
        $thumbnailImage = Image::make($photos);
        $thumbnailPath = public_path().'/img/barang/';
        //$thumbnailPath = base_path('../public_html/img/barang/');
        $thumbnailImage->resize(400, null, function ($constraint){$constraint->aspectRatio();});
        $thumbnailImage->save($thumbnailPath.$namagambar); 
            DB::table('gambar')->insert([
                'kode_barang' => $request->kode_barang,
                'nama' => $namagambar
            ]);
        }
        $kategori = explode("-",$request->kategori);
    $i=0;
    foreach ($request->warna as $warna) {
         $total = $request->harga_beli*$request->stok[$i];
         $stok = $request->stok[$i];
         $idnya = DB::table('tb_barangs')->insert([
                'barang_jenis'=>$request->nama_barang." ".$warna,
                'kode' => $request->kode_barang,
                'kode_v' => $request->variasi[$i],
                'stok' => 0,
                'warna' => $warna
            ]);
        $id = DB::getPdo()->lastInsertId();
        DB::table('tb_tambahstoks')
            ->insert([
                'idwarna'=>$id,
                'idadmin'=>Session::get('iduser'),
                'kode_barang'=>$request->kode_barang,
                'jumlah'=>$request->stok[$i],
                'tgl'=>date("Y-m-d"),
                'total'=>$total,
                'keterangan'=>'menambah pertama kali',
                'aksi'=>'tambah']);
         $i++;
    }
        if (Session::get('level')=='admin') {
            $tampil='N';
        }else{
            $tampil='Y';
        }
        Barangmodel::create([
            'kode_barang'=>$request->kode_barang,
            'barang'=>$request->nama_barang,
            'harga_barang'=>$request->harga_barang,
            'harga_beli'=>$request->harga_beli,
            'harga_reseller'=>$request->harga_reseller,
            'diskon'=>$request->diskon_barang,
            'id_kategori'=>$kategori[0],
            'deskripsi'=>$request->deskripsi,
            'tampil'=>$tampil
        ]);
        return redirect('barang')->with('status','data berhasil di simpan');
    }

    public function editgambar(Request $request, $id){

        $rules = [
            'kode_barang' => 'required|min:3',
            "photo.*"  => "required|image|max:3048"
        ];
        

        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'image'     => 'Maaf, file harus berupa gambar',
        'max'       => 'Maaf, file terlalu besar'
    ];
    $this->validate($request, $rules, $customMessages);
    $jumlah_foto = sizeof($request->file('photo'));

    if($jumlah_foto > $request->jumlah_file){
         return redirect('barang/'.$id.'/edit')->with('errorfoto','Maaf, Foto Yang Anda Inputkan Terlalu Banyak');
    }
        foreach ($request->file('photo') as $photos) {
            $namaexs = $photos->getClientOriginalName();
            //membuat nama  file menjadi lower case / kecil semua
            $lower_file_name=strtolower($namaexs);
            //merubah nama file yg ada spasi menjadi -
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar = time().'-'.$replace_space;
            $thumbnailImage = Image::make($photos);
            //$thumbnailPath = base_path('../public_html/img/barang/');
            $thumbnailPath = public_path().'/img/barang/';
            $thumbnailImage
            ->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();});
            $thumbnailImage->save($thumbnailPath.$namagambar);
            DB::table('gambar')->insert([
                'kode_barang' => $request->kode_barang,
                'nama' => $namagambar
            ]);
        }
        return back();
    }
   
    public function cari(Request $request)
    {
        $websetting = DB::table('settings')->limit(1)->get();
         $barang = DB::table('tb_kodes')
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->where('tb_kodes.barang','like','%'.$request->cari.'%')
            ->groupBy('tb_kodes.kode_barang')->get();
//dd($databarang);
        return view('barang/pencarian',['barang'=>$barang, 'cari'=>$request->cari,'websettings'=>$websetting]);
    }

    public function hapusgambar($id){
        $newkode = explode("-",$id);
        $foto = DB::table('gambar')->where('id',$newkode[0])->get();
        foreach ($foto as $row) {
            File::delete('img/barang/'.$row->nama);
        }
        DB::table('gambar')->where('id',$newkode[0])->delete();

        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $barang = DB::table('tb_kodes')->where('id',$id)->get();
        foreach ($barang as $row) {
            $kode = $row->kode_barang;
        }
        $kategori = DB::table('tb_kategoris')->get();
        $warna = DB::table('tb_barangs')
        ->select(DB::raw('tb_barangs.*,tb_varian.varian'))
        ->leftjoin('tb_varian','tb_varian.kode_v','=','tb_barangs.kode_v')
        ->where('tb_barangs.kode',$kode)
        ->get();
        $variasi = DB::table('tb_varian')->get();
        $fotos = DB::table('gambar')->where('kode_barang',$kode)->get();
        $jumlah_foto = DB::table('gambar')->where('kode_barang',$kode)->count();
        return view('barang/edit',['kategori'=>$kategori,'barang'=>$barang,'warna'=>$warna,'fotos'=>$fotos,'idnya'=>$id,'kode'=>$kode,'jumlah_foto'=>$jumlah_foto,'websettings'=>$websetting,'varian'=>$variasi]);
    }

    public function update(Request $request, $id)
    {
        if($request->nama_barang != $request->oldnama){
            $warnas = DB::table('tb_barangs')->where('kode',$request->kode_barang)->get();
            foreach ($warnas as $warna) {
                DB::table('tb_barangs')
                ->where('idbarang',$warna->idbarang)
                ->update([
                    'barang_jenis'=>$request->nama_barang." ".$warna->warna
                ]);
            }
        }

        $kode = $request->idbarang;
        DB::table('tb_kodes')
        ->where('id',$kode)
        ->update([
            'id_kategori'=>$request->kategori_barang,
            'barang'=>$request->nama_barang,
            'harga_barang'=>$request->harga_barang,
            'harga_reseller'=>$request->harga_reseller,
            'harga_beli'=>$request->harga_beli,
            'deskripsi'=>$request->deskripsi,
            'diskon'=>$request->diskon_barang

        ]);
        return back();
    }

    public function destroy($id)
    {
        $barang = DB::table('tb_kodes')
        ->where('id',$id)->get();
        
        foreach ($barang as $brg) {
        $kodenya = $brg->kode_barang;
        }

        
        $hitung_gambar = DB::table('gambar')
        ->where('kode_barang', $kodenya)
        ->count();

        if($hitung_gambar>0){
             $fotos = DB::table('gambar')->where('kode_barang',$kodenya)->get();
        foreach ($fotos as $foto) {
            File::delete('img/barang/'.$foto->nama);
        }
        DB::table('gambar')->where('kode_barang',$kodenya)->delete();
        
        DB::table('tb_barangs')->where('kode', $kodenya)->delete();
        DB::table('tb_kodes')->where('kode_barang', $kodenya)->delete();    
    }else{
        
        DB::table('tb_barangs')->where('kode', $kodenya)->delete();
        DB::table('tb_kodes')->where('kode_barang', $kodenya)->delete();
    }
    return back()->with('status','Hapus data berhasil');
        
    }

    public function hapusbanyak(Request $request){
        if(!$request->kodebarang){
            return redirect('barang')->with('statuserror','Tidak ada data yang dipilih');
        }else{

            foreach ($request->kodebarang as $id){
                $barang = DB::table('tb_kodes')
                ->where('id',$id)->get();
                
                $jumlahbarang = DB::table('tb_kodes')
                ->where('id',$id)->count();
                    
                    if($jumlahbarang>0){
                          foreach ($barang as $brg){
                            $kodenya = $brg->kode_barang;
                            }

                            $hitung_gambar = DB::table('gambar')
                            ->where('kode_barang', $kodenya)
                            ->count();

                            if($hitung_gambar>0){
                                $fotos = DB::table('gambar')->where('kode_barang',$kodenya)->get();
                                foreach ($fotos as $foto) {
                                    File::delete('img/barang/'.$foto->nama);
                                }}
                                DB::table('gambar')->where('kode_barang',$kodenya)->delete();
                                DB::table('tb_stokawals')->where('kode_barang',$kodenya)->delete();
                                DB::table('tb_barangs')->where('kode', $kodenya)->delete();
                                DB::table('tb_kodes')->where('kode_barang', $kodenya)->delete();
                    }}
        return back()->with('status','Hapus data berhasil');  
        }
        
        
    }
//------------------------------- API ANDROID _--------------
function versionN(){
    $data=DB::table("apk_version")->get();
    return response()->json(["data"=>$data]);
}
function getBarang(){
    $barang = DB::table('tb_kodes')
    ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')       
    ->join('gambar','tb_kodes.kode_barang','=','gambar.kode_barang')
    ->join("tb_barangs",'tb_kodes.kode_barang','=',"tb_barangs.kode")
    ->select(DB::raw('tb_kodes.*,gambar.nama, tb_kategoris.kategori'))
    ->groupBy('tb_kodes.kode_barang')
    ->orderBy('tb_kodes.id','desc')
    ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
    ->paginate(25);
    return response()->json($barang);
}

function listEtalase(){
    $barang = DB::table('tb_kodes')
    ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')       
    ->join('gambar','tb_kodes.kode_barang','=','gambar.kode_barang')
    ->join("tb_barangs",'tb_kodes.kode_barang','=',"tb_barangs.kode")
    ->select(DB::raw('tb_kodes.*,gambar.nama, tb_kategoris.kategori'))
    ->groupBy('tb_kodes.kode_barang')
    ->orderByRaw('RAND()')
    ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
    ->paginate(20);
    return response()->json($barang);
}
function gmbItem($id){
    $gmb=DB::table('gambar')
        ->select('nama')
        ->where('kode_barang',$id)->get();       
    return response()->json(["data"=>$gmb]);    
}
function warnaItem($id){
    $warna=DB::table('tb_barangs')
        ->join("tb_kodes","tb_kodes.kode_barang","=","tb_barangs.kode")
        ->select(DB::raw("tb_kodes.deskripsi,tb_barangs.*"))
        ->where('kode',$id)        
        ->where('tb_barangs.tampil','Y')
        ->get();
        return response()->json(["data_barang"=>$warna]);    
}
function perKategori($id){
    $data = DB::table('tb_kodes')
        ->join('gambar',"gambar.kode_barang","=","tb_kodes.kode_barang")
        ->select(DB::raw("tb_kodes.*,gambar.nama"))
        ->where('id_kategori',$id)
        ->groupBy('tb_kodes.kode_barang')
        ->orderByRaw('RAND()')
        ->paginate(15);
    return response()->json($data);        
}
function settingA(){
    $data=DB::table("admins")
            ->where("level","admin")
            ->get();
    return response()->json(["data"=>$data]);
}
function cariBarang(Request $req){
    $cari=$req->cari;
    $barang = DB::table('tb_kodes')
    ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')       
    ->join('gambar','tb_kodes.kode_barang','=','gambar.kode_barang')
    ->join("tb_barangs",'tb_kodes.kode_barang','=',"tb_barangs.kode")
    ->where("tb_kodes.barang","like","%".$cari."%")
    ->select(DB::raw('tb_kodes.*,gambar.nama, tb_kategoris.kategori'))        
    ->groupBy('tb_kodes.kode_barang')
    ->orderByRaw('RAND()')
    ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
    ->get();
    return response()->json(["data"=>$barang]);
}
    function Cvarian($id){
        $barang=DB::table('tb_varian')
                ->join('tb_barangs','tb_barangs.kode_v','=','tb_varian.kode_v')
                ->where('tb_barangs.kode',$id)
                ->groupBy('tb_varian.kode_v')
                ->get();
        return response()->json(['data'=>$barang]);
    }
    function Csize($id,$kdv){
        $barang=DB::table('tb_barangs')
                ->where(['kode'=>$id,'kode_v'=>$kdv])                
                ->get();
        return response()->json(["data"=>$barang]);
    }
    
}
