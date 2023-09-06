<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ref_rank';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
    ];
}
