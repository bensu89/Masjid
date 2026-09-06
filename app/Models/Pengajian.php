<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajian extends Model
{
    protected $table = 'pengajians';
    protected $fillable = ['judul', 'pemateri', 'tanggal', 'waktu', 'lokasi', 'deskripsi'];
}
