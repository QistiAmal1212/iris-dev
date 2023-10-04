<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    protected $table = 'ruj_daerah';

    protected $fillable = [
        'kod',
        'nama',
        'kod_ruj_bahagian',
        'kod_ruj_negeri',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
