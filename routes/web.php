<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PanelPembangunanController;
use App\Http\Controllers\Frontend\PanelSpesifikasiController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/pembangunan-renovasi', [PanelPembangunanController::class, 'index'])->name('pembangunan-renovasi');
Route::get('/spesifikasi-standar', [PanelSpesifikasiController::class, 'index'])->name('spesifikasi-standar');