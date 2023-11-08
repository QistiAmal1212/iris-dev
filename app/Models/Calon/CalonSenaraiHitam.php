<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSenaraiHitam extends Model
{
    protected $table = 'calon_senarai_hitam';

    protected $fillable = [
        'no_pengenalan',
        'kod',
        'tempoh',
        'jenis',
        'trk_kuatkuasa',
        'trk_tamat',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function penalty()
    {
        return $this->belongsTo('App\Models\Reference\Penalty', 'kod', 'kod');
    }
}
