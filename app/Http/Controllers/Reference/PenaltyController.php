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

            $penalty = Penalty::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $penalty->where('kategori', $request->activity_type_id);
            }

            return Datatables::of($penalty->get())
                ->editColumn('code', function ($penalty){
                    return $penalty->kod;
                })
                ->editColumn('name', function ($penalty) {
                    return $penalty->diskripsi;
                })
                ->editColumn('kategori', function ($penalty) {
                    return $penalty->kategori;
                })
                ->editColumn('action', function ($penalty) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';

                    if($accessUpdate){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="penaltyForm('.$penalty->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($penalty->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$penalty->id.'" onclick="toggleActive('.$penalty->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$penalty->id.'" onclick="toggleActive('.$penalty->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }else{
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="penaltyForm('.$penalty->id.')"> <i class="fas fa-eye text-primary"></i> ';
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$penalty->id.')"> <i class="fas fa-trash text-danger"></i> ';
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
                'code' => 'required|string|max:10|unique:ruj_tatatertib,kod',
                'name' => 'required|string|max:100',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tatatertib',
                'category.required' => 'Sila isikan kategori',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang tatatertib adalah :max karakter',
            ]);

            $penalty = Penalty::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'kategori' => strtoupper($request->category),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' =>'Y'
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
                'code' => 'required|string|max:10|unique:ruj_tatatertib,kod,'.$penaltyId,
                'name' => 'required|string|max:100',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan tatatertib',
                'category.required' => 'Sila isikan kategori',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang tatatertib adalah :max karakter',
            ]);

            $penalty->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'kategori' => strtoupper($request->category),
                'pengguna' => auth()->user()->id,
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

            $sah_yt = $penalty->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $penalty->update([
                'sah_yt' => $sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function deleteItem(Request $request){
        DB::beginTransaction();
        try{
            $penalty = Penalty::find($request-> penaltyId);

            $penalty->delete();

            if (!$penalty) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.penalty')->firstOrFail()->id;
            $log->activity_type_id = 5;
            $log->description = "Hapus Tatatertib";
            $log->data_new = json_encode($penalty);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['message' => 'Rekod berjaya dihapuskan'], 200);

        }catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
