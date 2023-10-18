<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonDaftar extends Model
{
    protected $table = 'calon_daftar';

    protected $fillable = [
    	'no_pengenalan',
        'skim',
        'tarikh_daftar',
        'tarikh_daftar1',
        'j_daftar',
        'keutamaan',
        'status_akuan',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
