<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JKKC extends Model
{
    protected $table = 'ruj_skim_jkkc_sijil';

    protected $fillable = [
        'kod',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
