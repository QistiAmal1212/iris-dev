<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\PositionLevel;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class PositionLevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.position-level')->first();
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

        $positionLevel = PositionLevel::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.position-level')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Taraf Jawatan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($positionLevel)
                ->editColumn('code', function ($positionLevel){
                    return $positionLevel->kod;
                })
                ->editColumn('name', function ($positionLevel) {
                    return $positionLevel->diskripsi;
                })
                ->editColumn('action', function ($positionLevel) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="positionLevelForm('.$positionLevel->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($positionLevel->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$positionLevel->id.'" onclick="toggleActive('.$positionLevel->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$positionLevel->id.'" onclick="toggleActive('.$positionLevel->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.position_level', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_taraf_jawatan,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan taraf jawatan',
            ]);

            $tarafJawatan = PositionLevel::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.position-level')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Taraf Jawatan";
            $log->data_new = json_encode($tarafJawatan);
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

            $positionLevel = PositionLevel::find($request->positionLevelId);

            if (!$positionLevel) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.position-level')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Taraf Jawatan";
            $log->data_new = json_encode($positionLevel);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $positionLevel]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $positionLevelId = $request->positionLevelId;
            $positionLevel = PositionLevel::find($positionLevelId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.position-level')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Taraf Jawatan";
            $log->data_old = json_encode($positionLevel);

            $request->validate([
                'code' => 'required|string|unique:ruj_taraf_jawatan,kod,'.$positionLevelId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan taraf jawatan',
            ]);

            $positionLevel->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'pengguna' => auth()->user()->id,
            ]);

            $positionLevelNewData = PositionLevel::find($positionLevelId);
            $log->data_new = json_encode($positionLevelNewData);
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

            $positionLevelId = $request->positionLevelId;
            $positionLevel = PositionLevel::find($positionLevelId);

            $sah_yt = $positionLevel->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $positionLevel->update([
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
