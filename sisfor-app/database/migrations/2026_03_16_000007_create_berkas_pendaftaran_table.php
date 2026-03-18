<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berkas_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')
                ->constrained('pendaftaran')
                ->cascadeOnDelete();
            $table->foreignId('persyaratan_id') 
                ->constrained('persyaratan_beasiswa')
                ->cascadeOnDelete();
            $table->string('nama_berkas');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berkas_pendaftaran');
    }
};