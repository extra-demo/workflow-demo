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

Route::get('/show', 'App\Http\Controllers\Controller@show');
Route::get('/close', 'App\Http\Controllers\Controller@close');
Route::get('/upload', 'App\Http\Controllers\Controller@upload');
Route::get('/reject', 'App\Http\Controllers\Controller@reject');
Route::get('/submit', 'App\Http\Controllers\Controller@submit');
Route::get('/adminConfirm', 'App\Http\Controllers\Controller@adminConfirm');
Route::get('/customerReject', 'App\Http\Controllers\Controller@customerReject');
Route::get('/customerConfirm', 'App\Http\Controllers\Controller@customerConfirm');
Route::get('/reset', 'App\Http\Controllers\Controller@reset');
Route::get('/img', 'App\Http\Controllers\Controller@img');
Route::get('/show-flow', 'App\Http\Controllers\Controller@showFlow');
