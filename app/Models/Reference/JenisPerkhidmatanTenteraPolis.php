<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class JenisPerkhidmatanTenteraPolis extends Model
{
    protected $table = 'ref_jenis_perkhidmatan_tentera_polis';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
    ];
}
