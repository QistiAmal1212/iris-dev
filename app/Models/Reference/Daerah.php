<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    protected $table = 'ruj_daerah';

    protected $fillable = [
        'kod',
        'diskripsi',
        'bah_kod',
        'neg_kod',
        'id_pencipta',
        'pengguna',
        'sah_yt',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function bahagian() {
        return $this->hasOne('App\Models\Reference\Bahagian', 'kod', 'bah_kod');
    }

    public function negeri() {
        return $this->hasOne('App\Models\Reference\State', 'kod', 'neg_kod');
    }
}
