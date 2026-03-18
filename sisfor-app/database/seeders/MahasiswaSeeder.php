<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {

            $user = User::create([
                'name' => 'Mahasiswa '.$i,
                'email' => 'mhs'.$i.'@kampus.ac.id',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'prodi_id' => rand(1,5)
            ]);

            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => '20220'.str_pad($i,3,'0',STR_PAD_LEFT),
                'prodi_id' => rand(1,5),
                'angkatan' => 2022,
                'no_hp' => '081234567'.$i,
                'alamat' => 'Jakarta'
            ]);

        }
    }
}