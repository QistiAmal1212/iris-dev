<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'ruj_keturunan';

    protected $fillable = [
        'kod',
        'diskripsi',
        'status_bumiputera',
        'kump',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
