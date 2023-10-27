<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class InterviewCentre extends Model
{
    protected $table = 'ruj_pusat_temuduga';

    protected $fillable = [
        'kod',
        'diskripsi',
        'kpt_kod',
        'neg_kod',
        'jenis_pusat',
        'kod_pendek',
        'order_seq',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function negeri() {
        return $this->hasOne('App\Models\Reference\State', 'kod', 'neg_kod');
    }
}
