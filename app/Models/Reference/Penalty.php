<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'ruj_tatatertib';

    protected $fillable = [
        'code',
        'name',
        'category',
        'pemerolehan_code',
        'is_active',
    ];
}
