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
Auth::routes();

Route::group(['prefix'=>'karyawan', 'middleware' => ['auth','karyawan']], function () {

	Route::get('/', 'Karyawan\DashboardController@index');

	Route::get('profile', 'Karyawan\ProfileController@index');
	Route::get('profile/edit/', 'Karyawan\ProfileController@Edit');
	Route::post('profile/update', 'Karyawan\ProfileController@Update');


	Route::get('absensi', 'Karyawan\AbsensiController@index');
	Route::get('absensi/get', 'Karyawan\AbsensiController@get');


	Route::get('jadwal', 'Karyawan\JadwalController@index');
	Route::get('jadwal/get', 'Karyawan\JadwalController@get');


	Route::get('cuti', 'Karyawan\CutiController@index');
	Route::get('cuti/edit/{id}', 'Karyawan\CutiController@edit');
	Route::post('cuti/update', 'Karyawan\CutiController@update');
	Route::post('cuti/request', 'Karyawan\CutiController@request');

	Route::get('cuti/get', 'Karyawan\CutiController@get');
	Route::get('cuti/view', 'Karyawan\CutiController@view');
	Route::delete('cuti/{id}', 'Karyawan\CutiController@destroy');


	Route::get('settings', 'Karyawan\SettingsController@index');


	Route::get('update-user', 'Karyawan\AccountController@viewUser');
	Route::get('personal/update-password', 'Karyawan\AccountController@viewPassword');
	Route::post('personal/update/user', 'Karyawan\AccountController@updateUser');
	Route::post('personal/update/password', 'Karyawan\AccountController@updatePassword');

});