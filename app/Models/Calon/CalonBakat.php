<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonBakat extends Model
{
    protected $table = 'calon_bakat';

    protected $fillable = [
    	'no_pengenalan',
        'bakat',
        'bakat_detail',
        'created_by',
        'updated_by',
    ];

    public function talent() {
        return $this->belongsTo('App\Models\Reference\Talent', 'bakat', 'kod');
    }
}
