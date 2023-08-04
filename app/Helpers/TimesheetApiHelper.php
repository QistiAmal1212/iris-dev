<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class TimesheetApiHelper
{
    public static function getAccessToken()
    {
        $accessToken = null;

        try {

            $response = Http::post(config('timesheet.base_url') . '/auth/login', [
                'email' => config('timesheet.username'),
                'password' => config('timesheet.password'),
                'app_name' => config('timesheet.app_name'),
            ]);

            $responseObj = (object) $response->json();
            if ($responseObj->success) {
                $accessToken = $responseObj->data['token'];
            }

        } catch (\Throwable $th) {
            $accessToken = false;
        }

        return $accessToken;
    }
}
