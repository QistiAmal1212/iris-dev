<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonTenteraPolis extends Model
{
    protected $table = 'calon_tentera_polis';

    protected $fillable = [
    	'no_pengenalan',
        'status_pkhidmat',
        'tarikh_mula',
        'tarikh_tamat',
        'tarikh_disahkan',
        'pangkat_tent_polis',
        'no_tent_polis',
        'gaji_tentera',
        'pencen',
        'ganjaran',
        'jenis_bekas_tentera',
        'jenis_pkhidmat',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function rank() {
        return $this->belongsTo('App\Models\Reference\Rank', 'pangkat_tentera_polis', 'kod');
    }
}
