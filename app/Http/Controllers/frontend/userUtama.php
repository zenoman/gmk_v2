<?php

namespace App\Http\Controllers\frontend;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class userUtama extends Controller
{
    public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $kategori = DB::table('tb_kategoris')->get();
        
        $barangbaru = DB::table('tb_kodes')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->where('tb_kodes.tampil','=','Y')
            ->groupBy('tb_kodes.kode_barang')
            ->orderby('tb_kodes.id','desc')
            ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
            ->limit(8)
            ->get();
        $artikel = DB::table('tb_artikel')
        ->select(DB::raw('tb_artikel.*,kategori_artikel.nama'))
        ->leftjoin('kategori_artikel','kategori_artikel.id','=','tb_artikel.id_kategori')
        ->limit(3)
        ->orderby('tb_artikel.id','desc')
        ->get();
        

        $barangsuges = DB::table('tb_kodes')
            ->select(DB::raw('tb_kodes.*, tb_kategoris.kategori,SUM(tb_barangs.stok) as total'))
            ->join('tb_kategoris', 'tb_kodes.id_kategori', '=', 'tb_kategoris.id')
            ->join('tb_barangs', 'tb_barangs.kode', '=', 'tb_kodes.kode_barang')
            ->where('tb_kodes.tampil','=','Y')
            ->groupBy('tb_kodes.kode_barang')
            ->inRandomOrder()
            ->havingRaw('SUM(tb_barangs.stok) > ?', [0])
            ->limit(4)
            ->get();
        $slider = DB::table('sliders')->get();
        return view("frontend/home",['sliders'=>$slider,'kategori'=>$kategori, 'barangbaru'=>$barangbaru,'barangsuges'=>$barangsuges,'websettings'=>$websetting,'artikel'=>$artikel]);
    }

    public function edituser()
    {
        $totalkeranjang = DB::table('tb_details')
        ->where([['iduser',Session::get('user_id')],['faktur',null]])
        ->count();

        $totalbayar = DB::table('tb_details')
                        ->select(DB::raw('SUM(total) as newtotal'))
                        ->where([['iduser',Session::get('user_id')],['faktur',null]])
                        ->get();

        $datausers = DB::table('tb_users')->where('id',Session::get('user_id'))->get();
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/edituser',['websettings'=>$websetting,'users'=>$datausers,'totalkeranjang'=>$totalkeranjang,'totalbayar'=>$totalbayar]);
    }
    public function aksiedit(Request $request)
    {
         $roles = [
                    'nama'      => 'required|min:5',
                    'no_telfon' => 'required|min:5|numeric',
                    'email'     => 'required|min:5|email',
                    'alamat'    => 'required|min:5',
                    'kota'      => 'required|min:5',
                    'provinsi'  => 'required',
                    'kode_pos'  => 'required|numeric',
                    'gambar_ktp'=> 'image|nullable|max:2000'
                    
                    ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan    terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email',
        'image'     => 'Maaf, file harus berupa gambar',
        'max'       => 'Maaf, file terlalu besar'
    ];

    $this->validate($request,$roles,$customMessages);

    if($request->hasFile('gambar_ktp')){
        $gambars = DB::table('tb_users')->where('id',Session::get('user_id'))->get();
        foreach ($gambars as $gmb) {
        File::delete('img/user/'.$gmb->ktp_gmb);
        } 
                     $namaexs=$request->File('gambar_ktp')->getClientOriginalName();
                     $lower_file_name=strtolower($namaexs);
                    $replace_space=str_replace(' ','-',$lower_file_name);
                     $namagambar=time().'-'.$replace_space;
                    //$destination = public_path('img/user');
                     $destination = base_path('../public_html/img/user');
                   $request->file('gambar_ktp')->move($destination,$namagambar);

                DB::table('tb_users')
                ->where('id',Session::get('user_id'))
                ->update([
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos,
                'ktp_gmb'  => $namagambar
                    ]);
                }else{
                    DB::table('tb_users')
                    ->where('id',Session::get('user_id'))
                    ->update([
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos
                ]);
                }
                return back()->with('status','Edit Profile Sukses');
    }
    //==========================================================
    public function hubungi()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        return view('frontend/hubungikami',['websettings'=>$websetting]);
    }

    
}
