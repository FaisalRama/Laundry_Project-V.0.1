<?php

use App\Http\Controllers\AbsensiKerjaController;
use App\Http\Controllers\TbAbsensiKerjaController;
use App\Http\Controllers\aksesorisController;
use App\Http\Controllers\AssignmentlistController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\DatabarangController;
use App\Http\Controllers\GajiKaryawanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JemputlaundryController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenggunaanbarangController;
use App\Http\Controllers\SimuBarangController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\SimulasiTransaksiCucianController;
use App\Http\Controllers\TbDetailTransaksiController;
use App\Http\Controllers\TbMemberController;
use App\Http\Controllers\TbOutletController;
use App\Http\Controllers\TbPaketController;
use App\Http\Controllers\TbTransaksiController;
use App\Http\Controllers\TbUserController;
use App\Http\Controllers\TheTransaksiController;
use App\Http\Controllers\TodomemberController;
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
    Route::resource('the_transaksi', TheTransaksiController::class);
    Route::resource('jemput_laundry', JemputlaundryController::class);
    Route::resource('data_barang', DatabarangController::class);
    Route::resource('penggunaan_barang', PenggunaanbarangController::class);
    Route::resource('absensi_kerja', AbsensiKerjaController::class);
    Route::resource('assignment_list', AssignmentlistController::class);
    Route::post('/status', [JemputlaundryController::class ,'status'])->name('status');
    Route::post('/status/databarang', [DatabarangController::class ,'status'])->name('statusbarang');
    Route::post('/status/penggunaan_barang', [PenggunaanbarangController::class ,'status'])->name('statuspenggunaan');
    Route::post('/status/absensi_kerja', [AbsensiKerjaController::class ,'status'])->name('statusAbsensiKerja');
    Route::get('detail_transaksi', [TbDetailTransaksiController::class, 'index']);
    Route::get('laporan', [LaporanController::class, 'index']);
    Route::get('members/exportPDF/', [TbMemberController::class, 'exportPDF'])->name('exportPDF-member');
    Route::get('outlets/exportPDF/', [TbOutletController::class, 'exportPDF'])->name('exportPDF-outlet');
    Route::get('pakets/exportPDF/', [TbPaketController::class, 'exportPDF'])->name('exportPDF-paket');
    Route::get('jemput_laundries/exportPDF/', [JemputlaundryController::class, 'exportPDF'])->name('exportPDF-jemputlaundry');
    Route::get('databarangs/exportPDF/', [DatabarangController::class, 'exportPDF'])->name('exportPDF-databarang');
    Route::get('barang_inventaris/exportPDF/', [BarangInventarisController::class, 'exportPDF'])->name('exportPDF-baranginventaris');
    Route::get('penggunaan_barangs/exportPDF/', [PenggunaanbarangController::class, 'exportPDF'])->name('exportPDF-gunabarang');
    Route::get('members/export/', [TbMemberController::class, 'export'])->name('export-member');
    Route::get('outlets/export/', [TbOutletController::class, 'export'])->name('export-outlet');
    Route::get('pakets/export/', [TbPaketController::class, 'export'])->name('export-paket');
    Route::get('jemput_laundries/export/', [JemputlaundryController::class, 'export'])->name('export-jenlau');
    Route::get('penggunaan_barangs/export/', [PenggunaanbarangController::class, 'export'])->name('export-gunabarang');
    Route::post('import-excel', [TbMemberController::class, 'import']);
    Route::post('jemput_laundry/import', [JemputlaundryController::class,'importData'])->name('import-jemputan');
    Route::post('penggunaan_barang/import', [PenggunaanbarangController::class,'import'])->name('import-gunabarang');
    Route::get('/download/templatesExcel/jemput_laundry', [JemputlaundryController::class, 'downloadTemplate'])->name('jemput.templatesExcel.download');
    Route::get('/download/templatesExcel/penggunaan_barang', [PenggunaanbarangController::class, 'downloadTemplate'])->name('gunabarang.templatesExcel.download');
    Route::post('import-outlet', [TbOutletController::class,'importData'])->name('import-outlet');
    Route::post('import-paket', [TbPaketController::class,'importData'])->name('import-paket');
    Route::get('data_karyawan', [SimulasiController::class, 'index']);
    Route::get('gaji_karyawan', [GajiKaryawanController::class, 'index']);
    Route::get('simu_barang', [SimuBarangController::class, 'index']);
    Route::get('simulasi_transaksi_cucian', [SimulasiTransaksiCucianController::class, 'index']);
    Route::get('mim', [aksesorisController::class, 'index']);
    // Route::get('/laporan', [TheTransaksiController::class, 'laporan']);
    // Route::get('/laporanbelum', [TransaksiController::class, 'laporanbelum']);

    /** To Do Menu Routes */
    Route::resource('to-do_member', TodomemberController::class);
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