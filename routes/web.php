<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::get('/loginadmin', function(){
    return view('login\login');
})->name('login');
Route::get('/registeradmin', function(){
    return view('login\register');
})->name('register');

// Route::get('/adminhome', function(){
//     return view('admin\admin');
// })->name('home');
Route::group(['prefix' => 'admin'], function() {
  	Route::get('/adminhome','App\Http\Controllers\LelangController@orderReport')->name('admin.adminhome');
    Route::get('/adminhome/cetak_pdf/{daterange}', 'App\Http\Controllers\LelangController@cetak_pdf')->name('admin.admin_pdf');

  
    // [.. ROUTING LAINNYA ..]
});
Route::post('/loginadmin','App\Http\Controllers\LoginController@logInWeb');
Route::post('/registeradmin','App\Http\Controllers\RegisterController@registerWeb');

Route::get('/adminhome/filter','App\Http\Controllers\LelangController@orderReport2');
