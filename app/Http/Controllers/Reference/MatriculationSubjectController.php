<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
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

        $matriculationSubject = MatriculationSubject::orderBy('name', 'asc')->orderBy('code', 'asc')->get();
        if ($request->ajax()) {
            return Datatables::of($matriculationSubject)
                ->editColumn('code', function ($matriculationSubject){
                    return $matriculationSubject->code;
                })
                ->editColumn('name', function ($matriculationSubject) {
                    return $matriculationSubject->name;
                })
                ->editColumn('credit', function ($matriculationSubject) {
                    return $matriculationSubject->credit;
                })
                ->editColumn('semester', function ($matriculationSubject) {
                    return $matriculationSubject->semester;
                })
                ->editColumn('action', function ($matriculationSubject) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="matriculationSubjectForm('.$matriculationSubject->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($matriculationSubject->is_active) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$matriculationSubject->id.'" onclick="toggleActive('.$matriculationSubject->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$matriculationSubject->id.'" onclick="toggleActive('.$matriculationSubject->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
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
                'code' => 'required|string|unique:ruj_subjek_matrikulasi,code',
                'name' => 'required|string',
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
            ]);

            MatriculationSubject::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'credit' => strtoupper($request->credit),
                'semester' => strtoupper($request->semester),
                'category' => strtoupper($request->category),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

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

            $request->validate([
                'code' => 'required|string|unique:ruj_subjek_matrikulasi,code,'.$matriculationSubjectId,
                'name' => 'required|string',
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
            ]);

            $matriculationSubject->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'credit' => strtoupper($request->credit),
                'semester' => strtoupper($request->semester),
                'category' => strtoupper($request->category),
                'updated_by' => auth()->user()->id,
            ]);

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

            $is_active = $matriculationSubject->is_active;

            $matriculationSubject->update([
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
