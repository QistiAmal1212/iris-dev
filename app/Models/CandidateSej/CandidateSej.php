<?php

namespace App\Models\CandidateSej;

use Illuminate\Database\Eloquent\Model;

class CandidateSej extends Model
{
    protected $table = 'calon_sej';

    protected $fillable = [
    	'no_pengenalan',
        'no_kp_baru',
        'no_kp_lama',
        'no_pasport',
        'warna_kp',
        'nama_penuh',
        'emel',
        'no_tel',
        'kod_ruj_jantina',
        'kod_ruj_status_kahwin',
        'kod_ruj_keturunan',
        'kod_ruj_agama',
        'kewarganegaraan',
        'tinggi',
        'berat',
        'alamat_1',
        'alamat_2',
        'alamat_3',
        'poskod',
        'bandar',
        'tempat_tinggal',
        'alamat_1_tetap',
        'alamat_2_tetap',
        'alamat_3_tetap',
        'poskod_tetap',
        'bandar_tetap',
        'tempat_tinggal_tetap',
        'tarikh_lahir',
        'tempat_lahir',
        'tempat_lahir_bapa',
        'tempat_lahir_ibu',
        'created_by',
        'updated_by',
        'bantuan',
        'biasiswa_p',
        'nom_daftar_bantuan',
        'pusat_temuduga'
    ];

    public function license() {
        return $this->hasOne('App\Models\CandidateSej\CandidateLicenseSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function oku() {
        return $this->hasOne('App\Models\CandidateSej\CandidateOkuSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function skim() {
        return $this->hasMany('App\Models\CandidateSej\CandidateSkimSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function schoolResult() {
        return $this->hasMany('App\Models\CandidateSej\CandidateSchoolResultSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function matriculation() {
        return $this->hasMany('App\Models\CandidateSej\CandidateMatriculationSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function skm() {
        return $this->hasMany('App\Models\CandidateSej\CandidateSkmSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function higherEducation() {
        return $this->hasOne('App\Models\CandidateSej\CandidateHigherEducationSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function professional() {
        return $this->hasMany('App\Models\CandidateSej\CandidateProfessionalSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function experience() {
        return $this->hasOne('App\Models\CandidateSej\CandidateExperienceSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function psl() {
        return $this->hasMany('App\Models\CandidateSej\CandidatePslSej', 'no_pengenalan', 'no_pengenalan');
    }
    
    public function armyPolice() {
        return $this->hasOne('App\Models\CandidateSej\CandidateArmyPoliceSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function language() {
        return $this->hasMany('App\Models\CandidateSej\CandidateLanguageSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function talent() {
        return $this->hasMany('App\Models\CandidateSej\CandidateTalentSej', 'no_pengenalan', 'no_pengenalan');
    }

    public function penalty() {
        return $this->hasMany('App\Models\Candidate\CandidatePenalty', 'no_pengenalan', 'no_pengenalan');
    }

    public function timeline() {
        return $this->hasMany('App\Models\Candidate\CandidateTimeline', 'no_pengenalan', 'no_pengenalan');
    }

    public function interviewCentre(){
        return $this->belongsTo('App\Models\Reference\InterviewCentre', 'pusat_temuduga', 'kod');
    }
}
