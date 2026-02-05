<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Siswa 1',
            'email' => 'siswa1@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'nis' => 12345678,
            'kelas' => 'XII RPL 1',
        ]);

        User::create([
            'name' => 'Siswa 2',
            'email' => 'siswa2@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'siswa',
            'nis' => 87654321,
            'kelas' => 'XI TKJ 2',
        ]);
    }
}
