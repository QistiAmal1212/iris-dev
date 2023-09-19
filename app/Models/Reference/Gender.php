<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'ref_gender';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
