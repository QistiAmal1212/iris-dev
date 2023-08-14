<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterModule extends Model
{
    public $timestamps = false;

    protected $table = 'master_module';

    protected $fillable = [
    	'name',
        'data',
        'code',
        'type',
    ];
}
