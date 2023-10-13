<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class KodPelbagai extends Model
{
    protected $table = 'ruj_kod_pelbagai';

    protected $fillable = [
        'kod',
        'kategori',
        'diskripsi',
        'sah_yt',
        'jantina',
        'nilai',
        'id_pencipta',
        'pengguna',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
