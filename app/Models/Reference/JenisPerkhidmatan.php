<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class JenisPerkhidmatan extends Model
{
    protected $table = 'ruj_jenis_perkhidmatan';

    protected $fillable = [
        'diskripsi',
        'id_pencipta',
        'pengguna',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
