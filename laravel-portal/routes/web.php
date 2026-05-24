<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/daftar-magang', function () {
    return "Halaman Pendaftaran Magang (Coming Soon)";
})->name('daftar.magang');

Route::get('/pendaftaran-anggota-ruby', function () {
    // Pastikan project pendaftaranAnggotaRuBY sudah di-serve (misal via Herd atau php artisan serve)
    // Jika menggunakan Herd, biasanya alamatnya adalah http://pendaftarananggotaruby.test atau http://pendaftaran-anggota-ruby.test
    return redirect('http://127.0.0.1:9000');
})->name('pendaftaranAnggotaRuBY');

Route::get('/admin/login', function () {
    return "Halaman Login Admin (Coming Soon)";
})->name('admin.login');

Route::get('/admin/dashboard', function () {
    return "Halaman Dashboard Admin (Coming Soon)";
})->name('admin.dashboard');
