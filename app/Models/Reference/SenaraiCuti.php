<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenaraiCuti extends Model
{
    protected $table = 'ruj_senarai_cuti';

    protected $fillable = [
        'kod',
        'nama',
        'kategori',
        'created_by',
        'updated_by',
        'sah_yt',
    ];
}
