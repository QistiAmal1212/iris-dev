<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterInboxStatus extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_inbox_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarderd = [];
}
