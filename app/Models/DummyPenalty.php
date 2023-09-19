<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyPenalty extends Model
{
    protected $table = 'dummy_penalty';

    protected $fillable = [
        'ref_penalty_code',
    	'name',
        'type',
        'duration',
        'date_start',
        'date_end',
    ];

    public function penalty()
    {
        return $this->belongsTo('App\Models\Reference\Penalty', 'ref_penalty_code', 'code');
    }
}
