<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetugasJumat extends Model
{
    protected $table = 'petugas_jumat';

    protected $fillable = [
        'nama_petugas',
        'peran_utama',
        'no_whatsapp',
        'domisili',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
