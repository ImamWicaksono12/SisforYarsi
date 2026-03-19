<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran'; 

    protected $fillable = [
        'mahasiswa_id',
        'beasiswa_id',
        'semester',
        'jalur_pendaftaran',
        'tanggal_daftar',
        'status',           
        'catatan',          
        'ipk_manual',
        'essay',           
        'file_sk_penetapan' 
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'ipk_manual' => 'float',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class, 'beasiswa_id');
    }

    public function berkasPendaftaran()
    {
        // Pastikan foreign key-nya benar 'pendaftaran_id'
        return $this->hasMany(BerkasPendaftaran::class, 'pendaftaran_id');
    }
}