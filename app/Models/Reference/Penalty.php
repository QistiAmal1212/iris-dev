<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'ref_penalty';

    protected $fillable = [
        'code',
        'name',
        'category',
        'pemerolehan_code'
    ];
}
