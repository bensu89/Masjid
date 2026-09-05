<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khatib extends Model
{
    protected $table = 'khatib';

    protected $fillable = [
        'nama_khatib',
        'no_whatsapp',
        'domisili',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
