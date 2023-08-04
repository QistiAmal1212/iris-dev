<?php

namespace App\Models\Reports;

use DeveloperUnijaya\FlowManagementFunction\Models\Module;
use DeveloperUnijaya\FlowManagementFunction\Models\ModuleStatus;
use App\Models\Email;
use DeveloperUnijaya\LaravelUploadedFile\Http\Traits\HasUploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TestForm extends Model
{
    use LogsActivity, HasUploadedFile;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test_form';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $dates = [];

    public $fillable = [
        'id',
        'module_id',
        'module_status_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function moduleStatus(): BelongsTo
    {
        return $this->belongsTo(ModuleStatus::class, 'module_status_id');
    }

    public function email(){

        return $this->hasMany(Email::class, 'entity_id', 'id')
        ->where('entity_type', get_class($this));
    }
}
