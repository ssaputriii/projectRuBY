<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Landing Pages
|--------------------------------------------------------------------------
*/

use App\Livewire\Landing\Home;
use App\Livewire\Landing\Informasi;
use App\Livewire\Landing\Alur;
use App\Livewire\Landing\Daftar;
use App\Livewire\Landing\Kontak;
use App\Livewire\Landing\DivisiComponent;
use App\Livewire\Landing\CekPendaftar;
use App\Livewire\Landing\Success;

Route::get('/divisi', DivisiComponent::class)->name('divisi');

Route::get('/', Home::class)->name('home');
Route::get('/informasi', Informasi::class)->name('informasi');
Route::get('/alur', Alur::class)->name('alur');
Route::get('/daftar', Daftar::class)->name('daftar');
Route::get('/daftar/success', Success::class)->name('daftar.success');
Route::get('/kontak', Kontak::class)->name('kontak');
Route::get('/cek-pendaftar', CekPendaftar::class)->name('cek-pendaftar');


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

use App\Livewire\Admin\Auth\Login;

Route::get('/admin/login', Login::class)->name('admin.login');


/*
|--------------------------------------------------------------------------
| Admin Area (Protected)
|--------------------------------------------------------------------------
*/

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Batch\Index as BatchIndex;
use App\Livewire\Admin\Peserta\Index as PesertaIndex;
use App\Livewire\Admin\Peserta\Detail as PesertaDetail;
use App\Http\Controllers\Admin\ExportController;


Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Batch
    Route::get('/batch', BatchIndex::class)->name('batch.index');

    // Peserta
    Route::get('/peserta', PesertaIndex::class)->name('peserta.index');
    Route::get('/peserta/{id}', PesertaDetail::class)->name('peserta.detail');
    

    // Export
    Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');

});
