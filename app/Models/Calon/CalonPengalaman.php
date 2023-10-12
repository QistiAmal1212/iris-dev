<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonPengalaman extends Model
{
    protected $table = 'calon_pengalaman';

    protected $fillable = [
    	'no_pengenalan',
        'kod_ruj_pekerjaan',
        'pen1_indicator',
        'sektor_pekerjaan',
        'taraf_jawatan',
        'kod_ruj_gred_gaji',
        'kod_ruj_tingkatan_jkk',
        'kump_pkhidmat',
        'tarikh_lantik',
        'tarikh_mula',
        'tarikh_disahkan',
        'tarikh_tamat',
        'ruj_kem_jabatan',
        'harta',
        'negeri_jabatan',
        'tangga_gaji',
        'gaji_bulanan',
        'pergerakan_gaji',
        'kod_ruj_skim',
        'kod_ruj_negeri',
        'tarikh_tamat_kontrak',
        'daerah_bertugas',
        'created_by',
        'updated_by',
    ];

    public function job() {
        return $this->belongsTo('App\Models\Reference\Job', 'kod_ruj_pekerjaan', 'code');
    }

    public function positionLevel() {
        return $this->belongsTo('App\Models\Reference\PositionLevel', 'taraf_jawatan', 'kod');
    }

    public function salaryGrade() {
        return $this->belongsTo('App\Models\Reference\SalaryGrade', 'kod_ruj_gred_gaji', 'kod');
    }

    public function levelJkk() {
        return $this->belongsTo('App\Models\Reference\LevelJKK', 'kod_ruj_tingkatan_jkk', 'kod');
    }

    public function departmentMinistry() {
        return $this->belongsTo('App\Models\Reference\DepartmentMinistry', 'ruj_kem_jabatan', 'kod');
    }

    public function stateDepartment() {
        return $this->belongsTo('App\Models\Reference\State', 'negeri_jabatan', 'kod');
    }

    public function skim() {
        return $this->belongsTo('App\Models\Reference\Skim', 'kod_ruj_skim', 'kod');
    }

    public function state() {
        return $this->belongsTo('App\Models\Reference\State', 'kod_ruj_negeri', 'kod');
    }

}
