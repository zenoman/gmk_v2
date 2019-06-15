<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\models\Adminmodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admincontroller extends Controller
{
    public function index()
    {
        if(Session::get('level') != 'admin'){
            $websetting = DB::table('settings')->limit(1)->get();
            $admins = Adminmodel::get();
            return view('admin/index',['admin'=>$admins,'websettings'=>$websetting]);
        }else{
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak punya akses');
        }
        
    }
    public function create()
    {
        if(Session::get('level') != 'admin'){
             $websetting = DB::table('settings')->limit(1)->get();
        return view('admin/create',['websettings'=>$websetting]);
        }else{
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak punya akses');
        }
       
    }

    public function changepass($id)
    {
        if(Session::get('level') != 'admin'){
        $websetting = DB::table('settings')->limit(1)->get();
        $admin = Adminmodel::find($id);
        return view('admin/changepass',['dataadmin'=>$admin,'websettings'=>$websetting]);
        }else{
            if($id!=Session::get('iduser')){
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak dapat mengubah data admin lain');
            }else{
               $websetting = DB::table('settings')->limit(1)->get();
        $admin = Adminmodel::find($id);
        return view('admin/changepass',['dataadmin'=>$admin,'websettings'=>$websetting]); 
            }
            
        }
    }

    public function actionchangepass(Request $request, $id){
        $rules = [
                'konfirmasi_username'       =>  'required|same:username',
                'konfirmasi_password'       =>  'required|min:8',
                'password_baru' => 'required',
                'konfirmasi_password_baru'  =>  'required|min:8'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email',
        'same'      => 'Maaf, :attribute salah'
         ];
        $this->validate($request,$rules,$customMessages);
        if(Hash::check($request->konfirmasi_password, $request->password)){
            if($request->konfirmasi_password_baru==$request->password_baru){
                 Adminmodel::find($id)->update([
            'password' => Hash::make($request->konfirmasi_password_baru)
        ]);
        return redirect('admin')->with('status','Edit Password berhasil');
            }else{
             return redirect('admin/'.$id.'/changepass')->with('errorpass2','Maaf, Konfimasi Password Baru Anda Salah');
            }
        }else{
        return redirect('admin/'.$id.'/changepass')->with('errorpass1','Maaf, Konfimasi password lama anda salah');
        }
       
    }
    public function store(Request $request)
    {
        $rules = [
                    'nama'      => 'required|',
                    'username'  => 'required|min:8|alpha_dash',
                    'password'  => 'required|min:8',
                    'konfirmasi_password'=>'required|same:password',
                    'no_telfon' => 'required|numeric',
                    'email'     => 'required|email'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'same'      => 'Maaf, Pastikan :attribute dan :other sama',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
    ];
        $this->validate($request,$rules,$customMessages);
        $dataadmin = DB::table('admins')->where('username',$request->username)->count();
        if($dataadmin>0){
            return back()
            ->with('status','Maaf, username telah di pakai');
        }else{
            Adminmodel::create([
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'nama'      => $request->nama,
            'telp'      => $request->no_telfon,
            'email'     => $request->email,
            'level'     => $request->level
        ]);

        return redirect('admin')
        ->with('status','Input Data Sukses');
        }
        
    }
    public function edit($id)
    {
        if(Session::get('level') != 'admin'){
        $websetting = DB::table('settings')->limit(1)->get();
        $admin = Adminmodel::find($id);
        return view('admin/edit',['dataadmin'=>$admin,'websettings'=>$websetting]);
        }else{
            if($id!=Session::get('iduser')){
            return redirect('/dashboard')
            ->with('statuslogin','Maaf, Anda tidak dapat mengubah data admin lain');
            }else{
               $websetting = DB::table('settings')->limit(1)->get();
        $admin = Adminmodel::find($id);
        return view('admin/edit',['dataadmin'=>$admin,'websettings'=>$websetting]); 
            }}
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nama'=>'required',
            'username'=>'required|min:8|alpha_dash',
            'no_telfon'=>'required|numeric',
            'email'=>'required|email'
            
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'alpha_dash'=> 'Maaf, tidak menerima data lain kecuali alphabet',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
        
         ];
        $this->validate($request,$rules,$customMessages);
        if($request->oldusername != $request->username){
            $datauser = DB::table('admins')->where('username',$request->username)->count();
            if($datauser>0){
                return back()
                ->with('status','Maaf, username sudah dipakai');
            }else{
            Adminmodel::find($id)->update([
            'username'=>$request->username,
            'nama'=>$request->nama,
            'telp'=>$request->no_telfon,
            'email'=>$request->email,
            'level'=>$request->level
            ]);
        return redirect('admin')->with('status','Edit Data Sukses');
            }
        }else{
            Adminmodel::find($id)->update([
            'username'=>$request->username,
            'nama'=>$request->nama,
            'telp'=>$request->no_telfon,
            'email'=>$request->email,
            'level'=>$request->level
            ]);
        return redirect('admin')->with('status','Edit Data Sukses');
        }
        
    }
    public function destroy($id)
    {
         Adminmodel::destroy($id);
        return redirect('admin')->with('status','Hapus Data Sukses');
    }
}
