<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateArmyPoliceSej extends Model
{
    protected $table = 'calon_tentera_polis_sej';

    protected $fillable = [
    	'no_pengenalan',
        'status_pkhidmat',
        'tarikh_mula',
        'tarikh_tamat',
        'tarikh_disahkan',
        'pangkat_tentera_polis',
        'no_tentera_polis',
        'gaji_tentera',
        'pencen',
        'ganjaran',
        'jenis_bekas_tentera',
        'jenis_pkhidmat', 
        'created_by',
        'updated_by',
    ];

    public function rank() {
        return $this->belongsTo('App\Models\Reference\Rank', 'pangkat_tentera_polis', 'code');
    }
}
