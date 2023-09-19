<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Matriculation extends Model
{
    protected $table = 'ruj_matrikulasi';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
