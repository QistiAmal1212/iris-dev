<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateOku extends Model
{
    protected $table = 'candidate_oku';

    protected $fillable = [
    	'no_pengenalan',
        'type',
        'expiry_date',
        'is_blacklist',
        'blacklist_details',
        'created_by',
        'updated_by',
    ];
}
