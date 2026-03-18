<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersyaratanBeasiswa;
use App\Models\Beasiswa;

class PersyaratanBeasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua beasiswa yang ada
        $beasiswas = Beasiswa::all();

        foreach ($beasiswas as $index => $beasiswa) {

            // Mapping persyaratan berdasarkan urutan / contoh
            $persyaratanList = match($index) {
                0 => [
                    ['nama' => 'KHS', 'wajib' => true],
                    ['nama' => 'KTM', 'wajib' => true],
                    ['nama' => 'Surat Rekomendasi', 'wajib' => false],
                ],
                1 => [
                    ['nama' => 'KHS', 'wajib' => true],
                    ['nama' => 'Slip Gaji Orang Tua', 'wajib' => true],
                ],
                default => [
                    ['nama' => 'Transkrip Nilai Terakhir', 'wajib' => true],
                    ['nama' => 'Sertifikat Prestasi/Kursus', 'wajib' => true],
                    ['nama' => 'Foto Rumah Tampak Depan', 'wajib' => false],
                ]
            };

            foreach ($persyaratanList as $item) {
                PersyaratanBeasiswa::updateOrCreate(
                    [
                        'beasiswa_id' => $beasiswa->id,
                        'nama_persyaratan' => $item['nama']
                    ],
                    [
                        'wajib' => $item['wajib']
                    ]
                );
            }
        }
    }
}