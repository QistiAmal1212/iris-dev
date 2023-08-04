<?php

namespace App\Http\Controllers;

use App\Models\Reports\TestFormNoFMF;
use App\Models\Reports\TestFormNoFMFFamily;
use DeveloperUnijaya\LaravelUploadedFile\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TestFormNoFMFController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listTestForm(Request $request)
    {
        if ($request->ajax()) {

            $listOfTestForm = TestFormNoFMF::orderBy('id', 'asc');
            return Datatables::of($listOfTestForm)
                ->editColumn('nama_pengguna', function ($testForm) {
                    return $testForm->user_full_name;
                })
                ->editColumn('no_ic_pengguna', function ($testForm) {
                    return $testForm->user_ic;
                })
                ->editColumn('action', function ($testForm) {
                    $button = "";
                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // view button
                    // $button .= '<a href="'.route('testFormNoFMF.viewForm',['testFormId'=>$testForm->id]).'" class="btn btn-xs btn-default" title=""> <i class="fas fa-eye text-primary"></i> </a>';

                    //edit button
                    $button .= '<a href="' . route('testFormNoFMF.viewForm', ['testFormId' => $testForm->id]) . '" class="btn btn-xs btn-default" title=""> <i class="fas fa-pencil text-warning"></i> </a>';

                    //delete button
                    $button .= '<a class="btn btn-xs btn-default" title="" onclick="$(`#testFormDeleteButton_' . $testForm->id . '`).trigger(`click`);" > <i class="fas fa-trash text-danger"></i> </a>';
                    $button .= "</div>";

                    //delete form
                    $button .= '<form action="' . route('testFormNoFMF.deleteForm', ['testFormId' => $testForm->id]) . '" method="post" data-reloadPage="true">';
                    $button .= '<button id="testFormDeleteButton_' . $testForm->id . '" type="button" hidden onclick="confirmBeforeSubmit(this)"></button>';
                    $button .= '</form>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('test_form_no_fmf.list');
    }

    public function createForm(Request $request)
    {

        $testForm = new TestFormNoFMF;
        $testForm->save();

        return to_route('testFormNoFMF.viewForm', ['testFormId' => $testForm->id]);
        //to_route meeaning it will redirect to another route
    }

    public function viewForm(Request $request, $testFormId)
    {

        $testForm = TestFormNoFMF::findOrFail($testFormId);
        $allTestFamily = TestFormNoFMFFamily::where('test_form_no_fmf_id', $testFormId)->get();

        return view('test_form_no_fmf.borang.index', compact('testForm', 'allTestFamily'));
        //view meaning it will show the page (blade file)
    }

    public function deleteForm(Request $request, $testFormId)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {

            $testForm = TestFormNoFMF::find($testFormId);
            if (!$testForm) {
                throw new \Exception('Form Not Found');
            }

            $testForm->delete();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    /*
     * Function for refreshing view of certain page
     *
     */
    public function viewSectionASubB($testFormId)
    {

        $testForm = TestFormNoFMF::findOrFail($testFormId);

        return view('test_form_no_fmf.borang.sectionA.formSubB', compact('testForm'));
    }

    public function viewSectionASubC($testFormId)
    {

        $testForm = TestFormNoFMF::findOrFail($testFormId);

        return view('test_form_no_fmf.borang.sectionA.formSubC', compact('testForm'));
    }

    /*
     * Function for testing CRUD of normal input
     *
     */
    public function submitSectionASubA(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'user_full_name' => 'required',
                'user_ic' => 'required',
                'user_address' => 'required',
                'user_birth_date' => 'required',
                'user_gender' => 'required',
            ]);

            $testForm = TestFormNoFMF::find($request->test_form_id);
            if (!$testForm) {
                throw new \Exception('Form Not Found');
            }

            $testForm->user_full_name = $request->user_full_name; //string
            $testForm->user_ic = $request->user_ic; //string
            $testForm->user_address = $request->user_address; //textarea
            $testForm->user_birth_date = $request->user_birth_date; //date - no extra code because already follow sql date format
            $testForm->user_gender = $request->user_gender; //select option
            $testForm->user_is_married = $request->has('user_is_married') ? true : false; //switch or checkbox
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
     */
    public function submitSectionASubB(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();
        try {

            $validatedData = $request->validate([
                'example_upload_one_file' => ['max:3000', 'mimes:png,jpeg,jpg,pdf,docx,webp'],
                'example_upload_one_file_dropify' => ['max:3000', 'mimes:png,jpeg,jpg,webp'],
                'example_upload_multiple_file.*' => ['max:3000', 'mimes:png,jpeg,jpg,pdf,docx,webp'],
                'example_upload_multiple_file_but_delete_previous.*' => ['max:3000', 'mimes:png,jpeg,jpg,pdf,docx,webp'],
            ], [
                'example_upload_one_file.max' => "Fail mesti tidak melebihi 3MB",
                'example_upload_one_file_dropify.max' => "Fail mesti tidak melebihi 3MB",
                'example_upload_multiple_file.*.max' => "Fail mesti tidak melebihi 3MB",
                'example_upload_multiple_file_but_delete_previous.*.max' => "Fail mesti tidak melebihi 3MB",

                'example_upload_one_file.mimes' => "Fail mesti dalam format PNG, JPEG, JPG, PDF, DOCX, WEBP",
                'example_upload_one_file_dropify.mimes' => "Fail mesti dalam format PNG",
                'example_upload_multiple_file.*.mimes' => "Fail mesti dalam format PNG, JPEG, JPG, PDF, DOCX, WEBP",
                'example_upload_multiple_file_but_delete_previous.*.mimes' => "Fail mesti dalam format PNG, JPEG, JPG, PDF, DOCX, WEBP",
            ]);

            $testForm = TestFormNoFMF::find($request->test_form_id);
            if (!$testForm) {
                throw new \Exception('Form Not Found');
            }

            //Contoh Upload File. Boleh copy jenis upload mana yang nak digunakan

            //Cara Upload One Single File/Document
            if ($request->example_upload_one_file_dropify) {

                //This check if certain document already exists, deleted it.
                if ($testForm->uploadedFiles('example_upload_one_file_dropify')->count() >= 1) {
                    foreach ($testForm->uploadedFiles('example_upload_one_file_dropify')->get() as $goodbyefile) {
                        FileHelper::deleteFile($goodbyefile->path);
                        $goodbyefile->delete();
                    }
                }

                //Go see vendor\developer-unijaya\laravel-uploaded-file\src\FileHelper.php to understand the parameter.
                //Single file upload
                $success = FileHelper::uploadFile($testForm, ['files' => $request->example_upload_one_file_dropify], "example_upload_one_file_dropify");

                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //END Cara Upload One Single File/Document

            //Cara Upload Multiple File/Document
            if ($request->example_upload_multiple_file_but_delete_previous) {

                //This check if certain document already exists, deleted it.
                if ($testForm->uploadedFiles('example_upload_multiple_file_but_delete_previous')->count() >= 1) {
                    foreach ($testForm->uploadedFiles('example_upload_multiple_file_but_delete_previous')->get() as $goodbyefile) {
                        FileHelper::deleteFile($goodbyefile->path);
                        $goodbyefile->delete();
                    }
                }

                //Multiple file upload
                $success = FileHelper::uploadFile($testForm, $request->example_upload_multiple_file_but_delete_previous, "example_upload_multiple_file_but_delete_previous");

                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //END Cara Upload Multiple File/Document

            //Cara Upload Multiple File/Document Without Deleting Previous Upload
            if ($request->example_upload_multiple_file) {

                //Multiple file upload
                $success = FileHelper::uploadFile($testForm, $request->example_upload_multiple_file, "example_upload_multiple_file");

                //error checker
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }
            //Cara Upload Multiple File/Document Without Deleting Previous Upload

            //End Contoh Upload File. Boleh copy jenis upload mana yang nak digunakan

            if ($request->example_upload_one_file) {
                if ($testForm->uploadedFiles('example_upload_one_file')->count() >= 1) {
                    foreach ($testForm->uploadedFiles('example_upload_one_file')->get() as $goodbyefile) {
                        FileHelper::deleteFile($goodbyefile->path);
                        $goodbyefile->delete();
                    }
                }
                $success = FileHelper::uploadFile($testForm, ['files' => $request->example_upload_one_file], "example_upload_one_file");
                if ($success != "success") {
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $success], 422);
                }
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    public function autosaveSectionASubC(Request $request, TestFormNoFMF $testForm)
    {

        //dd($request->all());
        \DB::beginTransaction();
        try {
            $validator = $request->validate([
                'user_full_name' => ['nullable', 'min:1'],
                'user_ic' => ['nullable', 'min_digits:12', 'max_digits:12'],
                'user_address' => ['nullable'],
                'user_birth_date' => ['nullable', 'date_format:Y-m-d'],
                'user_gender' => ['nullable'],

            ], [
                'user_full_name.min' => "Full Name is required",
                'user_ic.min_digits' => "IC Number required 12 digits",
                'user_ic.max_digits' => "IC Number required 12 digits",
                'user_address.min' => "Address is required",
                'user_address.date_format' => "Date Format is wrong",
                'user_gender.required' => "Gender is required",
            ]);

            $testForm->update($validator);

        } catch (\Throwable $e) {

            \DB::rollBack();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        \DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

    }

    public function checkSectionASubC(Request $request, TestFormNoFMF $testForm)
    {

        if ($testForm->isSectionASubCCompleted()) {
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
        } else {
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => __('msg.form.allrequired')], 404);
        }

    }

    public function refreshFamilyTable(Request $request, $testFormId = null)
    {

        $testForm = TestFormNoFMF::findOrFail($testFormId);
        $allTestFamily = TestFormNoFMFFamily::where('test_form_no_fmf_id', $testFormId)->get();

        return view('test_form_no_fmf.borang.sectionB.subATableFamily', compact('testForm', 'allTestFamily'));
    }

    public function openFamilyFormModal(Request $request, $testFormId = null, $testFamilyId = null)
    {

        $testForm = TestFormNoFMF::findOrFail($testFormId);
        $testFamily = TestFormNoFMFFamily::find($testFamilyId);

        return view('test_form_no_fmf.borang.sectionB.modalFamilyForm', compact('testForm', 'testFamily'));
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
                'test_form_no_fmf_id' => 'required',
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ], [
                'test_form_no_fmf_id.required' => "Form is not valid. Please refresh the website",
            ]);

            $testFamily = new TestFormNoFMFFamily();

            $testFamily->test_form_no_fmf_id = $request->test_form_no_fmf_id;
            $testFamily->name = $request->name;
            $testFamily->age = $request->age;
            $testFamily->gender = $request->gender;

            $testFamily->save();

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
                'test_form_no_fmf_id' => 'required',
                'test_form_no_fmf_family_id' => 'required',
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
            ], [
                'test_form_no_fmf_id.required' => "Form is not valid. Please refresh the website",
                'test_form_no_fmf_family_id.required' => "Form is not valid. Please refresh the website",
            ]);

            $testFamily = TestFormNoFMFFamily::where('test_form_no_fmf_id', $request->test_form_no_fmf_id)
                ->where('id', $request->test_form_no_fmf_family_id)->first();
            if (!$testFamily) {
                throw new \Exception('Form Not Found');
            }

            $testFamily->name = $request->name;
            $testFamily->age = $request->age;
            $testFamily->gender = $request->gender;

            $testFamily->save();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }
}
