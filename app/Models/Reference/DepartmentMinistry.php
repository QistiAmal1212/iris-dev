<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Model;

class DepartmentMinistry extends Model
{
    protected $table = 'ref_department_ministry';

    protected $fillable = [
        'code',
        'name',
        'address_1',
        'address_2',
        'address_3',
        'poscode',
        'city',
        'email',
        'phone_number',
        'created_by',
        'updated_by',
    ];
}
