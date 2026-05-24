<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'rumahbumnyk1@gmail.com'],
            [
                'name' => 'Admin Rumah BUMN',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );
    }
}

