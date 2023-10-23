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
        $senaraiApi = SenaraiApi::whereNot('url', 'api/pemohon/details')->get();
        $tableApi = TableApi::get();

        return view('admin.integrasi.integrasi', compact('senaraiApi', 'tableApi'));
    }

    public function storeApi(Request $request) {
        
        DB::beginTransaction();
        try {

            $senaraiApi = SenaraiApi::create([
                'nama' => $request->nama_api,
                'url' => 'api/pemohon/details/'.$request->url_api,
                'nama_path' => $request->url_api,
                'status' => isset($request->status_api) ? 1 : 0,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            if($senaraiApi){
                $senaraiApi->akses()->sync($request->listTable);
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

            $updateApi = $api->update([
                'nama' => $request->nama_api,
                'url' => 'api/pemohon/details/'.$request->url_api,
                'nama_path' => $request->url_api,
                'status' => isset($request->status_api) ? 1 : 0,
                'pengguna' => auth()->user()->id,
            ]);

            if($updateApi){
                $api->akses()->sync($request->listTable);
            }

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function IntegrationInformation (){
        return view('admin.integrasi.integration_information');
    }
}
