<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'ruj_status';

    protected $fillable = [
        'kod',
        'nama',
        'diskripsi',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
