<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogSystem extends Model
{
    protected $table = 'log_system';

    protected $fillable = [
        'module_id',
        'activity_type_id',
        'description',
        'data_old',
        'data_new',
        'url',
        'method',
        'ip_address',
        'created_by_user_id',
    ];

    public function module()
    {
        return $this->belongsTo('App\Models\Master\MasterModule', 'module_id', 'id');
    }

    public function activity_type()
    {
        return $this->belongsTo('App\Models\Master\MasterActivityType', 'activity_type_id', 'id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'created_by_user_id', 'id');
    }
}
