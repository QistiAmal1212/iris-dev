<?php

namespace App\Http\Controllers;

use App\Models\LogSystem;
use App\Models\Master\MasterActivityType;
use App\Models\Master\MasterModule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $module = MasterModule::all();
        $activityType = MasterActivityType::all();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.log')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Show List Audit Trail / Log System";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $audit_log = LogSystem::with(['module', 'activity_type', 'created_by'])->orderBy('created_at', 'desc');

            if ($request->activity_type_id) {
                $audit_log->where('activity_type_id', $request->activity_type_id);
            }

            if ($request->module_id) {
                $audit_log->where('module_id', $request->module_id);
            }

            if ($request->date_start) {
                $audit_log->where('created_at', '>=', Carbon::createFromFormat('Y-m-d H:i:s', $request->date_start." 00:00:00")->toDateTimeString());
            }

            if ($request->date_end) {
                $audit_log->where('created_at', '<=', Carbon::createFromFormat('Y-m-d H:i:s', $request->date_end." 23:59:59")->toDateTimeString());
            }

            return datatables()->of($audit_log->get())
                ->editColumn('activity_type.name', function ($audit_log) {
                    if ($audit_log->activity_type_id == 5) {
                        return '<span class="badge bg-danger">' . $audit_log->activity_type->name . '</span>';
                    } else {
                        return '<span class="badge bg-secondary">' . $audit_log->activity_type->name . '</span>';
                    }
                })
                ->editColumn('created_by_user_id', function ($audit_log) {

                    $text = '';

                    $text .= '<p>' . optional($audit_log->created_by)->name . '</p>';
                    $text .= '<p><span class="badge bg-light-secondary"> <span class="fa fa-user"></span> ' . optional($audit_log->created_by)->no_ic . '</span></p>';
                    $text .= '<p><span class="badge bg-light-primary mb-1"> <span class="fa fa-envelope"></span> ' . optional($audit_log->created_by)->email . '</span></p>';

                    return $text;
                })
                ->editColumn('created_at', function ($audit_log) {
                    return date('d/m/Y h:i A', strtotime($audit_log->created_at));
                })
                ->editColumn('action', function ($audit_log) {
                    $button = "";
                    $button .= '<a onclick="view(' . $audit_log->id . ')" href="javascript:;" class="btn btn-default btn-xs text-capitalize"><i class="fa fa-eye"></i></a> ';
                    return $button;
                })
                ->make(true);
        }

        return view('admin.log.index', compact(['module', 'activityType']));
    }

    public function view(Request $request)
    {
        $audit_log = LogSystem::findOrFail($request->id);

        $log = new LogSystem;
        $log->module_id = MasterModule::where('code', 'admin.log')->firstOrFail()->id;
        $log->activity_type_id = 2;
        $log->description = "Open View Audit Trail / Log System";
        $log->url = $request->fullUrl();
        $log->method = strtoupper($request->method());
        $log->ip_address = $request->ip();
        $log->created_by_user_id = auth()->id();
        $log->save();

        return view('admin.log.view', compact('audit_log'));
    }
}