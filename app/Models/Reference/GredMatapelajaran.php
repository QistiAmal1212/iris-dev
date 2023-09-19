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
        'created_by',
        'updated_by',
    ];
}
