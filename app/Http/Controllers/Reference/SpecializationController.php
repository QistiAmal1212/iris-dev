<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KodPelbagai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Specialization;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class SpecializationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.specialization')->first();
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

        $jenis = KodPelbagai::where('kategori', 'JENIS PENGKHUSUSAN')->orderBy('kod', 'asc')->get();
        $bidang = KodPelbagai::where('kategori', 'BIDANG PENGKHUSUSAN')->orderBy('kod', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.specialization')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Pengkhususan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $specialization = Specialization::orderBy('code', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $specialization->where('type', $request->activity_type_id);
            }

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $specialization->where('field', $request->module_id);
            }

            return Datatables::of($specialization->get())
                ->editColumn('code', function ($specialization){
                    return $specialization->code;
                })
                ->editColumn('name', function ($specialization) {
                    return $specialization->name;
                })
                ->editColumn('type', function ($specialization) {
                    return $specialization->type;
                })
                ->editColumn('field', function ($specialization) {
                    return $specialization->field;
                })
                ->editColumn('action', function ($specialization) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="specializationForm('.$specialization->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($specialization->is_active) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$specialization->id.'" onclick="toggleActive('.$specialization->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$specialization->id.'" onclick="toggleActive('.$specialization->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.specialization', compact('accessAdd', 'accessUpdate', 'accessDelete', 'jenis', 'bidang'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_pengkhususan,code',
                'name' => 'required|string',
                'type' => 'required|string',
                'field' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama pengkhususan',
                'type.required' => 'Sila isikan jenis pengkhususan',
                'field.required' => 'Sila isikan bidang pengkhususan',
            ]);

            $specialization = Specialization::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'type' => strtoupper($request->type),
                'field' => strtoupper($request->field),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.specialization')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Pengkhususan";
            $log->data_new = json_encode($specialization);
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

            $specialization = Specialization::find($request->specializationId);

            if (!$specialization) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.specialization')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Pengkhususan";
            $log->data_new = json_encode($specialization);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $specialization]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $specializationId = $request->specializationId;
            $specialization = Specialization::find($specializationId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.specialization')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Pengkhususan";
            $log->data_old = json_encode($specialization);

            $request->validate([
                'code' => 'required|string|unique:ruj_pengkhususan,code,'.$specializationId,
                'name' => 'required|string',
                'type' => 'required|string',
                'field' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama jawatan',
                'type.required' => 'Sila isikan jenis pengkhususan',
                'field.required' => 'Sila isikan bidang pengkhususan',
            ]);

            $specialization->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'type' => strtoupper($request->type),
                'field' => strtoupper($request->field),
                'updated_by' => auth()->user()->id,
            ]);

            $specializationNewData = Specialization::find($specializationId);
            $log->data_new = json_encode($specializationNewData);
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

            $specializationId = $request->specializationId;
            $specialization = Specialization::find($specializationId);

            $is_active = $specialization->is_active;

            $specialization->update([
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
