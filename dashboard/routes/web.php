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

Route::get('/', 'DashboardController@index');
Route::get('chart', 'DashboardController@chart')->name('chart');
Route::post('pdf', 'DashboardController@pdf')->name('pdf');
Route::post('generate', 'DashboardController@generate')->name('generate');
Route::get('listen/{type}', 'DashboardController@listen')->name('listen');
Route::post('excel', 'DashboardController@excel')->name('excel');
