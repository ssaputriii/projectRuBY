<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'question' => 'Apa itu Rumah BUMN Yogyakarta?',
                'answer' => 'Rumah BUMN Yogyakarta adalah pusat pengembangan dan pemberdayaan UMKM yang didukung oleh BUMN untuk menciptakan ekosistem wirausaha yang berkelanjutan dan berdaya saing di Yogyakarta.'
            ],
            [
                'question' => 'Siapa saja yang bisa mendaftar menjadi anggota?',
                'answer' => 'Pendaftaran terbuka untuk mahasiswa, individu yang ingin mulai berwirausaha (Anggota Umum), UMKM yang sedang berkembang (Anggota Utama), hingga UMKM yang siap ekspansi pasar (Anggota Prioritas).'
            ],
            [
                'question' => 'Apa saja syarat pendaftaran menjadi anggota?',
                'answer' => 'Syarat umum meliputi identitas diri (KTP/KTM). Untuk Anggota Utama dan Prioritas, diperlukan data tambahan seperti legalitas usaha, NPWP, dan profil usaha. Detail persyaratan dapat dilihat di halaman Jenis Keanggotaan.'
            ],
            [
                'question' => 'Apakah ada biaya untuk menjadi anggota?',
                'answer' => 'Program pendaftaran dan keanggotaan dasar di Rumah BUMN Yogyakarta tidak dipungut biaya. Kami berfokus pada pemberdayaan dan pengembangan UMKM.'
            ],
            [
                'question' => 'Fasilitas apa saja yang didapatkan anggota?',
                'answer' => 'Anggota akan mendapatkan akses ke berbagai program pelatihan, workshop, pendampingan bisnis, networking, informasi peluang pasar, hingga akses pembiayaan yang didukung oleh BUMN.'
            ],
            [
                'question' => 'Bagaimana cara menghubungi admin jika ada kendala?',
                'answer' => 'Anda dapat menghubungi kami melalui halaman Kontak, via WhatsApp di nomor 085161609877, atau datang langsung ke Lt. 2 Wisma BRI, Jl. Sagan Tim. No.123, Yogyakarta.'
            ]
        ];

        return view('pages.faq', compact('faqs'));
    }
}
