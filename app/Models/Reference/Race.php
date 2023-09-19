<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $table = 'ref_race';

    protected $fillable = [
        'code',
        'name',
        'status_bumiputera',
        'pemerolehan_code',
        'group',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
