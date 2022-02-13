<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TbDetailTransaksiController;
use App\Http\Controllers\TbMemberController;
use App\Http\Controllers\TbOutletController;
use App\Http\Controllers\TbPaketController;
use App\Http\Controllers\TbTransaksiController;
use App\Http\Controllers\TbUserController;
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


// Rute Home dan Login
Route::middleware(['auth'])->group(function(){
    Route::get('home', [HomeController::class, 'index']);
    Route::resource('detail_transaksi', TbDetailTransaksiController::class);
    Route::resource('member', TbMemberController::class);
    Route::resource('outlet', TbOutletController::class);
    Route::resource('paket', TbPaketController::class);
    Route::resource('transaksi', TbTransaksiController::class);
    Route::resource('user', TbUserController::class);

});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenthicate']);
Route::post('logout', [LoginController::class, 'logout']);
