<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisOkuJKM extends Model
{
    protected $table = 'ruj_jenis_oku_jkm';

    protected $fillable = [
        'kod',
        'nama',
        'sub_oku',
        'created_by',
        'updated_by',
        'sah_yt',
    ];

}
