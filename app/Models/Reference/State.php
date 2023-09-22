<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'ruj_negeri';

    protected $fillable = [
        'kod',
        'nama',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
