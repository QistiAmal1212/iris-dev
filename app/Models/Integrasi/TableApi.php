<?php

namespace App\Models\Integrasi;

use Illuminate\Database\Eloquent\Model;

class TableApi extends Model
{
    protected $table = 'table_api';

    protected $fillable = [
    	'nama',
        'id_pencipta',
        'pengguna',
    ];
    
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
