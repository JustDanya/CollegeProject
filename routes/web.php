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
    return view('welcome');
});

Route::resource('/contr', 'MyFirstCon')->names('conTest');

Auth::routes();

Route::resource('/user', 'UserCon')->only(['index', 'show', 'destroy'])->names('conUse');

Route::resource('/search', 'Searcher')->only(['index'])->names('search');