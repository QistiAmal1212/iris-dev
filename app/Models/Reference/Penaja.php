<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penaja extends Model
{
    protected $table = 'ruj_penaja';

    protected $fillable = [
        'kod',
        'nama',
        'jenis',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
