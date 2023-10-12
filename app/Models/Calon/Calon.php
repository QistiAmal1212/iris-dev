<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $table = 'calon';

    protected $fillable = [
    	'no_pengenalan',
        'no_kp_baru',
        'no_kp_lama',
        'no_pasport',
        'warna_kp',
        'nama_penuh',
        'e_mel',
        'no_tel',
        'jan_kod',
        'taraf_perkahwinan',
        'ket_kod',
        'agama',
        'kewarganegaraan',
        'ketinggian',
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
        'id_pencipta',
        'pengguna',
        'bantuan',
        'biasiswa_p',
        'nom_daftar_bantuan',
        'pusat_temuduga'
    ];

    protected $primaryKey='no_pengenalan';
    public $incrementing = false;
    protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function license() {
        return $this->hasOne('App\Models\Calon\CalonLesen', 'cal_no_pengenalan', 'no_pengenalan');
    }

    public function oku() {
        return $this->hasOne('App\Models\Calon\CalonOku', 'no_pengenalan', 'no_pengenalan');
    }

    public function skim() {
        return $this->hasMany('App\Models\Calon\CalonSkim', 'no_pengenalan', 'no_pengenalan');
    }

    public function schoolResult() {
        return $this->hasMany('App\Models\Calon\CalonKeputusanSekolah', 'cal_no_pengenalan', 'no_pengenalan');
    }

    public function matriculation() {
        return $this->hasMany('App\Models\Calon\CalonMatrikulasi', 'cal_no_pengenalan', 'no_pengenalan');
    }

    public function skm() {
        return $this->hasMany('App\Models\Calon\CalonSkm', 'no_pengenalan', 'no_pengenalan');
    }

    public function higherEducation() {
        return $this->hasOne('App\Models\Calon\CalonPengajianTinggi', 'no_pengenalan', 'no_pengenalan');
    }

    public function professional() {
        return $this->hasMany('App\Models\Calon\CalonProfesional', 'no_pengenalan', 'no_pengenalan');
    }

    public function experience() {
        return $this->hasOne('App\Models\Calon\CalonPengalaman', 'no_pengenalan', 'no_pengenalan');
    }

    public function psl() {
        return $this->hasMany('App\Models\Calon\CalonPsl', 'no_pengenalan', 'no_pengenalan');
    }

    public function armyPolice() {
        return $this->hasOne('App\Models\Calon\CalonTenteraPolis', 'no_pengenalan', 'no_pengenalan');
    }

    public function language() {
        return $this->hasMany('App\Models\Calon\CalonBahasa', 'no_pengenalan', 'no_pengenalan');
    }

    public function talent() {
        return $this->hasMany('App\Models\Calon\CalonBakat', 'no_pengenalan', 'no_pengenalan');
    }

    public function penalty() {
        return $this->hasMany('App\Models\Calon\CalonTatatertib', 'no_pengenalan', 'no_pengenalan');
    }

    public function timeline() {
        return $this->hasMany('App\Models\Calon\CalonGarisMasa', 'no_pengenalan', 'no_pengenalan');
    }

    public function interviewCentre(){
        return $this->belongsTo('App\Models\Reference\InterviewCentre', 'pusat_temuduga', 'kod');
    }
}
