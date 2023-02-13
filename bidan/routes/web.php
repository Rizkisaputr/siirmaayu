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

/*
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
*/

Route::get('/', 'HomeController@index');
Route::get('dashboard', 'HomeController@index')->name('dashboard');

foreach(array('user','provinsi','kabupaten','kecamatan','desa','pendidikan','ibu','kohort','puskesmas','kader','posyandu','bidan','k1') as $m)
{
Route::get($m, ucwords($m).'Controller@index')->name($m);
Route::get($m.'/table', ucwords($m).'Controller@table')->name($m.'Table');
Route::get($m.'/create', ucwords($m).'Controller@create')->name($m.'Create');
Route::post($m.'/write', ucwords($m).'Controller@write')->name($m.'Write');
Route::get($m.'/edit/{id}', ucwords($m).'Controller@edit')->name($m.'Edit');
Route::get($m.'/delete/{id}', ucwords($m).'Controller@delete')->name($m.'Delete');
}

Route::get('periksa/{ibu}', 'PeriksaController@index')->name('periksa');
Route::post('periksa/write', 'PeriksaController@write')->name('periksaWrite');
Route::get('periksa/hitung/{bulan}/{tahun}', 'PeriksaController@hitung')->name('periksaHitung');

Route::get('antenatalcare/{periksa}', 'AnteNatalCareController@table')->name('anteNatalCareTable');
Route::get('antenatalcare/{periksa}/create', 'AnteNatalCareController@create')->name('anteNatalCareCreate');
Route::get('antenatalcare/edit/{id}', 'AnteNatalCareController@edit')->name('anteNatalCareEdit');
Route::get('antenatalcare/delete/{id}', 'AnteNatalCareController@delete')->name('anteNatalCareDelete');
Route::post('antenatalcare/write', 'AnteNatalCareController@write')->name('anteNatalCareWrite');

Route::get('postnatal/{periksa}', 'PostNatalController@table')->name('postNatalTable');
Route::get('postnatal/{periksa}/create', 'PostNatalController@create')->name('postNatalCreate');
Route::get('postnatal/edit/{id}', 'PostNatalController@edit')->name('postNatalEdit');
Route::get('postnatal/delete/{id}', 'PostNatalController@delete')->name('postNatalDelete');
Route::post('postnatal/write', 'PostNatalController@write')->name('postNatalWrite');

foreach(array('provinsi','kabupaten','kecamatan','desa','kader','puskesmas','posyandu','bidan') as $m)
{
  Route::get($m.'/dropdown', ucwords($m).'Controller@dropdown')->name($m.'Dropdown');
}
Route::get('ibu/dropdown/{id}', 'IbuController@dropdown')->name('ibuDdown');
Route::get('pwstarget', 'PwstargetController@index')->name('pwstarget');
Route::get('pwstarget/table', 'PwstargetController@table')->name('pwstargetTable');
Route::post('pwstarget/write', 'PwstargetController@write')->name('pwstargetWrite');
Route::get('pws', 'PwsController@index')->name('pws');
Route::get('pws/table', 'PwsController@table')->name('pwsTable');
Route::get('pws/cetak', 'PwsController@cetak')->name('pwsCetak');
Route::get('pws/target', 'PwsController@target')->name('target');
Route::get('pws/target/table', 'PwsController@targetTable')->name('targetTable');
Route::post('pws/target/write', 'PwsController@targetWrite')->name('targetWrite');

Route::post('kecamatan/import', 'KecamatanController@import')->name('kecamatanImport');
Route::post('desa/import', 'DesaController@import')->name('desaImport');
Route::post('puskesmas/import', 'PuskesmasController@import')->name('puskesmasImport');

Route::get('/storagelink', function () {
    Artisan::call('storage:link');
});
