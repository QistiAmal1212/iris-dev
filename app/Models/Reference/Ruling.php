<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruling extends Model
{
    protected $table = 'ruj_ruling';

    protected $fillable = [
        'kod',
        'nama',
        'pernyataan',
        'status',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
