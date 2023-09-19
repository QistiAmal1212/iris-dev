<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyTimeline extends Model
{
    protected $table = 'dummy_timeline';

    protected $fillable = [
        'dummy_penalty_id',
        'details',
        'created_by',
        'updated_by',
    ];

    public function penalty()
    {
        return $this->belongsTo('App\Models\Reference\Penalty', 'dummy_penalty_id', 'id');
    }

    public function created_user()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
