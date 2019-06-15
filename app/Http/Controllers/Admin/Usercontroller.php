<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\models\Usermodel;

class Usercontroller extends Controller
{
   public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $users = Usermodel::orderBy('id','desc')->paginate(40);
        return view('user/index',['user'=> $users,'websettings'=>$websetting]);
    }
    public function unbanned($id){
         DB::table('tb_users')
        ->where('id',$id)
        ->update([
            'cancel'=>0
        ]);
        return redirect('user');
    }
    public function banned($id){
        DB::table('tb_users')
        ->where('id',$id)
        ->update([
            'cancel'=>3
        ]);
        return redirect('user');
    }
    public function cariuser(Request $request)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $datauser = DB::table('tb_users')
        ->where('nama','like','%'.$request->cari.'%')
        ->orwhere('username','like','%'.$request->cari.'%')
        ->orwhere('email','like','%'.$request->cari.'%')
        ->orwhere('kota','like','%'.$request->cari.'%')
        ->get();
        
        return view('user/pencarian', ['datauser'=>$datauser, 'cari'=>$request->cari,'websettings'=>$websetting]);
    }

    public function create()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        return view('user/create',['websettings'=>$websetting]);
    }

    public function store(Request $request)
    {
        $roles = [  'nama'      => 'required',
                    'username'  => 'required|min:8|alpha_dash',
                    'password'  => 'required|min:8',
                    'konfirmasi_password'=>'required|min:8|same:password',
                    'no_telfon' => 'required|numeric',
                    'email'     => 'required|email',
                    'alamat'    => 'required|',
                    'kota'      => 'required|',
                    'provinsi'  => 'required',
                    'kode_pos'  => 'required|numeric',
                    'gambar_ktp'=> 'image|nullable|max:3000'];

        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan    terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email',
        'image'     => 'Maaf, file harus berupa gambar',
        'max'       => 'Maaf, file terlalu besar'];

    $this->validate($request,$roles,$customMessages);
    $jumlahusername = DB::table('tb_users')->where('username',$request->username)->count();
    if($jumlahusername>0){
    return back()->with('status','Maaf, username sudah dipakai');
    }else{
        if($request->hasFile('gambar_ktp')){ 
    $namaexs=$request->File('gambar_ktp')->getClientOriginalName();
    $lower_file_name=strtolower($namaexs);
    $replace_space=str_replace(' ','-',$lower_file_name);
    $namagambar=time().'-'.$replace_space;
    //$destination = public_path('img/user');
    $destination = base_path('../public_html/img/user');
    $request->file('gambar_ktp')->move($destination,$namagambar);
    }else{
        $namagambar='';
    }
    Usermodel::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'email'    => $request->email,
        'telp'     => $request->no_telfon,
        'nama'     => $request->nama,
        'alamat'   => $request->alamat,
        'kota'     => $request->kota,
        'provinsi' => $request->provinsi,
        'kodepos'  => $request->kode_pos,
        'ktp_gmb'  => $namagambar,
        'level'    => $request->level
    ]);
    return redirect('user')->with('status','Input Data Sukses');
    }}
    public function edit($id)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $user = Usermodel::find($id);
        return view('user/edit',['datauser'=>$user,'websettings'=>$websetting]);
    }
    public function changepass($id)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $user = Usermodel::find($id);
        return view('user/changepass',['datauser'=>$user,'websettings'=>$websetting]);
    }

    public function actchangepass(Request $request, $id)
    {
    $roles = [
    'username' => 'required|same:username_lama',
    'password_baru'=>'required|min:8',
    'konfirmasi_password_baru'=>'required|min:8|same:password_baru'
    ];
    $customMessages = [
    'required'  => 'Maaf, :attribute harus di isi',
    'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
    'same'      => 'Maaf, Pastikan :attribute dan :other sama'
    ];

    $this->validate($request,$roles,$customMessages);
    if(Hash::check($request->password_lama, $request->password)){
        
        Usermodel::find($id)
        ->update([
        'password' => Hash::make($request->konfirmasi_password_baru)
        ]);
        
        return redirect('user')
        ->with('status','Edit Password Berhasil');
            
        }else{
        return back()
        ->with('errorpass1','Maaf, Konfimasi Password Anda Salah');
        }}

    public function update(Request $request, $id)
    {
        $roles = [
                'username' => 'required|min:8|alpha_dash',
                'email'    => 'required|email',
                'kota'     => 'required',
                'provinsi' => 'required',
                'kode_pos' => 'required|numeric',
                'nama'     => 'required',
                'gambar_ktp' => 'image|nullable|max:3000',
                'no_telfon'=> 'required|numeric',
                'alamat'   => 'required|'
                ];

        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email',
        'image'     => 'Maaf, file harus berupa gambar',
        'max'       => 'Maaf, file terlalu besar'
    ];

    $this->validate($request,$roles,$customMessages);
        $namagambar=Usermodel::find($id);
        if($request->username != $namagambar->username){
            $jumlahusername = DB::table('tb_users')->where('username',$request->username)->count();
            if($jumlahusername > 0){
                return back()->with('status','Maaf, username sudah dipakai');
            }else{
                if($request->hasFile('gambar_ktp')){
            File::delete('img/user/'.$namagambar->ktp_gmb);
           $namaexs=$request->file('gambar_ktp')->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ','-',$lower_file_name);
            $namagambar=time().'-'.$replace_space;
            //$destination=public_path('img/user');
            $destination = base_path('../public_html/img/user');
            $request->file('gambar_ktp')->move($destination,$namagambar);
        }
        if($request->hasFile('gambar_ktp')){
            Usermodel::find($id)->update([
                'username' => $request->username,
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos,
                'ktp_gmb'  => $namagambar,
                'level'    => $request->level
        ]);
        }else{
           Usermodel::find($id)->update([
                'username' => $request->username,
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos,
                'level'    => $request->level
                ]);
        }
        
        return redirect('user')->with('status','Edit Data Sukses');
            }
        }else{
            if($request->hasFile('gambar_ktp')){
            File::delete('img/user/'.$namagambar->ktp_gmb);
           $namaexs=$request->file('gambar_ktp')->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ','-',$lower_file_name);
            $namagambar=time().'-'.$replace_space;
            //$destination=public_path('img/user');
            $destination = base_path('../public_html/img/user');
            $request->file('gambar_ktp')->move($destination,$namagambar);
        }
        if($request->hasFile('gambar_ktp')){
            Usermodel::find($id)->update([
                'username' => $request->username,
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos,
                'ktp_gmb'  => $namagambar,
                'level'    => $request->level
        ]);
        }else{
           Usermodel::find($id)->update([
                'username' => $request->username,
                'email'    => $request->email,
                'telp'     => $request->no_telfon,
                'nama'     => $request->nama,
                'alamat'   => $request->alamat,
                'kota'     => $request->kota,
                'provinsi' => $request->provinsi,
                'kodepos'  => $request->kode_pos,
                'level'    => $request->level
                ]);
        }
        
        return redirect('user')->with('status','Edit Data Sukses');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $namagambar = Usermodel::find($id);
            if($namagambar->ktp_gmb!= ''){
                File::delete('img/user/'.$namagambar->ktp_gmb);
            }
        Usermodel::destroy($id);
        return redirect ('user')->with ('status','Hapus Data Sukses');
    }
}
