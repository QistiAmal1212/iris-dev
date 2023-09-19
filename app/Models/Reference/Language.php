<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'ruj_bahasa';

    protected $fillable = [
        'kod',
        'nama',
        'no_pemerolehan',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
