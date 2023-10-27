<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonStpmPngk extends Model
{
    protected $table = 'calon_stpm_pngk';

    protected $fillable = [
    	'no_pengenalan',
        'tahun',
        'bil_periksa',
        'pngk',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
