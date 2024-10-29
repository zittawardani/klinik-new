<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $fillable = [
        'id_dokter',
        'nama_pasien',
        'nik',
        'komentar',
    ];

    public function dokter() {
        return $this->belongsTo(Dokter::class); //penerapan relasion one to many
    }
}
