<?php

use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JemputlaundryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TbDetailTransaksiController;
use App\Http\Controllers\TbMemberController;
use App\Http\Controllers\TbOutletController;
use App\Http\Controllers\TbPaketController;
use App\Http\Controllers\TbTransaksiController;
use App\Http\Controllers\TbUserController;
use App\Policies\TbMemberPolicy;
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

// Route::middleware(['auth'])->group(function(){
//     Route::get('home', [HomeController::class, 'index']);
//     Route::resource('detail_transaksi', TbDetailTransaksiController::class);
//     Route::resource('member', TbMemberController::class);
//     Route::resource('outlet', TbOutletController::class);
//     Route::resource('paket', TbPaketController::class);
//     Route::resource('transaksi', TbTransaksiController::class);
//     Route::resource('user', TbUserController::class);
// });

// Route Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenthicate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route Baru Serapan Middleware
Route::group(['prefix' => 'a', 'middleware' => ['isAdmin', 'auth']],
function(){
    Route::get('home', [HomeController::class, 'index'])->name('a.home');
    Route::resource('barang_investaris', BarangInventarisController::class);
    Route::resource('member', TbMemberController::class);
    Route::resource('paket', TbPaketController::class);
    Route::resource('outlet', TbOutletController::class);
    Route::resource('transaksi', TbTransaksiController::class);
    Route::resource('jemput_laundry', JemputlaundryController::class);
    Route::post('/status', [JemputlaundryController::class ,'status'])->name('status');
    Route::get('detail_transaksi', [TbDetailTransaksiController::class, 'index']);
    Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('members/export/', [TbMemberController::class, 'export'])->name('export-member');
    Route::get('outlets/export/', [TbOutletController::class, 'export'])->name('export-outlet');
    Route::get('pakets/export/', [TbPaketController::class, 'export'])->name('export-paket');
    Route::get('jemput_laundries/export/', [JemputlaundryController::class, 'export'])->name('export-jenlau');
    Route::post('import-excel', [TbMemberController::class, 'import']);
    Route::get('data_karyawan', [SimulasiController::class, 'index']);
    Route::get('gaji_karyawan', [GajiKaryawanController::class, 'index']);
});

Route::group(['prefix' => 'k', 'middleware' =>['isKasir', 'auth']], 
function(){
    Route::get('home', [HomeController::class, 'index'])->name('k.home');
    Route::resource('member', TbMemberController::class);
    Route::get('paket', [TbPaketController::class, 'index']);
    Route::resource('transaksi', TbTransaksiController::class);
    Route::get('detail_transaksi', [TbDetailTransaksiController::class, 'index']);
    Route::get('laporan', [LaporanController::class, 'index']);
});

Route::group(['prefix' => 'o', 'middleware'=>['isOwner', 'auth']], function(){
    Route::get('home', [HomeController::class, 'index'])->name('o.home');
    Route::get('laporan', [LaporanController::class, 'index']);
});