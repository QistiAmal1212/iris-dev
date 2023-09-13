<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateOku extends Model
{
    protected $table = 'candidate_oku';

    protected $fillable = [
    	'no_pengenalan',
        'no_registration',
        'status',
        'category',
        'sub',
        'created_by',
        'updated_by',
    ];
}
