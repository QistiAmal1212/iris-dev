<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KumpulanJKK extends Model
{
    protected $table = 'ruj_kumpulan_jkk';

    protected $fillable = [
        'kod',
        'nama',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
