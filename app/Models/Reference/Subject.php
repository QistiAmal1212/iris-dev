<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'ruj_matapelajaran';

    protected $fillable = [
        'code',
        'form',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
