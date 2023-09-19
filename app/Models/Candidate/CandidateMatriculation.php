<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateMatriculation extends Model
{
    protected $table = 'calon_matrikulasi';

    protected $fillable = [
    	'no_pengenalan',
        'year',
        'matric_no',
        'type',
        'ref_matriculation_course_code',
        'session',
        'semester',
        'ref_matriculation_code',
        'ref_matriculation_subject_code',
        'grade',
        'pngk',
        'created_by',
        'updated_by',
    ];

    public function course(){
        return $this->belongsTo('App\Models\Reference\MatriculationCourse', 'ref_matriculation_course_code', 'code');
    }

    public function college(){
        return $this->belongsTo('App\Models\Reference\Matriculation', 'ref_matriculation_code', 'code');
    }

    public function subject(){
        return $this->belongsTo('App\Models\Reference\MatriculationSubject', 'ref_matriculation_subject_code', 'code');
    }
}
