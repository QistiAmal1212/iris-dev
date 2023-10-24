<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Integrasi\AksesApi;
use App\Models\Integrasi\SenaraiApi;
use App\Models\Integrasi\TableApi;

class IntegrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DashboardIntegration (){
        $senaraiApi = SenaraiApi::whereNot('url', 'api/pemohon/details')->orderBy('id', 'ASC')->get();
        $tableApi = TableApi::get();

        return view('admin.integrasi.integrasi', compact('senaraiApi', 'tableApi'));
    }

    public function storeApi(Request $request) {
        
        DB::beginTransaction();
        try {

            $request->validate([
                'url_api' => 'required|string|unique:senarai_api,nama_path',
                'nama_api' => 'required|string',
                'table_api' => 'required|array',
                'table_api.*' => 'required|exists:table_api,id',
            ],[
                'url_api.required' => 'Sila isikan URL API',
                'url_api.unique' => 'Url api telah diambil',
                'nama_api.required' => 'Sila isikan nama API',
                'table_api.required' => 'Sila pilih table API',
                'table_api.*.exists' => 'Tiada rekod table API yang dipilih',
            ]);

            $senaraiApi = SenaraiApi::create([
                'nama' => $request->nama_api,
                'url' => 'api/pemohon/details/'.$request->url_api,
                'nama_path' => $request->url_api,
                'status' => isset($request->status_api) ? 1 : 0,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'method' => 'GET',
            ]);

            if($senaraiApi){
                $senaraiApi->akses()->sync($request->table_api);
            }

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function editApi(Request $request) {
        $api = SenaraiApi::find($request->idApi);
        $tableApi = TableApi::get();
        $aksesApi = $api->akses->pluck('id')->toArray();

        return view('admin.integrasi.edit_integration_form', compact('api', 'tableApi', 'aksesApi'));
    }

    public function updateApi(Request $request) 
    {
        DB::beginTransaction();
        try {

            $api = SenaraiApi::find($request->idApi);

            if($api->url == 'api/pemohon/store'){
                $request->validate([
                    'nama_api' => 'required|string',
                ],[
                    'nama_api.required' => 'Sila isikan nama API',
                ]);

                $updateApi = $api->update([
                    'nama' => $request->nama_api,
                    'status' => isset($request->status_api) ? 1 : 0,
                    'pengguna' => auth()->user()->id,
                ]);
            } else {

                $request->validate([
                    'url_api' => 'required|string|unique:senarai_api,nama_path,'.$request->idApi,
                    'nama_api' => 'required|string',
                    'table_api' => 'required|array',
                    'table_api.*' => 'required|exists:table_api,id',
                ],[
                    'url_api.required' => 'Sila isikan URL API',
                    'url_api.unique' => 'Url api telah diambil',
                    'nama_api.required' => 'Sila isikan nama API',
                    'table_api.required' => 'Sila pilih table API',
                    'table_api.*.exists' => 'Tiada rekod table API yang dipilih',
                ]);

                $updateApi = $api->update([
                    'nama' => $request->nama_api,
                    'url' => 'api/pemohon/details/'.$request->url_api,
                    'nama_path' => $request->url_api,
                    'status' => isset($request->status_api) ? 1 : 0,
                    'pengguna' => auth()->user()->id,
                    'method' => 'GET',
                ]);

                if($updateApi){
                    $api->akses()->sync($request->table_api);
                }
            }

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateApiStatus(Request $request) 
    {
        DB::beginTransaction();
        try {

            $api = SenaraiApi::find($request->idApi);

            $updateApi = $api->update([
                'status' => $api->status ? 0 : 1,
                'pengguna' => auth()->user()->id,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function IntegrationInformation (Request $request){
        $api = SenaraiApi::with(['log'])->find($request->idApi);

        return view('admin.integrasi.integration_information', compact('api'));
    }
}
