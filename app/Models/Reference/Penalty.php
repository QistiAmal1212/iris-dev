<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'ruj_tatatertib';

    protected $fillable = [
        'kod',
        'diskripsi',
        'kategori',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
