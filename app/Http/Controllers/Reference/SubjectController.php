<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Subject;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.subject')->first();
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
            $log->module_id = MasterModule::where('code', 'admin.reference.subject')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Matapelajaran";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $subject = Subject::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $subject->where('tkt', $request->activity_type_id);
            }

            return Datatables::of($subject->get())
                ->editColumn('code', function ($subject){
                    return $subject->kod;
                })
                ->editColumn('name', function ($subject) {
                    return $subject->diskripsi;
                })
                ->editColumn('form', function ($subject) {
                    return $subject->tkt;
                })
                ->editColumn('action', function ($subject) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="subjectForm('.$subject->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($subject->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$subject->id.'" onclick="toggleActive('.$subject->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$subject->id.'" onclick="toggleActive('.$subject->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.subject', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_matapelajaran,kod',
                'name' => 'required|string',
                'form' => 'required|numeric|min:1|max:6',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama subjek',
                'form.required' => 'Sila isikan tingkatan',
                'form.numeric' => 'Tingkatan hendaklah dalam angka digit',
                'form.min' => 'Tingkatan hendaklah antara 1 dan 6',
                'form.max' => 'Tingkatan hendaklah antara 1 dan 6',
            ]);

            $subject = Subject::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'tkt' => strtoupper($request->form),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.subject')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Matapelajaran";
            $log->data_new = json_encode($subject);
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

            $subject = Subject::find($request->subjectId);

            if (!$subject) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.subject')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Matapelajaran";
            $log->data_new = json_encode($subject);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $subject]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $subjectId = $request->subjectId;
            $subject = Subject::find($subjectId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.subject')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Matapelajaran";
            $log->data_old = json_encode($subject);

            $request->validate([
                'code' => 'required|string|unique:ruj_matapelajaran,kod,'.$subjectId,
                'name' => 'required|string',
                'form' => 'required|numeric|min:1|max:6',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama subjek',
                'form.required' => 'Sila isikan tingkatan',
                'form.numeric' => 'Tingkatan hendaklah dalam angka digit',
                'form.min' => 'Tingkatan hendaklah antara 1 dan 6',
                'form.max' => 'Tingkatan hendaklah antara 1 dan 6',
            ]);

            $subject->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'tkt' => strtoupper($request->form),
                'pengguna' => auth()->user()->id,
            ]);

            $subjectNewData = Subject::find($subjectId);
            $log->data_new = json_encode($subjectNewData);
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

            $subjectId = $request->subjectId;
            $subject = Subject::find($subjectId);

            $sah_yt = $subject->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $subject->update([
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
