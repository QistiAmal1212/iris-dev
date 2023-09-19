<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'ref_language';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
