<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TawaranKursus extends Model
{
    protected $table = 'ruj_tawaran_kursus';

    protected $fillable = [
        'kod',
        'nama',
        'jenis',
        'diskripsi',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
