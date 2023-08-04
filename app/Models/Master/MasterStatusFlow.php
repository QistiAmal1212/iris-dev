<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterStatusFlow extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'master_status_flow';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
