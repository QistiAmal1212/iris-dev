<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;

class AnnouncementTarget extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'announcement_target';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function announcement()
    {
        return $this->belongsTo('App\Models\Other\Announcement', 'announcement_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
