<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KetuaPerkhidmatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class KetuaPerkhidmatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.ketuaperkhidmatan')->first();
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

        $ketuaperkhidmatan = KetuaPerkhidmatan::all();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ketuaperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Ketua Perkhidmatan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($ketuaperkhidmatan)
                ->editColumn('kod', function ($ketuaperkhidmatan){
                    return $ketuaperkhidmatan->kod;
                })
                ->editColumn('nama', function ($ketuaperkhidmatan) {
                    return $ketuaperkhidmatan->nama;
                })
                ->editColumn('action', function ($ketuaperkhidmatan) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="ketuaperkhidmatanForm('.$ketuaperkhidmatan->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($ketuaperkhidmatan->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$ketuaperkhidmatan->id.'" onclick="toggleActive('.$ketuaperkhidmatan->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$ketuaperkhidmatan->id.'" onclick="toggleActive('.$ketuaperkhidmatan->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.ketua_perkhidmatan', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_ketua_perkhidmatan,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan ketua perkhidmatan',
            ]);

            $ketuaperkhidmatan = KetuaPerkhidmatan::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ketuaperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Ketua Perkhidmatan";
            $log->data_new = json_encode($ketuaperkhidmatan);
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

            $ketuaperkhidmatan = KetuaPerkhidmatan::find($request->ketuaperkhidmatanId);

            if (!$ketuaperkhidmatan) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ketuaperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Ketua Perkhidmatan";
            $log->data_new = json_encode($ketuaperkhidmatan);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $ketuaperkhidmatan]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $ketuaperkhidmatanId = $request->ketuaperkhidmatanId;
            $ketuaperkhidmatan = KetuaPerkhidmatan::find($ketuaperkhidmatanId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ketuaperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Ketua Perkhidmatan";
            $log->data_old = json_encode($ketuaperkhidmatan);

            $request->validate([
                'code' => 'required|string|unique:ruj_ketua_perkhidmatan,kod,'.$ketuaperkhidmatanId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan ketua perkhidmatan',
            ]);

            $ketuaperkhidmatan->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'updated_by' => auth()->user()->id,
            ]);

            $ketuaperkhidmatanNewData = ketuaperkhidmatan::find($ketuaperkhidmatanId);
            $log->data_new = json_encode($ketuaperkhidmatanNewData);
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

            $ketuaperkhidmatanId = $request->ketuaperkhidmatanId;
            $ketuaperkhidmatan = KetuaPerkhidmatan::find($ketuaperkhidmatanId);

            $sah_yt = $ketuaperkhidmatan->sah_yt;

            $ketuaperkhidmatan->update([
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
