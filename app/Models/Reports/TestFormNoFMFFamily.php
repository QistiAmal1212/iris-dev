<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TestFormNoFMFFamily extends Model
{
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test_form_no_fmf_family';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $dates = [];

    public $fillable = [
        'test_form_no_fmf_id',
        'name',
        'age',
        'gender',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }

    public function testFormNoFMF():BelongsTo
    {
        return $this->belongsTo(TestFormNoFMF::class,'test_form_no_fmf');
    }

}
