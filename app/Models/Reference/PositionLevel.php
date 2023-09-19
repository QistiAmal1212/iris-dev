<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class PositionLevel extends Model
{
    protected $table = 'ref_position_level';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
