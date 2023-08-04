<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use DeveloperUnijaya\LaravelUploadedFile\Http\Traits\HasUploadedFile;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;

class TestFormNoFMF extends Model
{
    use LogsActivity, HasUploadedFile;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test_form_no_fmf';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $dates = ['user_birth_date'];

    public $fillable = [
        'user_full_name',
        'user_ic',
        'user_address',
        'user_birth_date',
        'user_gender',
        'user_is_married'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }

    //Relationship One TestFormNoFMF have many TestFamily
    public function testFamily(){

        return $this->hasMany(TestTable::class, 'test_form_no_fmf_id', 'id');
    }

    public function email(){

        return $this->hasMany(Email::class, 'entity_id', 'id')
        ->where('entity_type', get_class($this));
    }

    /**
     * Methods to check if specific Section is Completed or Not.
     */
    public function isSectionASubCCompleted()
    {
        $v = Validator::make([
            'user_full_name' => $this->user_full_name,
            'user_ic' => $this->user_ic,
            'user_birth_date' => $this->user_birth_date,
            'user_gender' => $this->user_gender,
        ],[
            'user_full_name' => ['required','min:1'],
            'user_ic' => ['required','min_digits:12','max_digits:12'],
            'user_birth_date' => ['required'],
            'user_gender' => ['required'],
        ]);

        // Uncomment to view error
        // dd($v->errors());
        return $v->fails() ? false : true;
    }
}
