<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KodPelbagai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;
use App\Models\Reference\JenisOkuJKM;

class JenisOkuJKMController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.jenisoku')->first();
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

        $KategoriOKU = KodPelbagai::where('kategori', 'KECACATAN CALON')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();


        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.jenisoku')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Jenis OKU JKM";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $jenisoku = JenisOkuJKM::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $jenisoku->where('nama', $request->activity_type_id);
            }

            return Datatables::of($jenisoku->get())
                ->editColumn('kod', function ($jenisoku){
                    return $jenisoku->kod;
                })
                ->editColumn('nama', function ($jenisoku) {
                    return $jenisoku->nama;
                })
                ->editColumn('sub', function ($jenisoku) {
                    if($jenisoku->sub_oku) return $jenisoku->sub_oku;
                    else return "-";
                })
                ->editColumn('action', function ($jenisoku) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="jenisokuForm('.$jenisoku->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($jenisoku->sah_yt=="Y") {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$jenisoku->id.'" onclick="toggleActive('.$jenisoku->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$jenisoku->id.'" onclick="toggleActive('.$jenisoku->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.jenisoku', compact('accessAdd', 'accessUpdate', 'accessDelete', 'KategoriOKU'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_jenis_oku_jkm,kod',
                'name' => 'required|string',
                'sub' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan jenis oku',
                'sub.required' => 'Sila isikan sub oku',
            ]);

            $jenisoku = JenisOkuJKM::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'sub_oku' => strtoupper($request->sub),
                'sah_yt' => "Y",
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.jenisoku')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Jenis OKU JKM";
            $log->data_new = json_encode($jenisoku);
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

            $jenisoku = JenisOkuJKM::find($request->jenisokuId);

            if (!$jenisoku) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.jenisoku')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Jenis OKU JKM";
            $log->data_new = json_encode($jenisoku);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $jenisoku]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $jenisokuId = $request->jenisokuId;
            $jenisoku = JenisOkuJKM::find($jenisokuId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.jenisoku')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Jenis OKU JKM";
            $log->data_old = json_encode($jenisoku);

            $request->validate([
                'code' => 'required|string|unique:ruj_jenis_oku_jkm,kod,'.$jenisokuId,
                'name' => 'required|string',
                'sub' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan jenis oku',
                'sub.required' => 'Sila isikan sub oku',
            ]);

            $jenisoku->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'sub_oku' => strtoupper($request->sub),
                'updated_by' => auth()->user()->id,
            ]);

            $jenisokuNewData = JenisOkuJKM::find($jenisokuId);
            $log->data_new = json_encode($jenisokuNewData);
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

            $jenisokuId = $request->jenisokuId;
            $jenisoku = JenisOkuJKM::find($jenisokuId);

            $sah_yt = $jenisoku->sah_yt;

            if($sah_yt == "Y"){
                $sah_yt = "T";
            }else{
                $sah_yt = "Y";
            }

            $jenisoku->update([
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
