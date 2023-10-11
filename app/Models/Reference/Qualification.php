<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'ruj_kelulusan';

    protected $fillable = [
        'kod',
        'diskripsi',
        'jenis',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
