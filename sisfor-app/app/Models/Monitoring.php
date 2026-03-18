<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $table = 'monitoring';

    protected $fillable = [
        'pendaftaran_id',
        'semester',
        'file_khs',
        'ipk',
        'kegiatan_organisasi',
        'laporan',
        'status_monitoring',
        'catatan_admin'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}