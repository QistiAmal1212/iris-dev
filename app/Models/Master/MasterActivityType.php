<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterActivityType extends Model
{
    public $timestamps = false;

    protected $table = 'master_activity_type';

    protected $fillable = [
    	'name',
        'name_bi',
    ];
}
