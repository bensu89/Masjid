<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = ['khatib_id', 'tanggal_jumat', 'tema'];

    public function khatib() {
        return $this->belongsTo(Khatib::class);
    }
}
