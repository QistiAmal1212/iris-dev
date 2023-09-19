<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateSchoolResult extends Model
{
    protected $table = 'candidate_school_result';

    protected $fillable = [
    	'no_pengenalan',
        'certificate_type',
        'examination_no',
        'open_result',
        'year',
        'ref_subject_code',
        'grade',
        'certificate_rank',
        'created_by',
        'updated_by',
    ];

    public function subject(){
        return $this->belongsTo('App\Models\Reference\Subject', 'ref_subject_code', 'code');
    }
}
