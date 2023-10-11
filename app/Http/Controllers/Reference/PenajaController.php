<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\Penaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class PenajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.penaja')->first();
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

        $penaja = Penaja::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penaja')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Penaja";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($penaja)
                ->editColumn('kod', function ($penaja){
                    return $penaja->kod;
                })
                ->editColumn('nama', function ($penaja) {
                    return $penaja->diskripsi;
                })
                ->editColumn('jenis', function ($penaja) {
                    return $penaja->jenis;
                })
                ->editColumn('action', function ($penaja) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="penajaForm('.$penaja->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($penaja->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$penaja->id.'" onclick="toggleActive('.$penaja->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$penaja->id.'" onclick="toggleActive('.$penaja->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.penaja', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_penaja,kod',
                'name' => 'required|string',
                'jenis' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan penaja',
                'jenis.required' => 'Sila isikan jenis',
            ]);

            $penaja = Penaja::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->jenis),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penaja')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Penaja";
            $log->data_new = json_encode($penaja);
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

            $penaja = Penaja::find($request->penajaId);

            if (!$penaja) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penaja')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Penaja";
            $log->data_new = json_encode($penaja);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $penaja]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $penajaId = $request->penajaId;
            $penaja = Penaja::find($penajaId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penaja')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Penaja";
            $log->data_old = json_encode($penaja);

            $request->validate([
                'code' => 'required|string|unique:ruj_penaja,kod,'.$penajaId,
                'name' => 'required|string',
                'jenis' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan penaja',
                'jenis.required' => 'Sila isikan jenis',
            ]);

            $penaja->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->jenis),
                'pengguna' => auth()->user()->id,
            ]);

            $penajaNewData = penaja::find($penajaId);
            $log->data_new = json_encode($penajaNewData);
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

            $penajaId = $request->penajaId;
            $penaja = Penaja::find($penajaId);

            $sah_yt = $penaja->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $penaja->update([
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
