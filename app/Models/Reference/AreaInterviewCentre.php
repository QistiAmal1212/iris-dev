<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class AreaInterviewCentre extends Model
{
    protected $table = 'ruj_kawasan_pst_td';

    protected $fillable = [
        'kod',
        'diskripsi',
        'kawasan_induk',
        'id_pencipta',
        'pengguna',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
