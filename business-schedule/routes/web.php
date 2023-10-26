<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/business', 'App\Http\Controllers\BusinessController@view')->name('business');
Route::get('/business/create', 'App\Http\Controllers\BusinessController@create')->name('business.form');
Route::get('/business/delete/{id}', 'App\Http\Controllers\BusinessController@delete')->name('business.delete');
Route::post('/store', 'App\Http\Controllers\BusinessController@store')->name('business.store');


Route::get('/branch', 'App\Http\Controllers\BranchController@view')->name('branch');
Route::get('/branch/create', 'App\Http\Controllers\BranchController@create')->name('branch.form');
Route::get('/branch/delete/{id}', 'App\Http\Controllers\BranchController@delete')->name('branch.delete');
Route::get('/branch/view/{id}', 'App\Http\Controllers\BranchController@viewBranchDetail')->name('branch.view');
Route::get('/branch/edit/{id}', 'App\Http\Controllers\BranchController@edit')->name('branch.edit');
Route::post('/branch-store', 'App\Http\Controllers\BranchController@store')->name('branch.store');
Route::post('/branch-update', 'App\Http\Controllers\BranchController@update')->name('branch.update');