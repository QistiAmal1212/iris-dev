<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateSkim extends Model
{
    protected $table = 'calon_skim';

    protected $fillable = [
    	'no_pengenalan',
        'type',
        'register_date',
        'ref_skim_code',
        'group_no',
        'serial_no',
        'ref_interview_centre_code',
        'status',
        'tmp_status',
        'expiry_date',
        'created_by',
        'updated_by',
    ];

    public function skim(){
        return $this->belongsTo('App\Models\Reference\Skim', 'ref_skim_code', 'code');
    }

    public function interviewCentre(){
        return $this->belongsTo('App\Models\Reference\InterviewCentre', 'ref_interview_centre_code', 'kod');
    }
}
