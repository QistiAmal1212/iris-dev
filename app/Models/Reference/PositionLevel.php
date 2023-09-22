<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class PositionLevel extends Model
{
    protected $table = 'ruj_taraf_jawatan';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
