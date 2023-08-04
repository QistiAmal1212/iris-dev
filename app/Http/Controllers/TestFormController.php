<?php

namespace App\Http\Controllers;

use App\Models\Reports\TestForm;
use App\Models\Reports\TestTable;
use DeveloperUnijaya\FlowManagementFunction\Facades\FMF;
use DeveloperUnijaya\LaravelUploadedFile\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TestFormController extends Controller
{
    private $module_id;
    private $module;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $testForm = TestForm::find($request->id ?? 1);

        return view('test_form.borang.index', ['testForm' => $testForm]);
    }

    function list(Request $request) {

        if ($request->ajax()) {

            $listOfTestForm = TestForm::orderBy('module_status_id');
            return Datatables::of($listOfTestForm)
                ->editColumn('module', function ($testForm) {
                    return $testForm->module->module_name;
                })
                ->editColumn('status', function ($testForm) {
                    return $testForm->moduleStatus->status_name;
                })
                ->editColumn('action', function ($testForm) {
                    $button = "";
                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    if (FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'View_Btn_Table')) {
                        $button .= '<a href="' . route('testForm.index', ['id' => $testForm->id]) . '" class="btn btn-xs btn-default" title=""> <i class="fas fa-eye text-primary"></i> </a>';
                    }

                    if (FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'Edit_Btn_Table')) {
                        $button .= '<a href="' . route('testForm.index', ['id' => $testForm->id]) . '" class="btn btn-xs btn-default" title=""> <i class="fas fa-pencil text-warning"></i> </a>';
                    }

                    if (FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'Delete_Btn_Table')) {
                        $button .= '<a href="' . route('testForm.index', ['id' => $testForm->id]) . '" class="btn btn-xs btn-default" title=""> <i class="fas fa-trash text-danger"></i> </a>';
                    }

                    $button .= "</div>";
                    // dd($button);

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('test_form.list');
    }

    /*
     * Parameter :
     * id : id of TestForm
     * action : string of action
     *
     */
    public function submit(Request $request)
    {

        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                // 'action' => 'required|string',
                // 'ic_number' => 'required|integer',
                // 'email' => 'required|email',
                // 'password' => 'required|string',
                // 'retype_password' => 'required|string',
                // 'role' => 'required',
            ]);

            $testForm = TestForm::find($request->id ?? 1);
            $nextStatus = FMF::getNextStatus($testForm->module_id, $testForm->module_status_id, 'submit');
            if (!$nextStatus) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Flow Management Error. Could not find next status"], 404);
            }

            $testForm->module_status_id = $nextStatus;
            $testForm->save();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    /*
     * Function for testing uploading type of files
     *
     **/
    public function submitTabASubA(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'example_upload_one_file' => ['max:3000', 'mimes:png,jpeg,jpg,webp'],
                'example_upload_multiple_file.*' => ['max:3000', 'mimes:png,jpeg,jpg,pdf,docx,webp'],
            ], [
                'example_upload_one_file.max' => "Fail mesti tidak melebihi 3MB",
                'example_upload_multiple_file.*.max' => "Fail mesti tidak melebihi 3MB",
                'example_upload_one_file.mimes' => "Fail mesti dalam format PNG",
                'example_upload_multiple_file.*.mimes' => "Fail mesti dalam format PNG, JPEG, JPG, PDF, DOCX, WEBP",
            ]);

            $testForm = TestForm::find($request->id ?? 1);

            //Contoh Upload File. Boleh copy dari sini
            //test Single Upload File
            if ($request->example_upload_one_file) {

                //This check if certain document already exists, deleted it.
                if ($testForm->uploadedFiles('example_upload_one_file')->count() >= 1) {
                    foreach ($testForm->uploadedFiles('example_upload_one_file')->get() as $goodbyefile) {
                        FileHelper::deleteFile($goodbyefile->path);
                        $goodbyefile->delete();
                    }
                }

                //single file upload, go see App\Helpers\Helpers.php to understand the parameter.
                $success = FileHelper::uploadFile($testForm, ['files' => $request->example_upload_one_file], "example_upload_one_file");
                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //end test Single Upload File\

            //test multiple Upload File
            if ($request->gambar_bapa) {

                //This check if certain document already exists, deleted it.
                if ($testForm->uploadedFiles('gambar_bapa')->count() >= 1) {
                    foreach ($testForm->uploadedFiles('gambar_bapa')->get() as $goodbyefile) {
                        FileHelper::deleteFile($goodbyefile->path);
                        $goodbyefile->delete();
                    }
                }

                //multiple file upload, go see App\Helpers\Helpers.php to understand the parameter.
                $success = FileHelper::uploadFile($testForm, $request->gambar_bapa, "gambar_bapa");
                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //end test multiple Upload File

            //test multiple Upload File without cleanup/delete existing file
            if ($request->example_upload_multiple_file) {

                //multiple file upload, go see App\Helpers\Helpers.php to understand the parameter.
                $success = FileHelper::uploadFile($testForm, $request->example_upload_multiple_file, "example_upload_multiple_file");
                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //end test multiple Upload File without cleanup/delete existing file
            //End Contoh Upload File. Boleh copy dari sini

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    /*
     * Function for testing CRUD of normal input
     *
     **/
    public function submitTabBSubB(Request $request)
    {

        //dd($request->all());
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'father_name' => 'required',
                'father_ic' => 'required',
                'father_address' => 'required',
                'father_status' => 'required',
                // 'father_birthdate' => 'required'
            ]);

            $testForm = TestForm::find($request->testform_id ?? 1);

            $testForm->father_name = $request->father_name;
            $testForm->father_ic = $request->father_ic;
            $testForm->father_address = $request->father_address;
            $testForm->father_status = $request->father_status;
            // $testForm->father_birthdate = $request->father_birthdate;

            $testForm->save();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    public function refreshFamilyTable(Request $request)
    {
        return view('test_form.borang.tab3.subATableFamily');
    }

    public function editFamilyModal(Request $request, $testTableId = null)
    {

        // dd($testTableId);
        $testTableFamily = null;
        if ($testTableId) {
            $testTableFamily = TestTable::find($testTableId);
        }

        return view('test_form.borang.tab3.editfamilyForm', compact('testTableFamily'));
    }

    /*
     * Function for update test table
     *
     **/
    public function createFamily(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ]);

            $testTable = new TestTable;

            $testTable->name = $request->name;
            $testTable->age = $request->age;
            $testTable->gender = $request->gender;

            $testTable->save();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    /*
     * Function for update test table
     *
     **/
    public function updateFamily(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'test_table_id' => 'required',
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ], [
                'test_table_id.required' => "Form is not valid. Please refresh the website",
            ]);

            $testTable = TestTable::findorFail($request->test_table_id);

            $testTable->name = $request->name;
            $testTable->age = $request->age;
            $testTable->gender = $request->gender;

            $testTable->save();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }
}
