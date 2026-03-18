<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Beasiswa;

class BeasiswaSeeder extends Seeder
{
    public function run(): void
    {

        $data = [
            [
                'nama' => 'Beasiswa Prestasi',
                'sumber_beasiswa' => 'Kampus',
                'deskripsi' => 'Beasiswa untuk mahasiswa berprestasi',
                'benefit' => 'Gratis UKT',
                'tipe_beasiswa' => 'fully_funded',
                'kuota' => 20,
                'diperuntukan' => 'mahasiswa_aktif',
                'periode' => '2026',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-03-01',
                'status' => 'buka'
            ],
            [
                'nama' => 'Beasiswa KIP',
                'sumber_beasiswa' => 'Pemerintah',
                'deskripsi' => 'Bantuan biaya pendidikan',
                'benefit' => 'Uang saku + UKT',
                'tipe_beasiswa' => 'fully_funded',
                'kuota' => 30,
                'diperuntukan' => 'mahasiswa_aktif',
                'periode' => '2026',
                'tanggal_mulai' => '2026-01-01',
                'tanggal_selesai' => '2026-04-01',
                'status' => 'buka'
            ]
        ];

        foreach ($data as $item) {
            Beasiswa::create($item);
        }
    }
}