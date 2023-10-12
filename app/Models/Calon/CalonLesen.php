<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Model;

class CalonLesen extends Model
{
    protected $table = 'calon_lesen';

    protected $fillable = [
    	'no_pengenalan',
        'jenis_lesen',
        'tempoh_tamat',
        'status_senaraihitam',
        'msg_senaraihitam',
        'created_by',
        'updated_by',
    ];

    protected $primaryKey='no_pengenalan';
    public $incrementing = false;
}
