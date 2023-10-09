<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiPerkhidmatan extends Model
{
    protected $table = 'ruj_klasifikasi_perkhidmatan';

    protected $fillable = [
        'kod',
        'nama',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
