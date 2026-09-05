<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    protected $table = 'acaras';
    protected $fillable = ['judul', 'tanggal_acara', 'waktu', 'lokasi', 'deskripsi'];
}
