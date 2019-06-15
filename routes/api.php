<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('listBarang/','Admin\Barangcontroller@getBarang');
Route::get('listEtalase/','Admin\Barangcontroller@listEtalase');
Route::get('listKategori/','Admin\Kategoricontroller@getKategori');
Route::post('/loginUser','Logincontroller@loginApi');
Route::get('slider/','Admin\Slidercontroller@getSlider');
Route::post('login/','Logincontroller@loginApi');
Route::get('gambar_item/{id}','Admin\Barangcontroller@gmbItem');
Route::get('warna_item/{id}','Admin\Barangcontroller@warnaItem');
Route::get('kategori/{id}','Admin\Barangcontroller@perKategori');
Route::get('kategoriPage/{id}?page={page}','Admin\Barangcontroller@perPageKategori');
//pemesanan
Route::post('order/','Admin\transaksiController@orderBarang');
//Update Profile
Route::post('updateProfile/','Logincontroller@updateProfile');
//Register
Route::post('register/','Logincontroller@registerUser');
//update Pass
Route::post('updatePas/','Logincontroller@UpdatePass');
//updateProfile
Route::post('updateLeng/','Logincontroller@UpdateLengkap');
//view kEranjang
Route::get('keranjang/{id}','Admin\transaksiController@vBelanja');
//hapus Keranjang
Route::post("hapusKeranjang",'Admin\transaksiController@hapusk');
//total keranjang
Route::get("totalk/{id}",'Admin\transaksiController@totalk');
//ambil Settting
Route::get("setting",'Admin\Barangcontroller@settingA');
//ambil Bank
Route::get("bank",'Admin\transaksiController@vBank');
//transaksi
Route::post("transaksi",'Admin\transaksiController@transaksibeli');
//kode
Route::get("kodes",'Admin\transaksiController@carikode');
//view transaksi
Route::get("vtrans/{id}",'Admin\transaksiController@vTrans');
//view Detail Transaksi
Route::get("detailTrans/{fk}",'Admin\transaksiController@detailTrans');
//view Cari
Route::post("cari/",'Admin\Barangcontroller@cariBarang');
//get VarianC
Route::get('cvarian/{id}','Admin\Barangcontroller@Cvarian');
//get varianSize
Route::get('csize/{id}/{kdv}','Admin\Barangcontroller@Csize');