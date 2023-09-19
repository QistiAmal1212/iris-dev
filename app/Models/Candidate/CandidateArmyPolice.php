<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateArmyPolice extends Model
{
    protected $table = 'calon_tentera_polis';

    protected $fillable = [
    	'no_pengenalan',
        'status',
        'start_date',
        'end_date',
        'verify_date',
        'ref_rank_code',
        'no_id',
        'salary',
        'pension',
        'reward',
        'type_army_police',
        'type_service', 
        'created_by',
        'updated_by',
    ];

    public function rank() {
        return $this->belongsTo('App\Models\Reference\Rank', 'ref_rank_code', 'code');
    }
}
