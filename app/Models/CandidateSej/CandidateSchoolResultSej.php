<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateSchoolResultSej extends Model
{
    protected $table = 'calon_keputusan_sekolah_sej';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_sijil',
        'angka_giliran',
        'kep_terbuka',
        'tahun',
        'mpel_tkt',
        'mpel_kod',
        'gred',
        'pangkat_sijil',
        'created_by',
        'updated_by',
    ];

    public function subjectForm3(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'code')->where('form', 3);
    }

    public function subjectForm5(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'code')->where('form', 5);
    }

    public function subjectForm6(){
        return $this->belongsTo('App\Models\Reference\Subject', 'mpel_kod', 'code')->where('form', 6);
    }
}
