<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'beasiswa_id',
        'judul',
        'isi',
        'tanggal'
    ];

    public function beasiswa()
    {
        return $this->belongsTo(Beasiswa::class);
    }
}