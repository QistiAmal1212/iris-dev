<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonPengajianTinggi extends Model
{
    protected $table = 'calon_pengajian_tinggi';

    protected $fillable = [
    	'cal_no_pengenalan',
        'ins_kod',
        'kel_kod',
        'pen_kod',
        'tahun_lulus',
        'cgpa',
        'peringkat_pengajian',
        'nama_sijil',
        'tarikh_senat',
        'biasiswa',
        'ins_fln',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function institution() {
        return $this->belongsTo('App\Models\Reference\Institution', 'ins_kod', 'kod');
    }

    public function eligibility() {
        return $this->belongsTo('App\Models\Reference\Eligibility', 'kel_kod', 'kod');
    }

    public function specialization() {
        return $this->belongsTo('App\Models\Reference\Specialization', 'pen_kod', 'kod');
    }

    public function peringkat() {
        return $this->belongsTo('App\Models\Reference\PeringkatPengajian', 'peringkat_pengajian', 'id');
    }
}
