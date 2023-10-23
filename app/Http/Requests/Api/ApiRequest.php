<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    // Overwrite default failed validation function to return Json formatted response.
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status_code' => config('status.status_codes.unprocessable_entity'),
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors(),
                ],
                422
            )
        );
    }
}
