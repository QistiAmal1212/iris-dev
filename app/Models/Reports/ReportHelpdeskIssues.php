<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ReportHelpdeskIssues extends Model
{
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'report_helpdesk_issues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'custom_data' => 'array'
    ];

    protected $primaryKey = 'id';

    protected $dates = [
        'date_issued',
        'date_completed',
        'date_response',
    ];

    public $fillable = [
        'id',
        'report_helpdesk_id',
        'master_medium_id',
        'title',
        'explanation',
        'category',
        'date_issued',
        'status',
        'tracking_id',
        'nama_pengguna',
        'issue_group',
        'date_response',
        'date_completed',
        'action',
        'api_id',
        'custom_data'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*'])->logOnlyDirty();
    }

    public function reportHelpdesk()
    {
        return $this->belongsTo('App\Models\Reports\ReportHelpdesk', 'report_helpdesk_id', 'id');
    }

    public function masterStatus()
    {
        return $this->belongsTo('App\Models\Reports\ReportHelpdeskMasterStatus', 'status');
    }

    public function masterMedium() {
        return $this->belongsTo('App\Models\Master\MasterMedium','master_medium_id');
    }

    public function api_data()
    {
        return $this->api_id
        ? $this->hasMany('App\Models\ApiHelpdeskIssues', 'api_id', 'api_id')
            ->where('project_id', $this->reportHelpdesk->project_id)
        : $this->hasMany('App\Models\ApiHelpdeskIssues', 'api_id', 'id')
        ->where('project_id', 999999);
    }
}
