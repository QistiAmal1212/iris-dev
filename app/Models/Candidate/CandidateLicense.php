<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateLicense extends Model
{
    protected $table = 'candidate_license';

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
