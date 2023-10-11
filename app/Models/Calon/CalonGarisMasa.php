<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonGarisMasa extends Model
{
    protected $table = 'calon_garis_masa';

    protected $fillable = [
        'no_pengenalan',
        'details',
        'activity_type_id',
        'created_by',
        'updated_by',
    ];

    public function created_user()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
