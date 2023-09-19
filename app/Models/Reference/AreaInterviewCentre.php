<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class AreaInterviewCentre extends Model
{
    protected $table = 'ruj_kawasan_pst_td';

    protected $fillable = [
        'kod',
        'nama',
        'kawasan_induk',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
