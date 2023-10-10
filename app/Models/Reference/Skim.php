<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Skim extends Model
{
    protected $table = 'ruj_skim';

    protected $fillable = [
        'code',
        'name',
        'GGH_KOD',
        'GUNASAMA',
        'ref_skim_type',
        'KP_KOD',
        'KUMP_PKHIDMAT_JKK',
        'KUMP_PKHIDMAT_SSB',
        'UJIAN_WAJIB_1',
        'UJIAN_WAJIB_2',
        'UJIAN_WAJIB_3',
        'UJIAN_WAJIB_4',
        'UJIAN_WAJIB_5',
        'SKIM_PKHIDMAT',
        'GGH_SSM',
        'KUMP_PKHIDMAT_SBPA',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
