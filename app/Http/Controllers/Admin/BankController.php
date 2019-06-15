<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\BankModel;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    public function index()
    {
        $websetting = DB::table('settings')->limit(1)->get();
        $databank = BankModel::where('id','>',1)->get();
        return view('bank/index',['databank'=>$databank,'websettings'=>$websetting]);
    }
    
    public function store(Request $request)
    {
        BankModel::create([
            'nama_bank'=>$request->bank,
            'rekening'=>$request->rekening,
            'atasnama'=>$request->atasnama
        ]);
        return redirect('bank')->with('status','Tambah Data berhasil');
    }
    public function update(Request $request, $id)
    {
        BankModel::find($id)
                    ->update([
                        'nama_bank'=>$request->bank,
                        'rekening'=>$request->rekening,
                        'atasnama'=>$request->atasnama
                    ]);
        return redirect('bank')->with('status','Edit Data berhasil');
    }
    public function destroy($id)
    {
        BankModel::destroy($id);
        return redirect('bank')->with('status','Hapus Data berhasil');
    }
}
