<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\models\slider;
use Illuminate\Support\Facades\DB;

class Slidercontroller extends Controller
{
    public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $sliders = slider::all();
        return view('slider/index',['sliders'=>$sliders,'websettings'=>$websetting]);
    }
    public function create()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        return view('slider/input',['websettings'=>$websetting]);
    }
    public function store(Request $request)
    {
        $roles = [
            'gambar' => 'image|max:4000'
        ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'max'       => 'Maaf, file terlalu besar'
    ];
    $this->validate($request,$roles,$customMessages);
    if($request->hasFile('gambar')){
        $namaexs=$request->File('gambar')->getClientOriginalName();
        $lower_file_name=strtolower($namaexs);
        $replace_space=str_replace(' ','-',$lower_file_name);
        $namagambar=time().'-'.$replace_space;
        //$destination = public_path('img/slider');
        $destination = base_path('../public_html/img/slider');
        $request->file('gambar')->move($destination,$namagambar);
    }else{
        $namagambar='';
        }
        slider::create([
            'judul' => $request->judul,
            'foto'  => $namagambar
        ]);

        return redirect('slider')->with('status','input data sukses');
    }
    public function edit($id)
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $slider = slider::find($id);
        return view('slider/edit',['slider'=>$slider,'websettings'=>$websetting]);
    }
    public function update(Request $request, $id)
    {
    $roles = [
            'gambar' => 'image|max:4000'
        ];
    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'max'       => 'Maaf, file terlalu besar'
    ];

    $this->validate($request,$roles,$customMessages);
    
    $sliderdata = slider::find($id);

        if($request->hasFile('gambar')){
            File::delete('img/slider/'.$sliderdata->foto);
            
            $namaexs=$request->File('gambar')->getClientOriginalName();
            $lower_file_name=strtolower($namaexs);
            $replace_space=str_replace(' ','-',$lower_file_name);
            $namagambar=time().'-'.$replace_space;
            //$destination = public_path('img/slider');
            $destination = base_path('../public_html/img/slider');
            $request->file('gambar')->move($destination,$namagambar);
            
            slider::find($id)->update([
                'judul' => $request->judul,
                'foto' => $namagambar
            ]);
        }else{
            slider::find($id)->update([
                'judul' => $request->judul
            ]);
        }
        return redirect ('slider')->with ('status','Edit Data Sukses');

    }
    public function destroy($id)
    {
         $namagambar = slider::find($id);
            if($namagambar->foto != ''){
                File::delete('img/slider/'.$namagambar->foto);
            }
        slider::destroy($id);
        return redirect ('slider')->with ('status','Hapus Data Sukses');
    }
    //------------------- API ------------------------
    function getSlider(){
        $slide=slider::all();
        return response()->json(["data"=>$slide]);
    }
}
