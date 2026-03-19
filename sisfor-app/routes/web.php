<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\admin\DashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::view('/beasiswa', 'public.beasiswa')->name('public.beasiswa');
Route::view('/alur', 'public.alur')->name('public.alur');
Route::view('/bantuan', 'public.bantuan')->name('public.bantuan');
Route::view('/faq', 'public.faq')->name('public.faq');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login')->middleware('guest');
    Route::post('/login', 'login')->middleware('guest');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Requires Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* --- 1. ADMIN ROUTES --- */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('beasiswa', BeasiswaController::class);

        Route::controller(PendaftaranController::class)->prefix('pendaftaran')->name('pendaftaran.')->group(function () {
            Route::get('/', 'adminIndex')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/{id}/verifikasi', 'verifikasiAdmin')->name('verifikasi');
            Route::get('/file/{id}', 'viewFile')->name('view-file');
        });
    });

    /* --- 2. MAHASISWA ROUTES --- */
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'mahasiswaIndex'])->name('dashboard');
        
        Route::controller(PendaftaranController::class)->group(function () {
            // Dashboard daftar beasiswa yang tersedia
            Route::get('/beasiswa', 'index')->name('beasiswa');
            
            // Proses pendaftaran
            Route::get('/daftar/{id}', 'daftar')->name('pendaftaran.form'); 
            Route::post('/daftar/{id}', 'store')->name('pendaftaran.store'); 
            
            // Riwayat & Pembatalan
            Route::get('/riwayat', 'riwayat')->name('pendaftaran.riwayat');
            // INI PERBAIKANNYA: Tambahkan route pembatalan
            Route::delete('/riwayat/{id}/cancel', 'cancel')->name('pendaftaran.cancel');
            
            // Akses File
            Route::get('/berkas/{id}', 'viewFile')->name('pendaftaran.view-file');
        });
    });

    /* --- 3. KAPRODI ROUTES --- */
    Route::middleware('role:kaprodi')->prefix('kaprodi')->name('kaprodi.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'kaprodiIndex'])->name('dashboard');
        
        Route::controller(PendaftaranController::class)->prefix('verifikasi')->name('verifikasi.')->group(function () {
            Route::get('/', 'kaprodiIndex')->name('index');
            Route::put('/{id}', 'verifikasiKaprodi')->name('proses');
            Route::get('/file/{id}', 'viewFile')->name('view-file');
        });
    });

    /* --- 4. WAREK ROUTES --- */
    Route::middleware('role:warek')->prefix('warek')->name('warek.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warekIndex'])->name('dashboard');
        Route::get('/laporan', [PendaftaranController::class, 'monitoringWarek'])->name('monitoring');
        Route::get('/file/{id}', [PendaftaranController::class, 'viewFile'])->name('view-file');
    });
});