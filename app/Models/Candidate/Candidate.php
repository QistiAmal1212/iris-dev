<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidate';

    protected $fillable = [
    	'no_pengenalan',
        'no_ic',
        'no_ic_old',
        'no_passport',
        'ic_color',
        'full_name',
        'email',
        'phone_number',
        'ref_gender_code',
        'ref_marital_status_code',
        'ref_race_code',
        'ref_religion_code',
        'nationality',
        'height',
        'weight',
        'address_1',
        'address_2',
        'address_3',
        'poscode',
        'city',
        'ref_state_code',
        'permanent_address_1',
        'permanent_address_2',
        'permanent_address_3',
        'permanent_poscode',
        'permanent_city',
        'permanent_ref_state_code',
        'date_of_birth',
        'place_of_birth',
        'father_place_of_birth',
        'mother_place_of_birth',
        'created_by',
        'updated_by',
    ];

    public function license() {
        return $this->hasOne('App\Models\Candidate\CandidateLicense', 'no_pengenalan', 'no_pengenalan');
    }

    public function oku() {
        return $this->hasOne('App\Models\Candidate\CandidateOku', 'no_pengenalan', 'no_pengenalan');
    }

    public function skim() {
        return $this->hasMany('App\Models\Candidate\CandidateSkim', 'no_pengenalan', 'no_pengenalan');
    }

    public function schoolResult() {
        return $this->hasMany('App\Models\Candidate\CandidateSchoolResult', 'no_pengenalan', 'no_pengenalan');
    }

    public function matriculation() {
        return $this->hasMany('App\Models\Candidate\CandidateMatriculation', 'no_pengenalan', 'no_pengenalan');
    }

    public function skm() {
        return $this->hasMany('App\Models\Candidate\CandidateSkm', 'no_pengenalan', 'no_pengenalan');
    }

    public function higherEducation() {
        return $this->hasOne('App\Models\Candidate\CandidateHigherEducation', 'no_pengenalan', 'no_pengenalan');
    }

    public function professional() {
        return $this->hasMany('App\Models\Candidate\CandidateProfessional', 'no_pengenalan', 'no_pengenalan');
    }

    public function experience() {
        return $this->hasOne('App\Models\Candidate\CandidateExperience', 'no_pengenalan', 'no_pengenalan');
    }

    public function psl() {
        return $this->hasMany('App\Models\Candidate\CandidatePsl', 'no_pengenalan', 'no_pengenalan');
    }
    
    public function armyPolice() {
        return $this->hasOne('App\Models\Candidate\CandidateArmyPolice', 'no_pengenalan', 'no_pengenalan');
    }

    public function language() {
        return $this->hasMany('App\Models\Candidate\CandidateLanguage', 'no_pengenalan', 'no_pengenalan');
    }

    public function talent() {
        return $this->hasMany('App\Models\Candidate\CandidateTalent', 'no_pengenalan', 'no_pengenalan');
    }

    public function penalty() {
        return $this->hasMany('App\Models\Candidate\CandidatePenalty', 'no_pengenalan', 'no_pengenalan');
    }

    public function timeline() {
        return $this->hasMany('App\Models\Candidate\CandidateTimeline', 'no_pengenalan', 'no_pengenalan');
    }
}
