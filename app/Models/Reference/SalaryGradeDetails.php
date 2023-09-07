<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class SalaryGradeDetails extends Model
{
    protected $table = 'ref_salary_grade_details';

    protected $fillable = [
        'ref_salary_grade_code',
        'level',
        'year',
        'amount',
        'starting_salary',
        'created_by',
        'updated_by',
    ];
}
