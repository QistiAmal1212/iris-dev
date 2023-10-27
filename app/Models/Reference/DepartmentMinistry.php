<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class DepartmentMinistry extends Model
{
    protected $table = 'ruj_kem_jabatan';

    protected $fillable = [
        'kod',
        'diskripsi',
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
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
