<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HolidayState extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'holiday_state';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function holiday() {
        return $this->belongsTo('App\Models\Other\Holiday', 'holiday_id', 'id');
    }

    public function state() {
        return $this->belongsTo('App\Models\Master\MasterState', 'state_id', 'id');
    }
}
