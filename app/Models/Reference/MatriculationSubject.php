<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MatriculationSubject extends Model
{
    protected $table = 'ref_matriculation_subject';

    protected $fillable = [
        'code',
        'name',
        'credit',
        'semester',
        'category',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
