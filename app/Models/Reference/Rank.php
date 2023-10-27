<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ruj_pangkat';

    protected $fillable = [
        'kod',
        'diskripsi',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
