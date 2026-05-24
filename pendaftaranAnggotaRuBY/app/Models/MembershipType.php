<?php

namespace App\Models;

class MembershipType
{
    /**
     * @return array<int, array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                'name' => 'Anggota UMUM',
                'subtitle' => 'Untuk Mahasiswa atau yang belum memiliki usaha',
                'requirements' => [
                    'Data diri (Nama, Email, WhatsApp)',
                    'KTP/KTM (opsional)',
                ],
                'button_text' => 'Daftar Sebagai UMUM',
                'accent' => 'green',
                'icon' => 'bi-mortarboard',
            ],
            [
                'name' => 'Anggota UTAMA',
                'subtitle' => 'Untuk Pemilik Usaha/UMKM',
                'requirements' => [
                    'Data diri dan usaha',
                    'KTP/KTM (opsional)',
                ],
                'button_text' => 'Daftar Sebagai UTAMA',
                'accent' => 'blue',
                'icon' => 'bi-shop',
            ],
            [
                'name' => 'Anggota PRIORITAS',
                'subtitle' => 'Untuk Pemilik Usaha/UMKM',
                'requirements' => [
                    'Data diri (Nama, Email, WhatsApp)',
                    'KTP/KTM (opsional)',
                ],
                'button_text' => 'Daftar Sebagai PRIORITAS',
                'accent' => 'gold',
                'icon' => 'bi-star',
            ],
        ];
    }
}
