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
Route::get('/', 'ClientController@Landing')->name('landing');
Route::get('/data', 'ClientController@Data')->name('client.data');
Route::get('/analisa', 'ClientController@Analisa')->name('client.analisa');
Route::get('/pemalang', 'ClientController@Pemalang')->name('client.pemalang');

// ADMIN
Route::get('/admin/dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
Route::get('/admin/home', 'AdminController@Home')->name('admin.home');
Route::get('/admin/pemalang', 'AdminController@Pemalang')->name('pemalang.read');
Route::get('/admin/analisa', 'AdminController@Analisa')->name('analisa.read');
Route::get('/admin/user', 'AdminController@Pengguna')->name('pengguna.read');
Route::post('/admin/user/post', 'AdminController@CreatePengguna')->name('pengguna.create');
Route::get('/admin/user/{id}', 'AdminController@EditPengguna')->name('pengguna.edit');
Route::post('/admin/user/{id}/update', 'AdminController@UpdatePengguna')->name('pengguna.update');
Route::post('/admin/user/delete', 'AdminController@DeletePengguna')->name('pengguna.delete');



Route::get('/admin/data/kecamatan', 'AdminController@KecamatanRead')->name('kecamatan.read');
Route::get('/admin/data/kriteria', 'AdminController@KriteriaRead')->name('kriteria.read');
Route::get('/admin/data/preferensi', 'AdminController@Preferensi')->name('preferensi.read');

// KRITERIA
<<<<<<< Updated upstream
Route::get('/admin/data/kriteria/view/{id}', 'AdminController@KriteriaView')->name('kriteria.view');
Route::get('/admin/data/kriteria/edit/{id}', 'AdminController@KriteriaEdit')->name('kriteria.edit');
Route::post('/admin/data/kriteria/update', 'AdminController@KriteriaUpdate')->name('kriteria.update');

Route::post('/admin/data/kecamatan/create', 'AdminController@KecamatanCreate')->name('kecamatan.create');
Route::get('/admin/data/kecamatan/edit/{id}', 'AdminController@KecamatanEdit')->name('kecamatan.edit');
Route::post('/admin/data/kecamatan/update/{id}', 'AdminController@KecamatanUpdate')->name('kecamatan.update');
Route::get('/admin/data/kecamatan/delete/{id}', 'AdminController@KecamatanDelete')->name('kecamatan.delete');
=======
Route::get('/admin/data/kriteria/view/{id}', 'AdminController@kriteriaview')->name('kriteria.view');
Route::get('/admin/data/kriteria/edit/{id}', 'AdminController@kriteriaedit')->name('kriteria.edit');
Route::post('/admin/data/kriteria/update', 'AdminController@kriteriaupdate')->name('kriteria.update');
>>>>>>> Stashed changes



// PROMETHEE
Route::get('/admin/pro/deviasi', 'ProController@ViewDeviasi')->name('pro.deviasi');

// Route::get('/logout', 'AdminController@Logout')->name('logouts');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
