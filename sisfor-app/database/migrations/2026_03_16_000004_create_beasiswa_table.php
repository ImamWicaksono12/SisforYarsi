<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();

            // BASIC INFO
            $table->string('nama');
            $table->string('sumber_beasiswa');

            // DESKRIPSI
            $table->text('deskripsi')->nullable();
            $table->text('benefit')->nullable();

            // TIPE
            $table->enum('tipe_beasiswa', [
                'fully_funded',
                'partial_funded',
                'one_shot'
            ]);

            // KUOTA
            $table->integer('kuota')->nullable();

            // TARGET
            $table->enum('diperuntukan', [
                'calon_mahasiswa',
                'mahasiswa_aktif'
            ]);

            // PERIODE
            $table->string('periode');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            // STATUS BEASISWA
            $table->enum('status', [
                'aktif',
                'nonaktif',
                'buka',
                'tutup'
            ])->default('aktif');

            // MONITORING (khusus warek lihat)
            $table->boolean('is_monitoring_open')->default(false);

            // LINK INFO - Diubah ke text agar aman untuk URL yang sangat panjang
            $table->text('link_informasi')->nullable();

            // GAMBAR
            $table->string('gambar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beasiswa');
    }
};