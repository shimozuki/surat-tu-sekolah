<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin Surat Masuk',
                'email' => 'suratm@gmail.com',
                'ttd' => 'default.png',
                'role' => 0,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Admin Surat Keluar',
                'email' => 'suratk@gmail.com',
                'ttd' => 'default.png',
                'role' => 1,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Kepala Sekolah',
                'email' => 'kepala@gmail.com',
                'ttd' => 'default.png',
                'role' => 2,
                'password' => bcrypt('password'),
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
