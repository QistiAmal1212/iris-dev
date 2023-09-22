<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
    protected $table = 'ruj_gred_gaji_hdr';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
