<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersyaratanBeasiswa extends Model
{
    protected $table = 'persyaratan_beasiswa';

    protected $fillable = [
        'beasiswa_id',
        'nama_persyaratan',
        'wajib'
    ];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}