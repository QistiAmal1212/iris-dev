<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CutiAwam extends Model
{
    protected $table = 'ruj_cuti_awam';

    protected $fillable = [
        'kod',
        'tarikh_cuti',
        'kod_ruj_negeri',
        'kod_ruj_senarai_cuti',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
