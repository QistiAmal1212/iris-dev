<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class JenisBekasTenteraPolis extends Model
{
    protected $table = 'ref_jenis_bekas_tentera_polis';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
