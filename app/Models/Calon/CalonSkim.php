<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonSkim extends Model
{
    protected $table = 'calon_skim';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_lantikan',
        'tarikh_daftar',
        'kod_ruj_skim',
        'no_kelompok',
        'no_siri',
        'pusat_td_pilihan',
        'status',
        'tmp_status',
        'tarikh_luput',
        'created_by',
        'updated_by',
        'sah_yt'
    ];

    public function skim(){
        return $this->belongsTo('App\Models\Reference\Skim', 'kod_ruj_skim', 'code');
    }

    public function interviewCentre(){
        return $this->belongsTo('App\Models\Reference\InterviewCentre', 'pusat_td_pilihan', 'kod');
    }
}
