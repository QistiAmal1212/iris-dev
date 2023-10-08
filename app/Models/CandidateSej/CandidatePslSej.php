<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidatePslSej extends Model
{
    protected $table = 'calon_psl_sej';

    protected $fillable = [
    	'no_pengenalan',
        'kod_ruj_kelulusan',
        'tarikh_exam',
        'created_by',
        'updated_by',
    ];

    public function qualification() {
        return $this->belongsTo('App\Models\Reference\Qualification', 'kod_ruj_kelulusan', 'code');
    }
}
