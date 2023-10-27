<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class GredMatapelajaran extends Model
{
    protected $table = 'ruj_gred_matapelajaran';

    protected $fillable = [
        'gred',
        'jenis',
        'tkt',
        'susunan',
        'id_pencipta',
        'pengguna',
    ];
}
