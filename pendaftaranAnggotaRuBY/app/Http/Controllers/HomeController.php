<?php

namespace App\Http\Controllers;

use App\Models\MembershipType;

class HomeController extends Controller
{
    public function index()
    {
        $benefits = [
            [
                'title' => 'Komunitas Solid',
                'description' => 'Terhubung dengan pelaku UMKM, mentor, serta ekosistem bisnis lokal yang suportif.',
            ],
            [
                'title' => 'Pendampingan Bisnis',
                'description' => 'Akses pelatihan, workshop, dan konsultasi untuk pengembangan usaha berkelanjutan.',
            ],
            [
                'title' => 'Akses Pembiayaan',
                'description' => 'Kesempatan terhubung ke lembaga pembiayaan serta program dukungan dari BUMN.',
            ],
            [
                'title' => 'Pelatihan Digital',
                'description' => 'Tingkatkan kompetensi digital UMKM Anda melalui berbagai pelatihan teknologi dan pemasaran online.',
            ],
        ];

        return view('pages.home', [
            'benefits' => $benefits,
            'membershipTypes' => MembershipType::all(),
        ]);
    }
}
