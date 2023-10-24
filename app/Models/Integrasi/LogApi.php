<?php

namespace App\Models\Integrasi;

use Illuminate\Database\Eloquent\Model;

class LogApi extends Model
{
    protected $table = 'log_api';

    protected $fillable = [
        'id_senarai_api',
    	'kod_http',
        'nama',
        'execution_time',
        'size_request',
        'status',
        'id_pencipta',
        'pengguna',
    ];
    
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
