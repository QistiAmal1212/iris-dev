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

        $jenis = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'JENIS PENGKHUSUSAN')->orderBy('kod', 'asc')->get();
        $bidang = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'BIDANG PENGKHUSUSAN')->orderBy('kod', 'asc')->get();

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

            $specialization = Specialization::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $specialization->where('jenis', $request->activity_type_id);
            }

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $specialization->where('bidang', $request->module_id);
            }

            return Datatables::of($specialization->get())
                ->editColumn('code', function ($specialization){
                    return $specialization->kod;
                })
                ->editColumn('name', function ($specialization) {
                    return $specialization->diskripsi;
                })
                ->editColumn('type', function ($specialization) {
                    return $specialization->jenis;
                })
                ->editColumn('field', function ($specialization) {
                    return $specialization->bidang;
                })
                ->editColumn('action', function ($specialization) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="specializationForm('.$specialization->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($specialization->sah_yt=='Y') {
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
                'code' => 'required|string|unique:ruj_pengkhususan,kod',
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
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->type),
                'bidang' => strtoupper($request->field),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
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
                'code' => 'required|string|unique:ruj_pengkhususan,kod,'.$specializationId,
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
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->type),
                'bidang' => strtoupper($request->field),
                'pengguna' => auth()->user()->id,
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

            $sah_yt = $specialization->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $specialization->update([
                'sah_yt' => $sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
