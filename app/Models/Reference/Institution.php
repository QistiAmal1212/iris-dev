<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $table = 'ruj_institusi';

    protected $fillable = [
        'kod',
        'diskripsi',
        'jenis_institusi',
        'negara',
        'kategori',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function NamaNegara() {
        return $this->hasOne('App\Models\Reference\Negara', 'kod', 'negara');
    }
}
