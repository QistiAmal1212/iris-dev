<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateSkm extends Model
{
    protected $table = 'calon_skm';

    protected $fillable = [
    	'no_pengenalan',
        'ref_qualification_code',
        'year',
        'created_by',
        'updated_by',
    ];

    public function qualification() {
        return $this->belongsTo('App\Models\Reference\Qualification', 'ref_qualification_code', 'code');
    }
}
