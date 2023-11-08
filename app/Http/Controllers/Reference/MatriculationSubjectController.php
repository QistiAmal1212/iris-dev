<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\MatriculationSubject;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class MatriculationSubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.matriculation-subject')->first();
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

        $matriculationSubject = MatriculationSubject::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation-subject')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Subjek Matrikulasi";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($matriculationSubject)
                ->editColumn('code', function ($matriculationSubject){
                    return $matriculationSubject->kod;
                })
                ->editColumn('name', function ($matriculationSubject) {
                    return $matriculationSubject->diskripsi;
                })
                ->editColumn('credit', function ($matriculationSubject) {
                    return $matriculationSubject->kredit;
                })
                ->editColumn('semester', function ($matriculationSubject) {
                    return $matriculationSubject->semester;
                })
                ->editColumn('action', function ($matriculationSubject) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';

                    if($accessUpdate){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="matriculationSubjectForm('.$matriculationSubject->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($matriculationSubject->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$matriculationSubject->id.'" onclick="toggleActive('.$matriculationSubject->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$matriculationSubject->id.'" onclick="toggleActive('.$matriculationSubject->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }else{
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="matriculationSubjectForm('.$matriculationSubject->id.')"> <i class="fas fa-eye text-primary"></i> ';
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$matriculationSubject->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.matriculation_subject', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|max:15|unique:ruj_subjek_matrikulasi,kod',
                'name' => 'required|string|max:100',
                'credit' => 'required|numeric',
                'semester' => 'required|numeric',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama subjek matrikulasi',
                'credit.required' => 'Sila isikan kredit subjek matrikulasi',
                'credit.numeric' => 'Kredit hendaklah dalam angka digit',
                'semester.required' => 'Sila isikan semester subjek matrikulasi',
                'semester.numeric' => 'Semester hendaklah dalam angka digit',
                'category.required' => 'Sila isikan kategori subjek matrikulasi',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang subjek matrikulasi adalah :max karakter',
            ]);

            $subjek  = MatriculationSubject::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'kredit' => strtoupper($request->credit),
                'semester' => strtoupper($request->semester),
                'kategori' => strtoupper($request->category),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation-subject')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Subjek Matrikulasi";
            $log->data_new = json_encode($subjek);
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

            $matriculationSubject = MatriculationSubject::find($request->matriculationSubjectId);

            if (!$matriculationSubject) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation-subject')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Subjek Matrikulasi";
            $log->data_new = json_encode($matriculationSubject);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $matriculationSubject]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $matriculationSubjectId = $request->matriculationSubjectId;
            $matriculationSubject = MatriculationSubject::find($matriculationSubjectId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation-subject')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Subjek Matrikulasi";
            $log->data_old = json_encode($matriculationSubject);

            $request->validate([
                'code' => 'required|string|max:15|unique:ruj_subjek_matrikulasi,kod,'.$matriculationSubjectId,
                'name' => 'required|string|max:100',
                'credit' => 'required|numeric',
                'semester' => 'required|numeric',
                'category' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama subjek matrikulasi',
                'credit.required' => 'Sila isikan kredit subjek matrikulasi',
                'credit.numeric' => 'Kredit hendaklah dalam angka digit',
                'semester.required' => 'Sila isikan semester subjek matrikulasi',
                'semester.numeric' => 'Semester hendaklah dalam angka digit',
                'category.required' => 'Sila isikan kategori subjek matrikulasi',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang subjek matrikulasi adalah :max karakter',
            ]);

            $matriculationSubject->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'kredit' => strtoupper($request->credit),
                'semester' => strtoupper($request->semester),
                'kategori' => strtoupper($request->category),
                'pengguna' => auth()->user()->id,
            ]);

            $matriculationSubjectNewData = MatriculationSubject::find($matriculationSubjectId);
            $log->data_new = json_encode($matriculationSubjectNewData);
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

            $matriculationSubjectId = $request->matriculationSubjectId;
            $matriculationSubject = MatriculationSubject::find($matriculationSubjectId);

            $sah_yt = $matriculationSubject->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $matriculationSubject->update([
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
            $matriculationSubject = MatriculationSubject::find($request-> matriculationSubjectId);

            $matriculationSubject->delete();

            if (!$matriculationSubject) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation-subject')->firstOrFail()->id;
            $log->activity_type_id = 5;
            $log->description = "Hapus Subjek Matrikulasi";
            $log->data_new = json_encode($matriculationSubject);
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
