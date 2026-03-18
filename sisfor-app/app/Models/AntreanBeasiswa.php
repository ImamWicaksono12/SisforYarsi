<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntreanBeasiswa extends Model
{
    protected $table = 'antrean_beasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'prioritas',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}