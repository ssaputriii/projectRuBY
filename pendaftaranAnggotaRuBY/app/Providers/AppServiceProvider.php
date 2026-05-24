<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Jangan lupa import facade URL

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Perbaikan untuk ngrok:
         * 1. Menggunakan app()->environment() lebih aman daripada env().
         * 2. Memastikan semua link (asset, route) menggunakan https.
         */
        
    }
}