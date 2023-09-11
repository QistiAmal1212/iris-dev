<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidatePsl extends Model
{
    protected $table = 'candidate_psl';

    protected $fillable = [
    	'no_pengenalan',
        'ref_qualification_code',
        'exam_date',
        'created_by',
        'updated_by',
    ];

    public function qualification() {
        return $this->belongsTo('App\Models\Reference\Qualification', 'ref_qualification_code', 'code');
    }
}
