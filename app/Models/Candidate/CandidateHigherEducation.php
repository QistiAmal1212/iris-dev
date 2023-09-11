<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateHigherEducation extends Model
{
    protected $table = 'candidate_higher_education';

    protected $fillable = [
    	'no_pengenalan',
        'ref_institution_code',
        'ref_eligibility_code',
        'ref_specialization_code',
        'year',
        'cgpa',
        'created_by',
        'updated_by',
    ];

    public function institution() {
        return $this->belongsTo('App\Models\Reference\Institution', 'ref_institution_code', 'code');
    }

    public function eligibility() {
        return $this->belongsTo('App\Models\Reference\Eligibility', 'ref_eligibility_code', 'code');
    }

    public function specialization() {
        return $this->belongsTo('App\Models\Reference\Specialization', 'ref_specialization_code', 'code');
    }
}
