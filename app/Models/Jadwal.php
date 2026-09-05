<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $fillable = ['khatib_id', 'imam_id', 'bilal_id', 'tanggal_jumat', 'tema'];

    public function khatib() { return $this->belongsTo(PetugasJumat::class, 'khatib_id'); }
    public function imam() { return $this->belongsTo(PetugasJumat::class, 'imam_id'); }
    public function bilal() { return $this->belongsTo(PetugasJumat::class, 'bilal_id'); }
}
