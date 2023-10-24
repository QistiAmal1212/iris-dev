<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Integrasi\LogApi;
use App\Models\Integrasi\SenaraiApi;

class ApiRequest extends FormRequest
{
    // Overwrite default failed validation function to return Json formatted response.
    protected function failedValidation(Validator $validator)
    {
        $routeName = $this->route()->getName();

        if($routeName == 'pemohon.store'){
            $senaraiApi = SenaraiApi::where('url', $this->route()->uri())->first();
        }
        if($routeName == 'pemohon.details')
        {
            $senaraiApi = SenaraiApi::where('nama_path', $this->route('path'))->first();
        }

        $log = new LogApi;
        $log->id_senarai_api = $senaraiApi->id;
        $log->kod_http = config('status.http_codes.unprocessable_entity');
        $log->nama = 'Pengesahan Gagal';
        $log->execution_time = (microtime(true) - LARAVEL_START) * 1000;
        $log->size_request = strlen(request()->getContent()) / 1024;
        $log->status = 0;
        $log->save();

        throw new HttpResponseException(
            response()->json(
                [
                    'status_code' => config('status.status_codes.unprocessable_entity'),
                    'message' => 'Pengesahan Gagal.',
                    'errors' => $validator->errors(),
                ],
                config('status.http_codes.unprocessable_entity')
            )
        );
    }
}
