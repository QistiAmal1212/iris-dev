<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class PeringkatPengajian extends Model
{
    protected $table = 'ref_peringkat_pengajian';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
