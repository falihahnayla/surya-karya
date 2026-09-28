<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PanelPembangunanController;
use App\Http\Controllers\Frontend\PanelSpesifikasiController;
use App\Http\Controllers\Frontend\AlurKerjaController;
use App\Http\Controllers\Frontend\FormPesanController;
use App\Http\Controllers\Frontend\PortofolioController;

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