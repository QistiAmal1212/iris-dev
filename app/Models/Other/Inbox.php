<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inbox';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function sender() {
        return $this->belongsTo('App\Models\User', 'sender_user_id', 'id');
    }

    public function receiver() {
        return $this->belongsTo('App\Models\User', 'receiver_user_id', 'id');
    }

    public function status() {
        return $this->belongsTo('App\Models\Master\MasterInboxStatus', 'inbox_status_id', 'id');
    }
}
