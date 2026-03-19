<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPendaftaran extends Model
{
    use HasFactory;
    protected $table = 'berkas_pendaftaran';

    protected $fillable = [
        'pendaftaran_id',
        'persyaratan_id', 
        'file_path',
        'status_berkas'  
    ];

    /**
     * Relasi ke Pendaftaran Utama
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }

    /**
     * Relasi ke Master Persyaratan
     * Memungkinkan kita mengambil nama persyaratan (Contoh: "KTP", "IPK")
     */
    public function persyaratan()
    {
        return $this->belongsTo(PersyaratanBeasiswa::class, 'persyaratan_id');
    }
}