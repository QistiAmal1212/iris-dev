<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'ruj_pengkhususan';

    protected $fillable = [
        'kod',
        'diskripsi',
        'jenis',
        'bidang',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function jenis()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'jenis', 'kod');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'bidang', 'kod');
    }
}
