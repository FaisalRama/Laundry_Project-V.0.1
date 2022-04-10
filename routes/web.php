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
use App\Http\Controllers\TodoabsensiKerjaKaryawanController;
use App\Http\Controllers\TodobarangInventarisController;
use App\Http\Controllers\TododatabarangController;
use App\Http\Controllers\TodomemberController;
use App\Http\Controllers\TodooutletController;
use App\Http\Controllers\TodopaketController;
use App\Http\Controllers\TodopenggunaanBarangController;
use App\Http\Controllers\TodopenjemputanLaundryController;
use App\Http\Controllers\TodouserController;
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
    /** to do member */
    Route::resource('to-do_member', TodomemberController::class);
    Route::post('to-do_member/beres_tugas', [TodomemberController::class, 'updateCheck'])->name('beres_tugas_member');
    /** to do outlet */
    Route::resource('to-do_outlet', TodooutletController::class);
    Route::post('to-do_outlet/beres_tugas', [TodooutletController::class, 'updateCheck'])->name('beres_tugas_outlet');
    /** to do paket */
    Route::resource('to-do_paket', TodopaketController::class);
    Route::post('to-do_paket/beres_tugas', [TodopaketController::class, 'updateCheck'])->name('beres_tugas_paket');
    /** to do penjemputan laundry */
    Route::resource('to-do_jemput_laundry', TodopenjemputanLaundryController::class);
    Route::post('to-do_jemput_laundry/beres_tugas', [TodopenjemputanLaundryController::class, 'updateCheck'])->name('beres_tugas_penjemputan_laundry');
    /** to do data barang */
    Route::resource('to-do_data_barang', TododatabarangController::class);
    Route::post('to-do_data_barang/beres_tugas', [TododatabarangController::class, 'updateCheck'])->name('beres_tugas_databarang');
    /** to do penggunaan barang */
    Route::resource('to-do_penggunaan_barang', TodopenggunaanBarangController::class);
    Route::post('to-do_penggunaan_barang/beres_tugas', [TodopenggunaanBarangController::class, 'updateCheck'])->name('beres_tugas_penggunaan_barang');
    /** to do absensi kerja karyawan */
    Route::resource('to-do_absensi_kerja', TodoabsensiKerjaKaryawanController::class);
    Route::post('to-do_absensi_kerja/beres_tugas', [TodoabsensiKerjaKaryawanController::class, 'updateCheck'])->name('beres_tugas_absensi_kerja_karyawan');
    /** to do barang inventaris */
    Route::resource('to-do_barang_inventaris', TodobarangInventarisController::class);
    Route::post('to-do_barang_inventaris/beres_tugas', [TodobarangInventarisController::class, 'updateCheck'])->name('beres_tugas_barang_inventaris');
    /** to do user */
    Route::resource('to-do_user', TodouserController::class);
    Route::post('to-do_user/beres_tugas', [TodouserController::class, 'updateCheck'])->name('beres_tugas_user');
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