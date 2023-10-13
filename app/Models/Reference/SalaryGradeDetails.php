<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class SalaryGradeDetails extends Model
{
    protected $table = 'ruj_gred_gaji_det';

    protected $fillable = [
        'ggh_kod',
        'peringkat',
        'tahun',
        'amaun',
        'gaji_mula',
        'id_pencipta',
        'pengguna',
        'sah_yt'
    ];


    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
