<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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

Route::POST('masyarakat/register','App\Http\Controllers\RegisterController@registerMasyarakat');
Route::POST('admin/register','App\Http\Controllers\RegisterController@registerAdmin');
Route::POST('petugas/register','App\Http\Controllers\RegisterController@registerPetugas');
Route::POST('login','App\Http\Controllers\LoginController@logInMasyarakat');
Route::GET('petugas/getPetugas/{id_petugas}','App\Http\Controllers\PetugasController@getPetugas');
Route::GET('petugas/deletePetugas/{id_petugas}','App\Http\Controllers\PetugasController@deletePetugas');
Route::POST('petugas/addBarang','App\Http\Controllers\BarangController@addBarang');
Route::POST('barang/editBarang/{id_barang}','App\Http\Controllers\BarangController@editBarang');
Route::GET('barang/listbarang/{status}','App\Http\Controllers\BarangController@listBarang');

Route::GET('barang/getFoto/{id_barang}','App\Http\Controllers\BarangController@getFoto');
Route::GET('barang/deleteBarang/{id_barang}','App\Http\Controllers\BarangController@deleteBarang');
Route::POST('petugas/addFotoBarang','App\Http\Controllers\BarangController@addFotoBarang')->name('image.upload.post');
Route::POST('petugas/addFotoBarang2/{id_barang}','App\Http\Controllers\BarangController@addFotoBarang2')->name('image.upload.post');
Route::POST('masyarakat/editProfile/{id_masyakarat}/{id_user}','App\Http\Controllers\MasyarakatController@editProfile');
Route::POST('lelang/bukaLelang/{id_petugas}/{id_barang}','App\Http\Controllers\LelangController@bukaLelang');
Route::POST('lelang/listLelang/{status}','App\Http\Controllers\LelangController@listLelang');
Route::GET('lelang/barang/{id_user}','App\Http\Controllers\LelangController@barang');
Route::POST('lelang/bidLelang/{id_lelang}/{id_barang}/{id_user}','App\Http\Controllers\LelangController@bidLelang');
Route::GET('lelang/penawarTertinggi/{id_lelang}','App\Http\Controllers\LelangController@penawarTertinggi');
Route::GET('lelang/penawar/{id_lelang}','App\Http\Controllers\LelangController@penawar');
Route::GET('lelang/tutupLelang/{id_lelang}','App\Http\Controllers\LelangController@tutupLelang');
Route::GET('lelang/tutupLelang2','App\Http\Controllers\LelangController@tutupLelang2');
Route::GET('/send-sms/{code}','App\Http\Controllers\LoginController@sms');
Route::POST('masyarakat/editPassword/{id_user}','App\Http\Controllers\MasyarakatController@editPassword');
Route::POST('masyarakat/editPassword2/{username}','App\Http\Controllers\MasyarakatController@editPassword2');