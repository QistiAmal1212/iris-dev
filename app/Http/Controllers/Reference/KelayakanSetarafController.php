<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KelayakanSetaraf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class KelayakanSetarafController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.kelayakansetaraf')->first();
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

        $kelayakansetaraf = KelayakanSetaraf::orderBy('nama', 'asc')->orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kelayakansetaraf')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kelayakan Setaraf";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($kelayakansetaraf)
                ->editColumn('kod', function ($kelayakansetaraf){
                    return $kelayakansetaraf->kod;
                })
                ->editColumn('nama', function ($kelayakansetaraf) {
                    return $kelayakansetaraf->nama;
                })
                ->editColumn('action', function ($kelayakansetaraf) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="kelayakansetarafForm('.$kelayakansetaraf->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($kelayakansetaraf->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$kelayakansetaraf->id.'" onclick="toggleActive('.$kelayakansetaraf->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$kelayakansetaraf->id.'" onclick="toggleActive('.$kelayakansetaraf->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.kelayakan_setaraf', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_kelayakan_setaraf,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kelayakan setaraf',
            ]);

            $kelayakansetaraf = KelayakanSetaraf::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kelayakansetaraf')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kelayakan Setaraf";
            $log->data_new = json_encode($kelayakansetaraf);
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

            $kelayakansetaraf = KelayakanSetaraf::find($request->kelayakansetarafId);

            if (!$kelayakansetaraf) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kelayakansetaraf')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kelayakan Setaraf";
            $log->data_new = json_encode($kelayakansetaraf);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $kelayakansetaraf]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $kelayakansetarafId = $request->kelayakansetarafId;
            $kelayakansetaraf = KelayakanSetaraf::find($kelayakansetarafId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kelayakansetaraf')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kelayakan Setaraf";
            $log->data_old = json_encode($kelayakansetaraf);

            $request->validate([
                'code' => 'required|string|unique:ruj_kelayakan_setaraf,kod,'.$kelayakansetarafId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kelayakan setaraf',
            ]);

            $kelayakansetaraf->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'updated_by' => auth()->user()->id,
            ]);

            $kelayakansetarafNewData = kelayakansetaraf::find($kelayakansetarafId);
            $log->data_new = json_encode($kelayakansetarafNewData);
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

            $kelayakansetarafId = $request->kelayakansetarafId;
            $kelayakansetaraf = KelayakanSetaraf::find($kelayakansetarafId);

            $sah_yt = $kelayakansetaraf->sah_yt;

            $kelayakansetaraf->update([
                'sah_yt' => !$sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
