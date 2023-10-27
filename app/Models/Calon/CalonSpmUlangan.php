<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonSpmUlangan extends Model
{
    protected $table = 'calon_spmu';

    protected $fillable = [
    	'no_pengenalan',
        'tahun',
        'matapelajaran',
        'jenis_sijil',
        'gred',
        'jenis_xm',
        'ujian_lisan',
        'status',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function subjek(){
        return $this->belongsTo('App\Models\Reference\Subject', 'matapelajaran', 'kod');
    }
}
