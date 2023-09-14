<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class JenisPerkhidmatan extends Model
{
    protected $table = 'ref_jenis_perkhidmatan';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
