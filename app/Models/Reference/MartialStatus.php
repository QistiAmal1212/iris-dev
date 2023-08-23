<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MartialStatus extends Model
{
    protected $table = 'ref_martial_status';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
    ];
}
