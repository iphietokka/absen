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



Route::group(['prefix'=>'admin', 'middleware' => ['auth','admin']], function () {

	Route::get('/', 'Admin\DashboardController@index');


	Route::get('user', 'Admin\UserController@index');
	Route::get('user/create/', 'Admin\UserController@create');
	Route::post('user/store', 'Admin\UserController@store');
	Route::get('user/edit/{id}', 'Admin\UserController@edit');
	Route::post('user/edit', 'Admin\UserController@update');
	Route::get('user/update-profile', 'Admin\UserController@update_profile');
	Route::get('user/password-update', 'Admin\UserController@password_update');
	Route::post('user/update-user', 'Admin\UserController@update_user');
	Route::post('user/update-password', 'Admin\UserController@update_password');
	Route::delete('user/{id}', 'Admin\UserController@destroy');





	Route::get('karyawan', 'Admin\KaryawanController@index');
	Route::get('karyawan/create/', 'Admin\KaryawanController@create');
	Route::post('karyawan/store', 'Admin\KaryawanController@store');
	Route::get('karyawan/edit/{id}', 'Admin\KaryawanController@edit');
	Route::post('karyawan/edit', 'Admin\KaryawanController@update');
	Route::get('karyawan/profile/{id}', 'Admin\KaryawanController@profile');
	Route::get('karyawan/archive/{id}', 'Admin\KaryawanController@archive');
	Route::delete('karyawan/{id}', 'Admin\KaryawanController@destroy');



	Route::get('jenis-cuti', 'Admin\JenisCutiController@index');
	Route::get('jenis-cuti/create/', 'Admin\JenisCutiController@create');
	Route::post('jenis-cuti/store', 'Admin\JenisCutiController@store');
	Route::get('jenis-cuti/edit/{id}', 'Admin\JenisCutiController@edit');
	Route::post('jenis-cuti/update/{id}', 'Admin\JenisCutiController@update');
	Route::delete('jenis-cuti/{id}', 'Admin\JenisCutiController@destroy');


	Route::get('group-cuti', 'Admin\GroupCutiController@index');
	Route::get('group-cuti/create/', 'Admin\GroupCutiController@create');
	Route::post('group-cuti/store', 'Admin\GroupCutiController@store');
	Route::get('group-cuti/edit/{id}', 'Admin\GroupCutiController@edit');
	Route::post('group-cuti/edit', 'Admin\GroupCutiController@update');
	Route::delete('group-cuti/{id}', 'Admin\GroupCutiController@destroy');

	Route::get('jabatan', 'Admin\JabatanController@index');
	Route::get('jabatan/create/', 'Admin\JabatanController@create');
	Route::post('jabatan/store', 'Admin\JabatanController@store');
	Route::post('jabatan/update/{id}', 'Admin\JabatanController@update');
	Route::delete('jabatan/{id}', 'Admin\JabatanController@destroy');

	Route::get('perusahaan', 'Admin\PerusahaanController@index');
	Route::get('perusahaan/create/', 'Admin\PerusahaanController@create');
	Route::post('perusahaan/store', 'Admin\PerusahaanController@store');
	Route::post('perusahaan/update/{id}', 'Admin\PerusahaanController@update');
	Route::delete('perusahaan/{id}', 'Admin\PerusahaanController@destroy');

	Route::get('departemen', 'Admin\DepartemenController@index');
	Route::get('departemen/create/', 'Admin\DepartemenController@create');
	Route::post('departemen/store', 'Admin\DepartemenController@store');
	Route::post('departemen/update/{id}', 'Admin\DepartemenController@update');
	Route::delete('departemen/{id}', 'Admin\DepartemenController@destroy');

	Route::get('role', 'Admin\RoleController@index');
	Route::get('role/create/', 'Admin\RoleController@create');
	Route::get('role/getData/', 'Admin\RoleController@getData');
	Route::post('role/store', 'Admin\RoleController@store');
	Route::post('role/update/', 'Admin\RoleController@update');
	Route::delete('role/{id}', 'Admin\RoleController@destroy');

	Route::get('level', 'Admin\LevelController@index');
	Route::get('level/create/', 'Admin\LevelController@create');
	Route::get('level/getData/', 'Admin\LevelController@getData');
	Route::post('level/store', 'Admin\LevelController@store');
	Route::post('level/update/', 'Admin\LevelController@update');
	Route::delete('level/{id}', 'Admin\LevelController@destroy');

	Route::get('jadwal', 'Admin\JadwalController@index');
	Route::get('jadwal/create/', 'Admin\JadwalController@create');
	Route::post('jadwal/store', 'Admin\JadwalController@store');
	Route::get('jadwal/edit/{id}', 'Admin\JadwalController@edit');
	Route::post('jadwal/edit', 'Admin\JadwalController@update');
	Route::delete('jadwal/{id}', 'Admin\JadwalController@destroy');

	Route::get('cuti', 'Admin\CutiController@index');
	Route::get('cuti/create/', 'Admin\CutiController@create');
	Route::post('cuti/store', 'Admin\CutiController@store');
	Route::get('cuti/edit/{id}', 'Admin\CutiController@edit');
	Route::post('cuti/edit', 'Admin\CutiController@update');
	Route::delete('cuti/{id}', 'Admin\CutiController@destroy');

	Route::get('absensi', 'Admin\AbsensiController@index');
	Route::get('absensi/create/', 'Admin\AbsensiController@create');
	Route::post('absensi/store', 'Admin\AbsensiController@store');
	Route::get('absensi/edit/{id}', 'Admin\AbsensiController@edit');
	Route::post('absensi/edit', 'Admin\AbsensiController@update');
	Route::delete('absensi/{id}', 'Admin\AbsensiController@destroy');

	Route::get('settings', 'Admin\SettingsController@index');
	Route::get('settings/create/', 'Admin\SettingsController@create');
	Route::post('settings/store', 'Admin\SettingsController@store');
	Route::get('settings/edit/{id}', 'Admin\SettingsController@edit');
	Route::post('settings/edit', 'Admin\SettingsController@update');
	Route::delete('settings/{id}', 'Admin\SettingsController@destroy');

	Route::get('laporan', 'Admin\LaporanController@index');
	Route::get('laporan/list', 'Admin\LaporanController@list');
	Route::get('laporan/absen', 'Admin\LaporanController@absen');
	Route::get('laporan/getabsen', 'Admin\LaporanController@getabsen');
	Route::get('laporan/cuti', 'Admin\LaporanController@cuti');
	Route::get('laporan/getcuti', 'Admin\LaporanController@getcuti');
	Route::get('laporan/jadwal', 'Admin\LaporanController@jadwal');
	Route::get('laporan/getjadwal', 'Admin\LaporanController@getjadwal');
	Route::get('laporan/profile', 'Admin\LaporanController@destroy');


	Route::get('export/karyawan', 'Admin\ExportsController@karyawan');
	Route::post('export/absensi', 'Admin\ExportsController@absensi');
	Route::post('export/cuti', 'Admin\ExportsController@cuti');
	Route::get('export/ultah', 'Admin\ExportsController@ultah');
	Route::get('export/akun', 'Admin\ExportsController@akun');
	Route::post('export/jadwal', 'Admin\ExportsController@jadwal');

	Route::post('import/perusahaan', 'Admin\ImportController@perusahaan');
	Route::post('import/departemen', 'Admin\ImportController@departemen');
	Route::post('export/cuti', 'Admin\ExportsController@cuti');
	Route::get('export/ultah', 'Admin\ExportsController@ultah');
	Route::get('export/akun', 'Admin\ExportsController@akun');
	Route::post('export/jadwal', 'Admin\ExportsController@jadwal');
});