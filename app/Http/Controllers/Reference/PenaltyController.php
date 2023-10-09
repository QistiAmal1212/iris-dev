<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Penalty;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class PenaltyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.penalty')->first();
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

        $penalty = Penalty::orderBy('name', 'asc')->orderBy('code', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penalty')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Tatatertib";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($penalty)
                ->editColumn('code', function ($penalty){
                    return $penalty->code;
                })
                ->editColumn('name', function ($penalty) {
                    return $penalty->name;
                })
                ->editColumn('kategori', function ($penalty) {
                    return $penalty->category;
                })
                ->editColumn('action', function ($penalty) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="penaltyForm('.$penalty->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($penalty->is_active) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$penalty->id.'" onclick="toggleActive('.$penalty->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$penalty->id.'" onclick="toggleActive('.$penalty->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.penalty', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_tatatertib,code',
                'name' => 'required|string',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tatatertib',
                'category.required' => 'Sila isikan kategori',
            ]);

            $penalty = Penalty::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'category' => strtoupper($request->category),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penalty')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Tatatertib";
            $log->data_new = json_encode($penalty);
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

            $penalty = Penalty::find($request->penaltyId);

            if (!$penalty) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penalty')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Tatatertib";
            $log->data_new = json_encode($penalty);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $penalty]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $penaltyId = $request->penaltyId;
            $penalty = Penalty::find($penaltyId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penalty')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Tatatertib";
            $log->data_old = json_encode($penalty);

            $request->validate([
                'code' => 'required|string|unique:ruj_tatatertib,code,'.$penaltyId,
                'name' => 'required|string',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tatatertib',
                'category.required' => 'Sila isikan kategori',
            ]);

            $penalty->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'category' => strtoupper($request->category),
                'updated_by' => auth()->user()->id,
            ]);

            $penaltyNewData = Penalty::find($penaltyId);
            $log->data_new = json_encode($penaltyNewData);
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

            $penaltyId = $request->penaltyId;
            $penalty = Penalty::find($penaltyId);

            $is_active = $penalty->is_active;

            $penalty->update([
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
