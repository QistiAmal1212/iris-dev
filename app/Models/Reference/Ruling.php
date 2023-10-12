<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruling extends Model
{
    protected $table = 'ruj_ruling';

    protected $fillable = [
        'kod',
        'diskripsi',
        'pernyataan',
        'status',
        'created_by',
        'updated_by',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
