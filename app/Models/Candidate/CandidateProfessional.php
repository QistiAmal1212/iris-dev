<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateProfessional extends Model
{
    protected $table = 'candidate_professional';

    protected $fillable = [
    	'no_pengenalan',
        'ref_specialization_code',
        'member_no',
        'date',
        'created_by',
        'updated_by',
    ];

    public function specialization() {
        return $this->belongsTo('App\Models\Reference\Specialization', 'ref_specialization_code', 'code');
    }
}
