<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class InterviewCentre extends Model
{
    protected $table = 'ref_interview_centre';

    protected $fillable = [
        'code',
        'name',
        'ref_area_interview_centre',
        'ref_state_code',
        'short_name',
        'created_by',
        'updated_by',
    ];
}
