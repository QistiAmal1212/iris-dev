<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MatriculationCourse extends Model
{
    protected $table = 'ref_matriculation_course';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
    ];
}
