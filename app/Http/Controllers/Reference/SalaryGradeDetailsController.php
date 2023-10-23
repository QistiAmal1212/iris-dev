<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\SalaryGradeDetails;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;
use App\Models\Reference\SalaryGrade;

class salaryGradeDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.salary-grade-details')->first();
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

        $salaryGrade = SalaryGrade::where('sah_yt', 'Y')->get();
        $ranks = SalaryGradeDetails::select('peringkat')->orderBy('peringkat', 'asc')->distinct()->pluck('peringkat')->filter()->toArray();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.salary-grade-details')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Butiran Gred Gaji";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $salaryGradeDetails = SalaryGradeDetails::orderBy('ggh_kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $salaryGradeDetails->where('ggh_kod', $request->activity_type_id);
            }

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $salaryGradeDetails->where('peringkat', $request->module_id);
            }

            return Datatables::of($salaryGradeDetails->get())
                ->editColumn('ref_salary_grade_code', function ($salaryGradeDetails){
                    return $salaryGradeDetails->ggh_kod;
                })
                ->editColumn('level', function ($salaryGradeDetails) {
                    return $salaryGradeDetails->peringkat;
                })
                ->editColumn('year', function ($salaryGradeDetails){
                    return $salaryGradeDetails->tahun;
                })
                ->editColumn('amount', function ($salaryGradeDetails) {
                    return $salaryGradeDetails->amaun;
                })
                ->editColumn('action', function ($salaryGradeDetails) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="salaryGradeDetailsForm('.$salaryGradeDetails->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($salaryGradeDetails->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$salaryGradeDetails->id.'" onclick="toggleActive('.$salaryGradeDetails->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$salaryGradeDetails->id.'" onclick="toggleActive('.$salaryGradeDetails->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //pass
        return view('admin.reference.salary_grade_details', compact('accessAdd', 'accessUpdate', 'accessDelete', 'salaryGrade', 'ranks'));
    }

    public function getCategoriesByParent(Request $request)
    {
        $parentCategory = $request->input('parent_category');

        $categories = SalaryGradeDetails::where('ggh_kod', $parentCategory)
            ->select('peringkat')
            ->distinct()
            ->pluck('peringkat')
            ->filter()
            ->toArray();

        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kod' => 'required|string',
                'level' => 'required|string',
                'year' => 'required|string',
                'amount' => 'required|string',
            ],[
                'kod.required' => 'Sila isikan kod',
                'level.required' => 'Sila isikan tahap gred gaji',
                'year.required' => 'Sila isikan tahun',
                'amount.required' => 'Sila isikan jumlah',
            ]);

            $ggd = SalaryGradeDetails::create([
                'ggh_kod' => $request->kod,
                'peringkat' => strtoupper($request->level),
                'tahun' => strtoupper($request->year),
                'amaun' => strtoupper($request->amount),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.salary-grade-details')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Butiran Gred Gaji";
            $log->data_new = json_encode($ggd);
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

            $salaryGradeDetails = SalaryGradeDetails::find($request->salaryGradeDetailsId);

            if (!$salaryGradeDetails) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.salary-grade-details')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Butiran Gred Gaji";
            $log->data_new = json_encode($salaryGradeDetails);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $salaryGradeDetails]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $salaryGradeDetailsId = $request->salaryGradeDetailsId;
            $salaryGradeDetails = SalaryGradeDetails::find($salaryGradeDetailsId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.salary-grade-details')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Butiran Gred Gaji";
            $log->data_old = json_encode($salaryGradeDetails);

            $request->validate([
                'kod' => 'required|string',
                'level' => 'required|string',
                'year' => 'required|string',
                'amount' => 'required|string',
            ],[
                'kod.required' => 'Sila isikan kod',
                'level.required' => 'Sila isikan tahap gred gaji',
                'year.required' => 'Sila isikan tahun',
                'amount.required' => 'Sila isikan jumlah',
            ]);

            $salaryGradeDetails->update([
                'ggh_kod' => $request->kod,
                'peringkat' => strtoupper($request->level),
                'tahun' => strtoupper($request->year),
                'amaun' => strtoupper($request->amount),
                'pengguna' => auth()->user()->id,
            ]);

            $salaryGradeDetailsNewData = SalaryGradeDetails::find($salaryGradeDetailsId);
            $log->data_new = json_encode($salaryGradeDetailsNewData);
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

            $salaryGradeDetailsId = $request->salaryGradeDetailsId;
            $salaryGradeDetails = SalaryGradeDetails::find($salaryGradeDetailsId);

            $sah_yt = $salaryGradeDetails->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $salaryGradeDetails->update([
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
            $salaryGradeDetails = SalaryGradeDetails::find($request-> salaryGradeDetailsId);

            $salaryGradeDetails->delete();

            if (!$salaryGradeDetails) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            DB::commit();
            return response()->json(['message' => 'Rekod berjaya dihapuskan'], 200);

        }catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
