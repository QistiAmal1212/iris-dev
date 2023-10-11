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
        'created_by',
        'updated_by',
    ];

    public function penalty()
    {
        return $this->belongsTo('App\Models\Reference\Penalty', 'kod_ruj_penalti', 'code');
    }
}
