<?php

namespace App\Http\Controllers;

use App\Helpers\TimesheetApiHelper;
use App\Models\Project;
use App\Models\ProjectTimesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{

    public function updateTimesheet(Request $request)
    {
        $accessToken = TimesheetApiHelper::getAccessToken();
        dd($accessToken);
        // $headers = [
        //     'Authorization' => 'Bearer ' . $accessToken,
        //     'accept' => 'application/json',
        // ];

        // $response = Http::withToken($accessToken)->get(config('timesheet.base_url') . '/timesheet');
        // $response = Http::withHeader($headers)->get(config('timesheet.base_url') . '/timesheet');

        $response = Http::get(config('timesheet.base_url') . '/timesheet');

        $responseObj = (object) $response->json();

        if ($responseObj->success) {

            $timesheets = $responseObj->data;

            foreach ($timesheets as $timesheet) {

                $timesheet = (object) $timesheet;

                if ($timesheet->project && $timesheet->user) {
                    $tsUser = (object) $timesheet->user;
                    $tsProject = (object) $timesheet->project;

                    // Sync User
                    $user = User::firstOrNew(['email' => $tsUser->email]);
                    if (!$user->exists) {
                        $user->name = $tsUser->name;
                        $user->email = $tsUser->email;
                        $user->isClient = 0;
                        $user->password = Hash::make('password');
                        $user->is_active = 1;
                        $user->save();
                    }

                    $project = Project::where('project_id_ts', $tsProject->id)->first();

                    if ($project) {
                        $projectTimesheet = ProjectTimesheet::firstOrNew(['ts_id' => $timesheet->id]);

                        $projectTimesheet->user_id = $user->id;
                        $projectTimesheet->project_id = $project->id;
                        $projectTimesheet->ts_id = $timesheet->id;
                        $projectTimesheet->ts_percentage = $timesheet->percentage;
                        $projectTimesheet->ts_daily_rate = $timesheet->daily_rate;
                        $projectTimesheet->ts_date = Carbon::parse($timesheet->timesheet_date);
                        $projectTimesheet->ts_week = $timesheet->week;
                        $projectTimesheet->ts_year = $timesheet->year;
                        $projectTimesheet->ts_submitted_at = Carbon::parse($timesheet->submitted_at);

                        $projectTimesheet->save();
                    }
                }

            }
        }
        // dd($responseObj);
    }
}
