<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonSkm extends Model
{
    protected $table = 'calon_skm';

    protected $fillable = [
    	'cal_no_pengenalan',
        'kel1_kod',
        'tahun_lulus',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function qualification() {
        return $this->belongsTo('App\Models\Reference\Qualification', 'kel1_kod', 'kod');
    }
}
