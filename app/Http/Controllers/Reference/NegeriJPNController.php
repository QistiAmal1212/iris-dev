<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\NegeriJPN;
use App\Models\Reference\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class NegeriJPNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.negerijpn')->first();
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

        $negeri = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.negerijpn')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai NegeriJPN";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $negerijpn = NegeriJPN::orderBy('kod', 'asc');
            if($request->activity_type_id && $request->activity_type_id != "Lihat Semua"){
                $negerijpn->where('kod',$request->activity_type_id);
            }


            return Datatables::of($negerijpn->get())
                ->editColumn('kod', function ($negerijpn){
                    return $negerijpn->kod;
                })
                ->editColumn('nama', function ($negerijpn) {
                    return $negerijpn->nama;
                })
                ->editColumn('kod_neg', function ($negerijpn) {
                    return $negerijpn->kod_ruj_negeri;
                })
                ->editColumn('action', function ($negerijpn) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="negerijpnForm('.$negerijpn->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($negerijpn->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$negerijpn->id.'" onclick="toggleActive('.$negerijpn->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$negerijpn->id.'" onclick="toggleActive('.$negerijpn->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.negerijpn', compact('accessAdd', 'accessUpdate', 'accessDelete', 'negeri'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|exists:ruj_negeri,kod',
                'name' => 'required|string',
                'kod_ruj_negeri' => 'required|string|unique:ruj_negeri_jpn,kod_ruj_negeri',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.exist' => 'Tiada rekod negeri yang dipilih',
                'name.required' => 'Sila isikan negeri jpn',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.unique' => 'Kod telah diambil',
            ]);

            $negerijpn = NegeriJPN::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'kod_ruj_negeri' => $request->kod_ruj_negeri,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.negerijpn')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah NegeriJPN";
            $log->data_new = json_encode($negerijpn);
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

            $negerijpn = NegeriJPN::find($request->negerijpnId);

            if (!$negerijpn) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.negerijpn')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat NegeriJPN";
            $log->data_new = json_encode($negerijpn);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $negerijpn]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $negerijpnId = $request->negerijpnId;
            $negerijpn = NegeriJPN::find($negerijpnId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.negerijpn')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat NegeriJPN";
            $log->data_old = json_encode($negerijpn);

            $request->validate([
                'code' => 'required|string|exists:ruj_negeri,kod',
                'name' => 'required|string',
                'kod_ruj_negeri' => 'required|string|unique:ruj_negeri_jpn,kod_ruj_negeri,'.$negerijpnId,
            ],[
                'code.required' => 'Sila isikan kod',
                'code.exist' => 'Tiada rekod negeri yang dipilih',
                'name.required' => 'Sila isikan negerijpn',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.unique' => 'Kod telah diambil',
            ]);

            $negerijpn->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'kod_ruj_negeri' => $request->kod_ruj_negeri,
                'updated_by' => auth()->user()->id,
            ]);

            $negerijpnNewData = NegeriJPN::find($negerijpnId);
            $log->data_new = json_encode($negerijpnNewData);
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

            $negerijpnId = $request->negerijpnId;
            $negerijpn = NegeriJPN::find($negerijpnId);

            $sah_yt = $negerijpn->sah_yt;

            $negerijpn->update([
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
