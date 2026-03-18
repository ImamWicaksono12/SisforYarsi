<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('persyaratan_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beasiswa_id')
                ->constrained('beasiswa')
                ->cascadeOnDelete();
            $table->string('nama_persyaratan');
            $table->boolean('wajib')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persyaratan_beasiswa');
    }
};