<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateTalent extends Model
{
    protected $table = 'calon_bakat';

    protected $fillable = [
    	'no_pengenalan',
        'ref_talent_code',
        'detail',
        'created_by',
        'updated_by',
    ];

    public function talent() {
        return $this->belongsTo('App\Models\Reference\Talent', 'ref_talent_code', 'code');
    }
}
