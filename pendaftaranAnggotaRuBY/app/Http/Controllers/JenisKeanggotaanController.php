<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisKeanggotaanController extends Controller
{
    public function index()
{
    return view('pages.jeniskeanggotaan');
}
}
