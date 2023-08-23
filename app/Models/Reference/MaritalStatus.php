<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    protected $table = 'ref_marital_status';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
    ];
}
