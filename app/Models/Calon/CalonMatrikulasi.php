<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonMatrikulasi extends Model
{
    protected $table = 'calon_matrikulasi';

    protected $fillable = [
    	'no_pengenalan',
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
        'created_by',
        'updated_by',
    ];

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
