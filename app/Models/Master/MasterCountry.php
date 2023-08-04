<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterCountry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'master_country';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
