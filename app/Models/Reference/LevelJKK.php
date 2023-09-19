<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class LevelJKK extends Model
{
    protected $table = 'ruj_tingkatan_jkk';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
