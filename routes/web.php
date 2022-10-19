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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('login', [App\Http\Controllers\Auth\LoginController::class,'show'])->name('login');
Route::get('oauth/{driver}', [App\Http\Controllers\Auth\LoginController::class,'redirectToProvider'])->name('social.oauth');
Route::get('oauth/{driver}/callback', [App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback'])->name('social.callback');

Route::resource('category', App\Http\Controllers\HomeController::class);
Route::post('/store_stock_quote', [App\Http\Controllers\HomeController::class, 'store_stock_quote'])->name('store_stock_quote');


Route::post('stock_quote/delete', [App\Http\Controllers\HomeController::class, 'destroy']);




