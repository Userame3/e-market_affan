<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengajuanBarangController;
use App\Models\PengajuanBarang;
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

Route::get('home', [HomeController::class, 'home']);
Route::get('data', [HomeController::class, 'data']);
Route::get('transaksi', [HomeController::class, 'transaksi']);
Route::get('laporan', [HomeController::class, 'laporan']);
Route::resource('pengajuan', PengajuanBarangController::class);
Route::get('exportpengajuan', [PengajuanBarangController::class, 'pengajuanExport'])->name('exportpengajuan');
Route::get('pdfpengajuan', [PengajuanBarangController::class, 'pengajuanPdf'])->name('pdfpengajuan');
Route::post('/import', [PengajuanBarangController::class, 'pengajuanImport'])->name('pengajuan.import');
// Route::post('importPengajuan', [PengajuanBarangController::class, 'pengajuanImport'])->name('importPengajuan');