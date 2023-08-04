<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::orderBy('created_at', 'DESC')->paginate(20);
        $eventArr = $activities->unique('event')->pluck('event');
        $subjectTypeArr = $activities->unique('subject_type')->pluck('subject_type');
        $causer_id = $activities->unique('causer_id')->pluck('causer_id');
        $users = User::whereIn('id', $causer_id)->get();

        return view('admin.log.index', compact([
            'activities',
            'eventArr',
            'subjectTypeArr',
            'users',
        ]));
    }
}
