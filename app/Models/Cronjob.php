<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cronjob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cronjob';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

}
