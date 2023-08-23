<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'ref_religion';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
    ];
}
