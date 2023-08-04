<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;

// use Yajra\Oci8\Eloquent\OracleEloquent as Model;

class Announcement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'announcement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo('App\Models\Master\MasterAnnouncementType', 'announcement_type_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by_user_id', 'id');
    }

    public function targets()
    {
        return $this->hasMany('App\Models\Other\AnnouncementTarget', 'announcement_id', 'id');
    }
}
