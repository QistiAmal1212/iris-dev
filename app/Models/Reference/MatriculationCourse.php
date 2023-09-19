<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class MatriculationCourse extends Model
{
    protected $table = 'ruj_jurusan_matrikulasi';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
