<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'ref_qualification';

    protected $fillable = [
        'code',
        'name',
        'type',
        'pemerolehan_code',
        'created_by',
        'updated_by',
    ];
}
