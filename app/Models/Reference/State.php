<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'ref_state';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
    ];
}
