<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitoring', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')
                ->constrained('pendaftaran')
                ->cascadeOnDelete();
            $table->integer('semester');
            $table->string('file_khs');
            $table->decimal('ipk',3,2);
            $table->text('kegiatan_organisasi')->nullable();
            $table->text('laporan')->nullable();
            $table->enum('status_monitoring',[
                'pending',
                'valid_kaprodi',
                'ditolak'
            ])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitoring');
    }
};