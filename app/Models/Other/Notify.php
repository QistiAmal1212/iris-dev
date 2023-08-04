<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Notify extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notify';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by_user_id', 'id');
    }
}
