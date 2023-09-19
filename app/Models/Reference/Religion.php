<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'ruj_agama';

    protected $fillable = [
        'kod',
        'nama',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
