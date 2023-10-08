<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateTalentSej extends Model
{
    protected $table = 'calon_bakat_sej';

    protected $fillable = [
    	'no_pengenalan',
        'bakat',
        'bakat_detail',
        'created_by',
        'updated_by',
    ];

    public function talent() {
        return $this->belongsTo('App\Models\Reference\Talent', 'bakat', 'code');
    }
}
