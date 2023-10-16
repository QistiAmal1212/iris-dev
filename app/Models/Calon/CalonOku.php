<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalonOku extends Model
{
    protected $table = 'calon_oku';

    protected $fillable = [
    	'no_pengenalan',
        'no_daftar_jkm',
        'status_oku',
        'kategori_oku',
        'sub_oku',
        'id_pencipta',
        'pengguna',
    ];
    // protected $primaryKey='no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function kategori()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'kategori_oku', 'kod');
    }
}
