<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TawaranKursus extends Model
{
    protected $table = 'ruj_tawaran_kursus';

    protected $fillable = [
        'kod',
        'diskripsi',
        'jenis',
        'diskripsi_penuh',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
