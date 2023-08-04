<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo('App\Models\Master\MasterFaqType', 'faq_type_id', 'id');
    }
}
