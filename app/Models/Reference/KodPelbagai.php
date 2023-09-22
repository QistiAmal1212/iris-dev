<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class KodPelbagai extends Model
{
    protected $table = 'ruj_kod_pelbagai';

    protected $fillable = [
        'kod',
        'kategori',
        'nama',
        'sah_yt',
        'jantina',
        'nilai',
        'no_pemerolehan',
        'created_by',
        'updated_by',
    ];
}
