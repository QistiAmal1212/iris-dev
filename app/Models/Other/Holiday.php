<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'holiday';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function holiday_type() {
        return $this->belongsTo('App\Models\Master\MasterHolidayType', 'holiday_type_id', 'id');
    }

    public function created_by() {
        return $this->belongsTo('App\Models\User', 'created_by_user_id', 'id');
    }

    public function states() {
        return $this->hasMany('App\Models\Other\HolidayState', 'holiday_id', 'id');
    }
}
