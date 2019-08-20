<?php

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

// use Illuminate\Support\Facades\Route;

// CLIENT
Route::get('/', 'ClientController@landing')->name('landing');
Route::get('/data', 'ClientController@data')->name('client.data');
Route::get('/analisa', 'ClientController@analisa')->name('client.analisa');
Route::get('/pemalang', 'ClientController@pemalang')->name('client.pemalang');

// ADMIN
// Route::get('/admin/login', 'AdminController@Login')->name('admin.login');
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
Route::get('/admin/home', 'AdminController@home')->name('admin.home');
Route::get('/admin/pemalang', 'AdminController@pemalang')->name('pemalang.read');
Route::get('/admin/analisa', 'AdminController@analisa')->name('analisa.read');
Route::get('/admin/user', 'AdminController@pengguna')->name('pengguna.read');

Route::get('/admin/data/kecamatan', 'AdminController@kecamatanread')->name('kecamatan.read');
Route::get('/admin/data/kriteria', 'AdminController@kriteriaread')->name('kriteria.read');
Route::get('/admin/data/preferensi', 'AdminController@preferensi')->name('preferensi.read');

// KRITERIA
Route::get('/admin/data/kriteria/view/{id}', 'AdminController@kriteriaview')->name('kriteria.view');
Route::get('/admin/data/kriteria/edit/{id}', 'AdminController@kriteriaedit')->name('kriteria.edit');

Route::post('/admin/data/kecamatan/create', 'AdminController@kecamatancreate')->name('kecamatan.create');
Route::get('/admin/data/kecamatan/edit/{id}', 'AdminController@kecamatanedit')->name('kecamatan.edit');
Route::post('/admin/data/kecamatan/update/{id}', 'AdminController@kecamatanupdate')->name('kecamatan.update');
Route::get('/admin/data/kecamatan/delete/{id}', 'AdminController@kecamatandelete')->name('kecamatan.delete');

// Route::get('/logout', 'AdminController@Logout')->name('logouts');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
