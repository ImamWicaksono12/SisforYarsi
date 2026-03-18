<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_prodi' => 'Informatika', 'fakultas' => 'Teknologi Informasi'],
            ['nama_prodi' => 'Sistem Informasi', 'fakultas' => 'Teknologi Informasi'],
            ['nama_prodi' => 'Manajemen', 'fakultas' => 'Ekonomi'],
            ['nama_prodi' => 'Akuntansi', 'fakultas' => 'Ekonomi'],
            ['nama_prodi' => 'Kedokteran', 'fakultas' => 'Kedokteran']
        ];

        foreach ($data as $item) {
            Prodi::create($item);
        }
    }
}