<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class PeringkatPengajian extends Model
{
    protected $table = 'ruj_peringkat_pengajian';

    protected $fillable = [
        'diskripsi',
        'id_pencipta',
        'pengguna',
    ];
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';
}
