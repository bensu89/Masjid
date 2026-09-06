<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'jadwal_shalat_jumat_enabled',
        'acara_keagamaan_enabled',
        'laporan_keuangan_enabled',
    ];
}
