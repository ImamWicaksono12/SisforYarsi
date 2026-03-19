<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran'; // Sudah kita perbaiki tadi

    protected $fillable = [
        'mahasiswa_id',
        'beasiswa_id',
        'semester',
        'ipk_manual',
        'jalur_pendaftaran',
        'status',
        'tanggal_daftar'
    ];

    /**
     * Relasi ke Beasiswa (Wajib ada agar tidak error)
     */
    public function beasiswa()
    {
        // Pendaftaran ini milik sebuah Beasiswa
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }

    /**
     * Relasi ke BerkasPendaftaran
     */
    public function berkas()
    {
        return $this->hasMany(BerkasPendaftaran::class, 'pendaftaran_id');
    }

    /**
     * Relasi ke Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}