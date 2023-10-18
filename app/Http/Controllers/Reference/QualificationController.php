<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KodPelbagai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Qualification;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class QualificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.qualification')->first();
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

        $jenis = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'JENIS KELULUSAN')->orderBy('kod', 'asc')->get();
        $bidang = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'KATEGORI KELULUSAN')->orderBy('kod', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.qualification')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kelulusan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $qualification = Qualification::orderBy('kod', 'asc');
            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $qualification->where('bidang', $request->activity_type_id);
            }

            // if ($request->module_id && $request->module_id != "Lihat Semua") {
            //     $qualification->where('kategori', $request->module_id);
            // }

            return Datatables::of($qualification->get())
                ->editColumn('code', function ($qualification){
                    return $qualification->kod;
                })
                ->editColumn('name', function ($qualification) {
                    return $qualification->diskripsi;
                })
                ->editColumn('jenis', function ($qualification) {
                    return KodPelbagai::where('sah_yt', 'Y')
                    ->where('kategori', 'JENIS KELULUSAN')
                    ->where('kod', $qualification->jenis)
                    ->pluck('diskripsi')
                    ->first();
                })
                ->editColumn('kat', function ($qualification) {
                    return KodPelbagai::where('sah_yt', 'Y')
                    ->where('kategori', 'KATEGORI KELULUSAN')
                    ->where('kod', $qualification->kategori)
                    ->pluck('diskripsi')
                    ->first();
                })
                ->editColumn('action', function ($qualification) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="qualificationForm('.$qualification->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($qualification->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$qualification->id.'" onclick="toggleActive('.$qualification->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$qualification->id.'" onclick="toggleActive('.$qualification->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.qualification', compact('accessAdd', 'accessUpdate', 'accessDelete', 'jenis', 'bidang'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_kelulusan,kod',
                'name' => 'required|string',
                'type' => 'required|string',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama kelulusan',
                'type.required' => 'Sila isikan jenis kelulusan',
                'category.required' => 'Sila isikan kategori',
            ]);

            $qualification = Qualification::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->type),
                'kategori' => strtoupper($request->category),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.qualification')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kelulusan";
            $log->data_new = json_encode($qualification);
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

            $qualification = Qualification::find($request->qualificationId);

            if (!$qualification) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.qualification')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kelulusan";
            $log->data_new = json_encode($qualification);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $qualification]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $qualificationId = $request->qualificationId;
            $qualification = Qualification::find($qualificationId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.qualification')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kelulusan";
            $log->data_old = json_encode($qualification);

            $request->validate([
                'code' => 'required|string|unique:ruj_kelulusan,kod,'.$qualificationId,
                'name' => 'required|string',
                'type' => 'required|string',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama kelulusan',
                'type.required' => 'Sila isikan jenis kelulusan',
                'category.required' => 'Sila isikan kategori',
            ]);

            $qualification->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'jenis' => strtoupper($request->type),
                'kategori' => strtoupper($request->category),
                'pengguna' => auth()->user()->id,
            ]);

            $qualificationNewData = Qualification::find($qualificationId);
            $log->data_new = json_encode($qualificationNewData);
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

            $qualificationId = $request->qualificationId;
            $qualification = Qualification::find($qualificationId);

            $sah_yt = $qualification->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $qualification->update([
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
