<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonPengalaman9 extends Model
{
    protected $table = 'calon_pengalaman9';

    protected $fillable = [
    	'no_pengenalan',
        'tarikh_mula',
        'tarikh_akhir',
        'tempoh_pengalaman',
        'peringkat_pengalaman',
        'jenis_pengalaman',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
