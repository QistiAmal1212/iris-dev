<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class LevelJKK extends Model
{
    protected $table = 'ref_level_jkk';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
