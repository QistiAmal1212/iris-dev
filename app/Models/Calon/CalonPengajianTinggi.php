<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonPengajianTinggi extends Model
{
    protected $table = 'calon_pengajian_tinggi';

    protected $fillable = [
    	'no_pengenalan',
        'kod_ruj_institusi',
        'kod_ruj_kelayakan',
        'kod_ruj_pengkhususan',
        'tahun_lulus',
        'cgpa',
        'peringkat_pengajian',
        'nama_sijil',
        'tarikh_senat',
        'biasiswa',
        'ins_fln',
        'created_by',
        'updated_by',
    ];

    public function institution() {
        return $this->belongsTo('App\Models\Reference\Institution', 'kod_ruj_institusi', 'kod');
    }

    public function eligibility() {
        return $this->belongsTo('App\Models\Reference\Eligibility', 'kod_ruj_kelayakan', 'code');
    }

    public function specialization() {
        return $this->belongsTo('App\Models\Reference\Specialization', 'kod_ruj_pengkhususan', 'kod');
    }
}
