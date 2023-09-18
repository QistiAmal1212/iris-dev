<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $table = 'ref_specialization';

    protected $fillable = [
        'code',
        'name',
        'pemerolehan_code',
        'type',
        'field',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function jenis()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'type', 'kod');
    }

    public function bidang()
    {
        return $this->belongsTo('App\Models\Reference\KodPelbagai', 'field', 'kod');
    }
}
