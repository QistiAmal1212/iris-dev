<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonBahasa extends Model
{
    protected $table = 'calon_bahasa';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_bahasa',
        'penguasaan',
        'id_pencipta',
        'pengguna',
    ];
    // protected $primaryKey='no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function language() {
        return $this->belongsTo('App\Models\Reference\Language', 'jenis_bahasa', 'kod');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'penguasaan', 'kod')->where('kategori', 'PENGUASAAN BAHASA');
    }
}
