<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class AreaInterviewCentre extends Model
{
    protected $table = 'ref_area_interview_centre';

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'updated_by',
        'is_active',
    ];
}
