<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\SkimPerkhidmatan;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class SkimPerkhidmatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.skimperkhidmatan')->first();
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

        $skimperkhidmatan = SkimPerkhidmatan::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skimperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Skim Perkhidmatan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($skimperkhidmatan)
                ->editColumn('kod', function ($skimperkhidmatan){
                    return $skimperkhidmatan->kod;
                })
                ->editColumn('nama', function ($skimperkhidmatan) {
                    return $skimperkhidmatan->nama;
                })
                ->editColumn('action', function ($skimperkhidmatan) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="skimperkhidmatanForm('.$skimperkhidmatan->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($skimperkhidmatan->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$skimperkhidmatan->id.'" onclick="toggleActive('.$skimperkhidmatan->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$skimperkhidmatan->id.'" onclick="toggleActive('.$skimperkhidmatan->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.skimperkhidmatan', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_skim_perkhidmatan,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan skim perkhidmatan',
            ]);

            $skimperkhidmatan = SkimPerkhidmatan::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skimperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Skim Perkhidmatan";
            $log->data_new = json_encode($skimperkhidmatan);
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

            $skimperkhidmatan = SkimPerkhidmatan::find($request->skimperkhidmatanId);

            if (!$skimperkhidmatan) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skimperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Skim Perkhidmatan";
            $log->data_new = json_encode($skimperkhidmatan);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $skimperkhidmatan]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $skimperkhidmatanId = $request->skimperkhidmatanId;
            $skimperkhidmatan = SkimPerkhidmatan::find($skimperkhidmatanId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skimperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Skim Perkhidmatan";
            $log->data_old = json_encode($skimperkhidmatan);

            $request->validate([
                'code' => 'required|string|unique:ruj_skim_perkhidmatan,kod,'.$skimperkhidmatanId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan skim perkhidmatan',
            ]);

            $skimperkhidmatan->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'updated_by' => auth()->user()->id,
            ]);

            $skimperkhidmatanNewData = skimperkhidmatan::find($skimperkhidmatanId);
            $log->data_new = json_encode($skimperkhidmatanNewData);
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

            $skimperkhidmatanId = $request->skimperkhidmatanId;
            $skimperkhidmatan = SkimPerkhidmatan::find($skimperkhidmatanId);

            $sah_yt = $skimperkhidmatan->sah_yt;

            $skimperkhidmatan->update([
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
