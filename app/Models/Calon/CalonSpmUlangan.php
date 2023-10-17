<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonSpmUlangan extends Model
{
    protected $table = 'calon_spmu';

    protected $fillable = [
    	'no_pengenalan',
        'angka_giliran_1',
        'keputusan_1',
        'mata_pelajaran_1',
        'tahun_1',
        'angka_giliran_2',
        'keputusan_2',
        'mata_pelajaran_2',
        'tahun_2',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
