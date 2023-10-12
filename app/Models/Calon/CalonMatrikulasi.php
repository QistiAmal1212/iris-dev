<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonMatrikulasi extends Model
{
    protected $table = 'calon_matrikulasi';

    protected $fillable = [
    	'cal_no_pengenalan',
        'tahun_lulus',
        'no_matrik',
        'jenis_sijil',
        'jurusan',
        'sesi',
        'semester',
        'kolej',
        'kod_subjek',
        'gred',
        'pngk',
        'id_pencipta',
        'pengguna',
    ];

    protected $primaryKey='cal_no_pengenalan';
    public $incrementing = false;
    protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function course(){
        return $this->belongsTo('App\Models\Reference\MatriculationCourse', 'jurusan', 'kod');
    }

    public function college(){
        return $this->belongsTo('App\Models\Reference\Matriculation', 'kolej', 'kod');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Reference\MatriculationSubject', 'kod_subjek', 'code');
    }
}
