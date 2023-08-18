<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterFunction extends Model
{
    public $timestamps = false;

    protected $table = 'master_function';

    protected $fillable = [
    	'name',
        'code',
    ];
}
