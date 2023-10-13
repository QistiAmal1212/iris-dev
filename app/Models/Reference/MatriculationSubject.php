<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MatriculationSubject extends Model
{
    protected $table = 'ruj_subjek_matrikulasi';

    protected $fillable = [
        'kod',
        'diskripsi',
        'kredit',
        'semester',
        'kategori',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
