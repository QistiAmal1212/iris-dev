<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateProfessionalSej extends Model
{
    protected $table = 'calon_profesional_sej';

    protected $fillable = [
    	'no_pengenalan',
        'kod_ruj_kelulusan',
        'no_ahli',
        'tarikh',
        'created_by',
        'updated_by',
    ];

    public function qualification() {
        return $this->belongsTo('App\Models\Reference\Qualification', 'kod_ruj_kelulusan', 'code');
    }
}
