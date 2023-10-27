<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonSkim extends Model
{
    protected $table = 'calon_skim';

    protected $fillable = [
    	'cal_no_pengenalan',
        'jenis_lantikan',
        'tarikh_daftar',
        'ski_kod',
        'no_kelompok',
        'no_siri',
        'pusat_td_pilihan',
        'status',
        'tmp_status',
        'tarikh_luput',
        'sah_yt',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function skim(){
        return $this->belongsTo('App\Models\Reference\Skim', 'ski_kod', 'kod');
    }

    public function interviewCentre(){
        return $this->belongsTo('App\Models\Reference\InterviewCentre', 'pusat_td_pilihan', 'kod');
    }
}
