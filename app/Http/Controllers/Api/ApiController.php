<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function successResponseFormat($statusCode = '00', $message = '', $data = [], $httpCode = 200)
    {
        return response()->json(
            [
                'status_code' => $statusCode,
                'message' => $message,
                'data' => $data
            ],
            $httpCode
        );
    }

    protected function errorResponseFormat($statusCode = '99', $message = '', $data = [], $httpCode = 500)
    {
        return response()->json(
            [
                'status_code' => $statusCode,
                'message' => $message,
                'errors' => $data
            ],
            $httpCode
        );
    }
}
