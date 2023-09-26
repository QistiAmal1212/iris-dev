<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidatePsl extends Model
{
    protected $table = 'calon_psl';

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
