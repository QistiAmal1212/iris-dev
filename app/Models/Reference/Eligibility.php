<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    protected $table = 'ruj_kelayakan';

    protected $fillable = [
        'kod',
        'diskripsi',
        'ski_kod',
        'kategori_kelayakan',
        'kelayakan_setara',
        'rank_layak',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
