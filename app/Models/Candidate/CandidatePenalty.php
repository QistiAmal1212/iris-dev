<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidatePenalty extends Model
{
    protected $table = 'candidate_penalty';

    protected $fillable = [
        'no_pengenalan',
        'ref_penalty_code',
        'duration',
        'type',
        'date_start',
        'date_end',
        'created_by',
        'updated_by',
    ];

    public function penalty()
    {
        return $this->belongsTo('App\Models\Reference\Penalty', 'ref_penalty_code', 'code');
    }
}
