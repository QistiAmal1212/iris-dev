<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonTatatertib extends Model
{
    protected $table = 'calon_tatatertib';

    protected $fillable = [
        'no_pengenalan',
        'kod_ruj_penalti',
        'tempoh',
        'jenis',
        'tarikh_mula',
        'tarikh_tamat',
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
        return $this->belongsTo('App\Models\Reference\Penalty', 'kod_ruj_penalti', 'kod');
    }
}
