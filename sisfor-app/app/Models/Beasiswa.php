<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $fillable = [
        'nama',
        'sumber_beasiswa',
        'deskripsi',
        'benefit',
        'tipe_beasiswa',
        'kuota',
        'diperuntukan',
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'is_monitoring_open',
        'link_informasi',
        'gambar'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_monitoring_open' => 'boolean',
        'kuota' => 'integer',
    ];

    /**
     * FITUR KEAMANAN: Model Events
     * Mencegah data "yatim" di database saat admin melakukan CRUD.
     */
    protected static function booted()
    {
        static::deleting(function ($beasiswa) {
            // Menghapus otomatis semua persyaratan jika beasiswa dihapus
            $beasiswa->persyaratan()->delete();
            // Menghapus otomatis data pendaftaran terkait untuk menjaga integritas
            $beasiswa->pendaftaran()->delete();
        });
    }

    public function persyaratan()
    {
        // Menambahkan foreign key secara eksplisit jika diperlukan untuk keamanan relasi
        return $this->hasMany(PersyaratanBeasiswa::class, 'beasiswa_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'beasiswa_id');
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'beasiswa_id');
    }

    public function isOpen()
    {
        $today = now();
        return $this->status === 'aktif' && 
            $today->between($this->tanggal_mulai, $this->tanggal_selesai);
    }
}