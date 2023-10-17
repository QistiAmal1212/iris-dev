<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonPengalaman extends Model
{
    protected $table = 'calon_pengalaman';

    protected $fillable = [
    	'cal_no_pengenalan',
        'pek_kod',
        'pen1_indicator',
        'sektor_pekerjaan',
        'taraf_jawatan',
        'ggh_kod',
        'tj_kod',
        'kump_pkhidmat',
        'tarikh_lantik1',
        'tarikh_mula',
        'tarikh_disahkan',
        'tarikh_tamat',
        'kj_kod',
        'harta',
        'negeri_jabatan',
        'tangga_gaji',
        'gaji_bulanan',
        'pergerakan_gaji',
        'ski_kod',
        'neg_kod',
        'tarikh_tamat_kontrak',
        'daerah_bertugas',
        'id_pencipta',
        'pengguna',
    ];

    // protected $primaryKey='cal_no_pengenalan';
    // public $incrementing = false;
    // protected $keyType = 'string';
    const CREATED_AT = 'tarikh_cipta';
    const UPDATED_AT = 'tarikh_ubahsuai';

    public function job() {
        return $this->belongsTo('App\Models\Reference\Job', 'pek_kod', 'kod');
    }

    public function positionLevel() {
        return $this->belongsTo('App\Models\Reference\PositionLevel', 'taraf_jawatan', 'kod');
    }

    public function salaryGrade() {
        return $this->belongsTo('App\Models\Reference\SalaryGrade', 'ggh_kod', 'kod');
    }

    public function levelJkk() {
        return $this->belongsTo('App\Models\Reference\LevelJKK', 'tj_kod', 'kod');
    }

    public function departmentMinistry() {
        return $this->belongsTo('App\Models\Reference\DepartmentMinistry', 'kj_kod', 'kod');
    }

    public function stateDepartment() {
        return $this->belongsTo('App\Models\Reference\State', 'negeri_jabatan', 'kod');
    }

    public function skim() {
        return $this->belongsTo('App\Models\Reference\Skim', 'ski_kod', 'kod');
    }

    public function state() {
        return $this->belongsTo('App\Models\Reference\State', 'neg_kod', 'kod');
    }

}
