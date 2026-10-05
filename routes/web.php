<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PanelPembangunanController;
use App\Http\Controllers\Frontend\PanelSpesifikasiController;
use App\Http\Controllers\Frontend\AlurKerjaSamaController;
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
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AlurKerjaController;
use App\Http\Controllers\Admin\FaqAdminController;
use App\Http\Controllers\Admin\FaqCategoryAdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QuickLinkController;

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
Route::get('/alur-kerja', [AlurKerjaSamaController::class, 'index'])->name('alur-kerja');
Route::get('/form-pemesanan', [FormPesanController::class, 'index'])->name('frontend.form-pesanan');
Route::post('/form-pemesanan', [FormPesanController::class, 'store'])->name('frontend.form-pesanan.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::resource('visi-misi', VisiMisiController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('home', AdminHomeController::class);
    Route::resource('alur-kerja', AlurKerjaController::class);
    Route::resource('faqs', FaqAdminController::class);
    Route::resource('faq_categories', FaqCategoryAdminController::class);

    // BARU: menampilkan foto pesanan tanpa perlu storage:link
    Route::get('orders/{order}/file/{type}', [OrderController::class, 'file'])
        ->whereIn('type', ['denah', 'lahan'])
        ->name('orders.file');

    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    Route::resource('orders', OrderController::class);
    Route::resource('layanan', LayananController::class)->except('show');
    Route::resource('quick-links', QuickLinkController::class)->except('show');
});
