<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateLicense extends Model
{
    protected $table = 'calon_lesen';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_lesen',
        'tempoh_tamat',
        'status_senaraihitam',
        'msg_senaraihitam',
        'created_by',
        'updated_by',
    ];
}
