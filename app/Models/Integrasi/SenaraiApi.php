<?php

namespace App\Models\Integrasi;

use Illuminate\Database\Eloquent\Model;

class SenaraiApi extends Model
{
    protected $table = 'senarai_api';

    protected $fillable = [
    	'nama',
        'url',
        'nama_path',
        'status',
        'id_pencipta',
        'pengguna',
    ];
    
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function akses() 
    {
        return $this->belongsToMany('App\Models\Integrasi\TableApi', 'akses_api', 'id_senarai_api', 'id_table_api');
    }
}
