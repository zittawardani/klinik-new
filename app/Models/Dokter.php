<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory; // Pastikan trait ini ditambahkan

    protected $fillable = [
        'sip',
        'nama_dokter',
        'spesialis',
        'foto_dokter',
        'jadwal',
    ];
}
