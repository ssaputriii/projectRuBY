<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Registration::count();
        $byCategory = [
            'UMUM' => Registration::where('umkm_category', 'UMUM')->count(),
            'UTAMA' => Registration::where('umkm_category', 'UTAMA')->count(),
            'PRIORITAS' => Registration::where('umkm_category', 'PRIORITAS')->count(),
        ];
        $latest = Registration::latest()->take(5)->get();

        return view('admin.dashboard', compact('total', 'byCategory', 'latest'));
    }
}

