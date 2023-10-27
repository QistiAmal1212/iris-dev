<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NegeriJPN extends Model
{
    protected $table = 'ruj_negeri_jpn';

    protected $fillable = [
        'kod_spa',
        'diskripsi',
        'kod_jpn',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
