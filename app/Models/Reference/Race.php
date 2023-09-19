<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'ruj_keturunan';

    protected $fillable = [
        'kod',
        'nama',
        'status_bumiputera',
        'no_pemerolehan',
        'kump',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
