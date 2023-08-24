<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'ref_institution';

    protected $fillable = [
        'code',
        'name',
        'type',
        'ref_country_code',
        'pemerolehan_code',
        'category',
        'created_by',
        'updated_by',
    ];
}
