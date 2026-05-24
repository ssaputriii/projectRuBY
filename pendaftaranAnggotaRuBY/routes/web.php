<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisKeanggotaanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/jenis-keanggotaan', [JenisKeanggotaanController::class, 'index'])->name('jenis.keanggotaan');

Route::get('/daftar/umum', [PendaftaranController::class, 'showUmumForm'])->name('pendaftaran.umum');
Route::get('/daftar/utama', [PendaftaranController::class, 'showUtamaForm'])->name('pendaftaran.utama');
Route::get('/daftar/prioritas', [PendaftaranController::class, 'showPrioritasForm'])->name('pendaftaran.prioritas');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('pendaftaran.submit');
Route::get('/daftar/sukses', [PendaftaranController::class, 'success'])->name('pendaftaran.sukses');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::post('/verify-export-password', [AdminRegistrationController::class, 'verifyPassword'])->name('verify-password');

        Route::get('/pendaftaran', [AdminRegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/pendaftaran/export', [AdminRegistrationController::class, 'export'])->name('registrations.export');
        Route::get('/detail/{registration}', [AdminRegistrationController::class, 'show'])->name('registrations.show');
        Route::get('/detail/{registration}/edit', [AdminRegistrationController::class, 'edit'])->name('registrations.edit');
        Route::put('/detail/{registration}', [AdminRegistrationController::class, 'update'])->name('registrations.update');
        Route::get('/detail/{registration}/pdf', [AdminRegistrationController::class, 'exportPdf'])->name('registrations.pdf');
        Route::delete('/detail/{registration}', [AdminRegistrationController::class, 'destroy'])->name('registrations.destroy');

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');