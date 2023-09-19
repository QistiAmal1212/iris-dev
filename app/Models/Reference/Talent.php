<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    protected $table = 'ref_talent';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
