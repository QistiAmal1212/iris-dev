<?php

namespace App\Models\Candidate;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'calon';

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
