<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\Negara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Institution;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class InstitutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.institution')->first();
        $this->menu = $this->module->menu;
    }

    public function index(Request $request)
    {
        $roles = auth()->user()->roles;
        $roles = $roles->pluck('id')->toArray();

        $accessRole = $this->menu->role()->whereIn('id', $roles)->get();

        $accessAdd = $accessUpdate = $accessDelete = false;

        foreach($accessRole as $access) {
            if($access->pivot->add){
                $accessAdd = true;
            }

            if($access->pivot->update){
                $accessUpdate = true;
            }

            if($access->pivot->delete){
                $accessDelete = true;
            }
        }

        $negara = Negara::where('sah_yt', true)->orderBy('nama','asc')->get();

        if ($request->ajax()) {
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.institution')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Institusi";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $institution = Institution::orderBy('code', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $institution->where('ref_country_code', $request->activity_type_id);
            }

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $institution->where('type', $request->module_id);
            }

            return Datatables::of($institution->get())
                ->editColumn('code', function ($institution){
                    return $institution->code;
                })
                ->editColumn('name', function ($institution) {
                    return $institution->name;
                })
                ->editColumn('neg', function ($institution) {
                    return $institution->ref_country_code;
                })
                ->editColumn('jenis', function ($institution) {
                    return $institution->type;
                })
                ->editColumn('action', function ($institution) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="institutionForm('.$institution->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($institution->is_active) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$institution->id.'" onclick="toggleActive('.$institution->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$institution->id.'" onclick="toggleActive('.$institution->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.institution', compact('accessAdd', 'accessUpdate', 'accessDelete', 'negara'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_institusi,code',
                'name' => 'required|string',
                'ref_country_code' => 'required|string',
                'type' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama institusi',
                'ref_country_code.required' => 'Sila isikan nama negara',
                'type.required' => 'Sila isikan jenis',
            ]);

            $institution = Institution::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'ref_country_code' => strtoupper($request->ref_country_code),
                'type' => strtoupper($request->type),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.institution')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Institusi";
            $log->data_new = json_encode($institution);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $institution = Institution::find($request->institutionId);

            if (!$institution) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.institution')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Institusi";
            $log->data_new = json_encode($institution);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $institution]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $institutionId = $request->institutionId;
            $institution = Institution::find($institutionId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.institution')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Institusi";
            $log->data_old = json_encode($institution);

            $request->validate([
                'code' => 'required|string|unique:ruj_institusi,code,'.$institutionId,
                'name' => 'required|string',
                'ref_country_code' => 'required|string',
                'type' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama institusi',
                'ref_country_code.required' => 'Sila isikan nama negara',
                'type.required' => 'Sila isikan jenis',
            ]);

            $institution->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'ref_country_code' => strtoupper($request->ref_country_code),
                'type' => strtoupper($request->type),
                'updated_by' => auth()->user()->id,
            ]);

            $institutionNewData = Institution::find($institutionId);
            $log->data_new = json_encode($institutionNewData);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function toggleActive(Request $request)
    {
        DB::beginTransaction();
        try {

            $institutionId = $request->institutionId;
            $institution = Institution::find($institutionId);

            $is_active = $institution->is_active;

            $institution->update([
                'is_active' => !$is_active,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

}
