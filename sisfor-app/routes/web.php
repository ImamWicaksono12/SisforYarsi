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
| AUTH ROUTES (LDAP & SSO Ready)
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginForm')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD & ROLE-BASED ROUTES (Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* --- ADMIN ROUTES --- 
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('beasiswa', BeasiswaController::class)->names([
            'index'   => 'admin.beasiswa.index',
            'create'  => 'admin.beasiswa.create',
            'store'   => 'admin.beasiswa.store',
            'edit'    => 'admin.beasiswa.edit',
            'update'  => 'admin.beasiswa.update',
            'destroy' => 'admin.beasiswa.delete',
        ]);

        Route::controller(PendaftaranController::class)->prefix('pendaftaran')->group(function () {
            Route::get('/', 'adminIndex')->name('admin.pendaftaran.index');
            Route::get('/{id}/verifikasi', 'show')->name('admin.pendaftaran.show');
            Route::put('/{id}/verifikasi', 'verifikasiAdmin')->name('admin.pendaftaran.verifikasi');
            Route::get('/file/{id}', 'viewFile')->name('admin.pendaftaran.view-file');
        });
    });

    /* --- MAHASISWA ROUTES --- 
    */
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'mahasiswaIndex'])->name('mahasiswa.dashboard');
        
        Route::controller(PendaftaranController::class)->group(function () {
            Route::get('/beasiswa', 'index')->name('mahasiswa.beasiswa');
            Route::get('/daftar/{id}', 'daftar')->name('mahasiswa.pendaftaran.form'); 
            Route::post('/daftar/{id}/store', 'store')->name('mahasiswa.pendaftaran.store');
            
            Route::get('/riwayat', 'riwayat')->name('mahasiswa.pendaftaran.riwayat');
        });
    });

    /* --- KAPRODI ROUTES --- 
    */
    Route::middleware('role:kaprodi')->prefix('kaprodi')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'kaprodiIndex'])->name('kaprodi.dashboard');
        
        Route::controller(PendaftaranController::class)->group(function () {
            Route::get('/verifikasi', 'kaprodiIndex')->name('kaprodi.verifikasi.index');
            Route::put('/verifikasi/{id}', 'verifikasiKaprodi')->name('kaprodi.verifikasi.proses');
        });
    });

    /* --- WAREK ROUTES --- 
    */
    Route::middleware('role:warek')->prefix('warek')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warekIndex'])->name('warek.dashboard');
        Route::get('/laporan', [PendaftaranController::class, 'monitoringWarek'])->name('warek.monitoring');
    });
});