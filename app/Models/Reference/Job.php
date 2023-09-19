<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'ref_job';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
