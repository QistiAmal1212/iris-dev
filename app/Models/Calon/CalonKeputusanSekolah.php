<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonKeputusanSekolah extends Model
{
    protected $table = 'calon_keputusan_sekolah';

    protected $fillable = [
    	'cal_no_pengenalan',
        'jenis_sijil',
        'angka_gil',
        'kep_terbuka',
        'tahun',
        'mpel_tkt',
        'mpel_kod',
        'gred',
        'pangkat_sijil',
        'pngk_gred',
        'id_pencipta',
        'pengguna',
    ];
    //protected $primaryKey='cal_no_pengenalan';
    //public $incrementing = false;
    //protected $keyType = 'string';

    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function subjectForm3(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'kod')->where('tkt', 3);
    }

    public function subjectForm5(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'kod')->where('tkt', 5);
    }

    public function subjectForm6(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'kod')->where('tkt', 6);
    }
}
