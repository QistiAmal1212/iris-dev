<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    protected $table = 'ruj_negara';

    protected $fillable = [
        'kod',
        'nama',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
