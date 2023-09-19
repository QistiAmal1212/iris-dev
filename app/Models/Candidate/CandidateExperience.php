<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class CandidateExperience extends Model
{
    protected $table = 'candidate_experience';

    protected $fillable = [
    	'no_pengenalan',
        'ref_job_code',
        'indicator',
        'job_sector',
        'ref_position_level_code',
        'ref_salary_grade_code',
        'ref_level_jkk_code',
        'service_group',
        'date_appoint',
        'date_start',
        'date_verify',
        'date_end',
        'ref_department_ministry_code',
        'property',
        'state_department',
        'salary_scale',
        'monthly_salary',
        'salary_movement',
        'ref_skim_code',
        'ref_state_code',
        'date_end_contract',
        'working_district',
        'created_by',
        'updated_by',
    ];

    public function job() {
        return $this->belongsTo('App\Models\Reference\Job', 'ref_position_level_code', 'code');
    }

    public function positionLevel() {
        return $this->belongsTo('App\Models\Reference\PositionLevel', 'ref_position_level_code', 'code');
    }

    public function salaryGrade() {
        return $this->belongsTo('App\Models\Reference\SalaryGrade', 'ref_salary_grade_code', 'code');
    }

    public function levelJkk() {
        return $this->belongsTo('App\Models\Reference\LevelJKK', 'ref_level_jkk_code', 'code');
    }

    public function departmentMinistry() {
        return $this->belongsTo('App\Models\Reference\DepartmentMinistry', 'ref_department_ministry_code', 'code');
    }

    public function stateDepartment() {
        return $this->belongsTo('App\Models\Reference\State', 'state_department', 'code');
    }

    public function skim() {
        return $this->belongsTo('App\Models\Reference\Skim', 'ref_skim_code', 'code');
    }

    public function state() {
        return $this->belongsTo('App\Models\Reference\State', 'ref_state_code', 'code');
    }

}
