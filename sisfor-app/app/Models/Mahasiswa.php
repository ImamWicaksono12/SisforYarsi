<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'prodi_id',
        'angkatan',
        'no_hp',
        'alamat'
    ];

    /**
     * ACCESSOR: Nama Mahasiswa
     * Memungkinkan pemanggilan $mahasiswa->nama secara langsung
     * Data diambil dari tabel users melalui relasi user_id
     */
    public function getNamaAttribute()
    {
        return $this->user->name ?? '-';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function pendaftaran()
    {
        // Mendefinisikan foreign key secara eksplisit jika diperlukan
        return $this->hasMany(Pendaftaran::class, 'mahasiswa_id');
    }

    public function antrean()
    {
        return $this->hasOne(AntreanBeasiswa::class);
    }
}