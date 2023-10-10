<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class DepartmentMinistry extends Model
{
    protected $table = 'ruj_kem_jabatan';

    protected $fillable = [
        'kod',
        'nama',
        'alamat_1',
        'alamat_2',
        'alamat_3',
        'poskod',
        'bandar',
        'gelaran_ketua',
        'bandar',
        'gelaran_ketua',
        'kem_kod',
        'unit_urusan',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
