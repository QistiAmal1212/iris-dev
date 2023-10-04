<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\TawaranKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class TawaranKursusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.tawarankursus')->first();
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

        $tawarankursus = TawaranKursus::all();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.tawarankursus')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Tawaran Kursus";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($tawarankursus)
                ->editColumn('kod', function ($tawarankursus){
                    return $tawarankursus->kod;
                })
                ->editColumn('nama', function ($tawarankursus) {
                    return $tawarankursus->nama;
                })
                ->editColumn('diskripsi', function ($tawarankursus) {
                    return $tawarankursus->diskripsi;
                })
                ->editColumn('action', function ($tawarankursus) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="tawarankursusForm('.$tawarankursus->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($tawarankursus->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$tawarankursus->id.'" onclick="toggleActive('.$tawarankursus->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$tawarankursus->id.'" onclick="toggleActive('.$tawarankursus->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.tawaran_kursus', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_tawaran_kursus,kod',
                'name' => 'required|string',
                'jenis' => 'required|string',
                'diskripsi' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tawaran kursus',
                'jenis.required' => 'Sila isikan jenis kursus',
                'diskripsi.required' => 'Sila isikan diskripsi penuh',
            ]);

            $tawarankursus = TawaranKursus::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'jenis' => strtoupper($request->jenis),
                'diskripsi' => strtoupper($request->diskripsi),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.tawarankursus')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Tawaran Kursus";
            $log->data_new = json_encode($tawarankursus);
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

            $tawarankursus = TawaranKursus::find($request->tawarankursusId);

            if (!$tawarankursus) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.tawarankursus')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Tawaran Kursus";
            $log->data_new = json_encode($tawarankursus);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $tawarankursus]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $tawarankursusId = $request->tawarankursusId;
            $tawarankursus = TawaranKursus::find($tawarankursusId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.tawarankursus')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Tawaran Kursus";
            $log->data_old = json_encode($tawarankursus);

            $request->validate([
                'code' => 'required|string|unique:ruj_tawaran_kursus,kod,'.$tawarankursusId,
                'name' => 'required|string',
                'jenis' => 'required|string',
                'diskripsi' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tawarankursus',
                'jenis.required' => 'Sila isikan jenis kursus',
                'diskripsi.required' => 'Sila isikan diskripsi penuh',
            ]);

            $tawarankursus->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'jenis' => strtoupper($request->jenis),
                'diskripsi' => strtoupper($request->diskripsi),
                'updated_by' => auth()->user()->id,
            ]);

            $tawarankursusNewData = tawarankursus::find($tawarankursusId);
            $log->data_new = json_encode($tawarankursusNewData);
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

            $tawarankursusId = $request->tawarankursusId;
            $tawarankursus = TawaranKursus::find($tawarankursusId);

            $sah_yt = $tawarankursus->sah_yt;

            $tawarankursus->update([
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
