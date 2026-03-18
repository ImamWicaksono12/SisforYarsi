<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('mahasiswa_id')
                ->constrained('mahasiswa')
                ->cascadeOnDelete();

            $table->foreignId('beasiswa_id')
                ->constrained('beasiswa')
                ->cascadeOnDelete();

            // ✅ TAMBAHAN (FIX ERROR)
            $table->integer('semester');

            $table->enum('jalur_pendaftaran', [
                'seleksi',
                'mandiri_sk',
                'antrean'
            ]);

            $table->date('tanggal_daftar');

            $table->enum('status', [
                'pending',
                'validasi_admin',
                'validasi_kaprodi',
                'diterima',
                'ditolak'
            ])->default('pending');

            $table->text('catatan_validasi')->nullable();
            $table->string('file_sk_penetapan')->nullable();
            $table->text('essay')->nullable();
            $table->decimal('ipk_manual',3,2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};