<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class MasterFaqType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'master_faq_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function faq()
    {
        $lang = session('locale');
        return $this->hasMany('App\Models\Other\Faq', 'faq_type_id', 'id')->where('lang', $lang ? $lang : 'ms');
    }
}
