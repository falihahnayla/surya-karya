<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PanelPembangunanController;
use App\Http\Controllers\Frontend\PanelSpesifikasiController;
use App\Http\Controllers\Frontend\AlurKerjaController;
use App\Http\Controllers\Frontend\FormPesanController;
use App\Http\Controllers\Frontend\PortofolioController;

use App\Http\Controllers\Admin\PembangunanController;
use App\Http\Controllers\Admin\RenovasiController;
use App\Http\Controllers\Admin\SpesifikasiBangunanController;
use App\Http\Controllers\Admin\StandarMutuController;
use App\Http\Controllers\Admin\PortofolioCategoryController;
use App\Http\Controllers\Admin\PortofolioController as AdminPortofolioController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\HeroTitleController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portofolio', [PortofolioController::class, 'index'])->name('portofolio');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/pembangunan-renovasi', [PanelPembangunanController::class, 'index'])->name('pembangunan-renovasi');
Route::get('/pembangunan', [PanelPembangunanController::class, 'pembangunan'])->name('pembangunan');
Route::get('/renovasi', [PanelPembangunanController::class, 'renovasi'])->name('renovasi');
Route::get('/spesifikasi-standar', [PanelSpesifikasiController::class, 'index'])->name('spesifikasi-standar');
Route::get('/spesifikasi-bangunan', [PanelSpesifikasiController::class, 'spesifikasiBangunan'])->name('spesifikasi-bangunan');
Route::get('/standar-mutu', [PanelSpesifikasiController::class, 'standarMutu'])->name('standar-mutu');
Route::get('/alur-kerja', [AlurKerjaController::class, 'index'])->name('alur-kerja');
Route::get('/form-pemesanan', [FormPesanController::class, 'index'])->name('frontend.form-pesanan');

/*
|--------------------------------------------------------------------------
| Admin Routes (Part Naila)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.pembangunan.index');
    });

    Route::resource('pembangunan', PembangunanController::class);
    Route::resource('renovasi', RenovasiController::class);
    Route::resource('spesifikasi-bangunan', SpesifikasiBangunanController::class);
    Route::resource('standar-mutu', StandarMutuController::class);
    Route::resource('portofolio-category', PortofolioCategoryController::class);
    Route::resource('portofolio', AdminPortofolioController::class);
    
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    
    Route::resource('media', MediaController::class);
    Route::resource('hero-title', HeroTitleController::class);
});