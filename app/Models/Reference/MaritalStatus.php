<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $table = 'ruj_taraf_kahwin';

    protected $fillable = [
        'kod',
        'diskripsi',
        'created_by',
        'updated_by',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
