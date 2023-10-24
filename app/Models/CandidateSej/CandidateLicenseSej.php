<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateLicenseSej extends Model
{
    protected $table = 'calon_lesen_sej';

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
