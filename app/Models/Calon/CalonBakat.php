<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonBakat extends Model
{
    protected $table = 'calon_bakat';

    protected $fillable = [
    	'no_pengenalan',
        'bakat',
        'bakat_detail',
        'id_pencipta',
        'pengguna',
    ];

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function talent() {
        return $this->belongsTo('App\Models\Reference\Talent', 'bakat', 'kod');
    }
}
