<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonLesen extends Model
{
    protected $table = 'calon_lesen';

    protected $fillable = [
    	'cal_no_pengenalan',
        'jenis_lesen',
        'tempoh_tamat',
        'status_senaraihitam',
        'msg_senaraihitam',
        'id_pencipta',
        'pengguna',
    ];

    protected $primaryKey='cal_no_pengenalan';
    public $incrementing = false;
    protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
