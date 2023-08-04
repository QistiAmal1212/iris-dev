<?php

namespace App\Models\Reports;

use App\Models\Reports\ReportHelpdeskIssues;
use App\Models\Email;
use DeveloperUnijaya\LaravelUploadedFile\Http\Traits\HasUploadedFile;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReportHelpdesk extends Model
{
    use HasUploadedFile;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'report_helpdesk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $dates = [
        'tarikh_disediakan',
        'tarikh_disahkan',
        'start_date',
        'end_date',
    ];

    public $fillable = [
        'id',
        'project_id',
        'title',
        'title_original',
        'week',
        'month',
        'year',
        'start_date',
        'end_date',
        'status',
        'signature_penyedia',
        'nama_penyedia',
        'jawatan_penyedia',
        'tarikh_disediakan',
        'signature_pengesah',
        'nama_pengesah',
        'jawatan_pengesah',
        'tarikh_disahkan',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }

    public function month_type()
    {
        return $this->belongsTo('App\Models\Master\MasterMonth', 'month', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    public function getIssues()
    {
        return $this->hasMany(ReportHelpdeskIssues::class, 'report_helpdesk_id', 'id');
    }

    public function email(){
        return $this->hasMany(Email::class, 'entity_id', 'id')
        ->where('entity_type', 'ReportHelpdesk');
    }

    public function getIssuesByWeek($week = 0) {
        return $this->hasMany(ReportHelpdeskIssues::class, 'report_helpdesk_id', 'id')
        ->where('week',$week)->orderBy('date_issued','asc');
    }

    public function uploadedFiles($docType = null)
    {
        return $this->hasMany(UploadedFile::class, 'borang_id', 'id')
            ->where('entity_type', 'ReportHelpdesk')
            ->when($docType != null, function ($query) use ($docType) { //if ada jenis doctype (panggil secara specifik), baru search for it. if not, cari untuk semua
                $query->where('doc_type', $docType);
            });
    }

}
