<?php

namespace App\Http\Controllers;

use App\Http\Traits\HasUploadedFile;
use App\Models\Other\LaporanContoh;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanContohController extends Controller
{
    // use HasUploadedFile;

    public function viewList(Request $request)
    {
        return view('laporancontoh.list');
    }

    public function destroyBorang(Request $request, $id)
    {
        $LaporanContoh = LaporanContoh::find($id);
        $LaporanContoh->delete();
        session()->put('success', 'Successfully deleted Borang');
        return redirect(route('laporancontoh.list'));
    }
    //View Borang
    public function viewBorang(Request $request)
    {
        //Dummy Data Creation based on status
        $laporanContoh = null;
        $view = 0;
        if ($request->id) {
            $laporanContoh = collect(); //initialize as a collection
            if ($request->id == 1) { // 1: Status Semakan Pentadbir

                $laporanContoh->id = 1;
                $laporanContoh->status_id = 1;
                $laporanContoh->nama_syarikat = "BM30234";
                $laporanContoh->no_syarikat = "Komputerjet Sdn Bhd";
                $laporanContoh->alamat_1 = "	Jalan Seri Impian 1, Taman Seri Impian Emas 81300 Johor Bahru, Johor";
                $laporanContoh->alamat_2 = "	Jalan Seri Impian 1, Taman Seri Impian Emas 81300 Johor Bahru, Johor";
                $laporanContoh->no_fon = "0124587452";
                $laporanContoh->emel_syarikat = "cs_helpdesk@komputerjet.net";
                $laporanContoh->kuiri = "";

            } elseif ($request->id == 2) { // 2: Status Kuiri
                $laporanContoh->id = 2;
                $laporanContoh->status_id = 2;
                $laporanContoh->nama_syarikat = "AMC2342";
                $laporanContoh->no_syarikat = "Amc Aspire Sdn Bhd";
                $laporanContoh->alamat_1 = "	28-1 Jalan Tiara 2 Bandar Baru 41150 81300 Klang, Selangor";
                $laporanContoh->alamat_2 = "	28-1 Jalan Tiara 2 Bandar Baru 41150 81300 Klang, Selangor";
                $laporanContoh->no_fon = "0124587452";
                $laporanContoh->emel_syarikat = "cs_helpdesk@amcaspire.net";
                $laporanContoh->kuiri = "Sila muat turun dokumen yang betul";

            } else { // 3: Status Selesai
                $laporanContoh->id = 3;
                $laporanContoh->status_id = 3;
                $laporanContoh->nama_syarikat = "FL34222";
                $laporanContoh->no_syarikat = "Future Linear Sdn Bhd";
                $laporanContoh->alamat_1 = "18th Floor, Megan Phileo Avenue, 12 Jalan Yap Kwan Seng 50400 Kuala Lumpur";
                $laporanContoh->alamat_2 = "18th Floor, Megan Phileo Avenue, 12 Jalan Yap Kwan Seng 50400 Kuala Lumpur";
                $laporanContoh->no_fon = "0124587452";
                $laporanContoh->emel_syarikat = "cs_helpdesk@futurelinear.net";
                $laporanContoh->kuiri = "";
            }
        }

        //Borang nanti akan jadi either readonly atau boleh edit.
        if ($request->view == 1) {
            $view = 1;
        }
        return view('laporancontoh.borang.index', compact('laporanContoh', 'view'));
    }

    // Create Laporan Contoh Borang A
    public function createBorangA(Request $request)
    {

        $validatedData = $request->validate([
            'exampleInputFile' => ['max:3000'],
            'exampleInputFile2' => ['max:3000'],
            'exampleInputEmail1' => ['required'],
            'exampleInputPassword1' => ['required'],
        ], [
            'exampleInputFile.max' => "Fail Gambar Profile mesti tidak melebihi 3MB",
            'exampleInputFile2.max' => "Fail IC Dokumen mesti tidak melebihi 3MB",
        ]);

        $id = $request->laporanContohId ?? 0; //prevent search null
        if ($id == 0) {
            $laporanContoh = new LaporanContoh;
            $laporanContoh->save();
        } else {
            $laporanContoh = LaporanContoh::firstOrCreate(['id' => $id]);
        }

        //for text, insert into model as usual
        $laporanContoh->emel = $request->exampleInputEmail1;
        $laporanContoh->kata_laluan = $request->exampleInputPassword1;

        //for files, maybe need to cleanup before upload another one.
        //This check if certain document already exists, deleted it.
        if ($request->exampleInputFile) {
            if ($laporanContoh->uploadedFiles('gambar_profil')->count() >= 1) {
                foreach ($laporanContoh->uploadedFiles('gambar_profil')->get() as $goodbyefile) {
                    FileHelper::deleteFile($goodbyefile->path);
                    $goodbyefile->delete();
                }
            }

            //single file upload, go see App\Helpers.php to understand the parameter.
            $success = FileHelper::uploadFile("LaporanContoh", ['files' => $request->exampleInputFile], "gambar_profil", $laporanContoh->id);
            //error checker
            if ($success != "success") {
                abort(422);
            }
        }

        //Incase if the document is important, just delete the database, but not the file.
        //Maybe can recover in future if anything happens ;)
        if ($request->exampleInputFile2) {
            if ($laporanContoh->uploadedFiles('dokumen_ic')->count() >= 1) {
                foreach ($laporanContoh->uploadedFiles('dokumen_ic')->get() as $goodbyefile) {
                    $goodbyefile->delete();
                }
            }

            $success = FileHelper::uploadFile("LaporanContoh", ['files' => $request->exampleInputFile2], "dokumen_ic", $laporanContoh->id);
            if ($success != "success") {
                return back()->withErrors([
                    $request->exampleInputFile2 => "Size",
                ]);
            }
        }

        //multiple upload later
        // FileHelper::uploadFile("App\Models\LaporanContoh", $request->exampleInputFile, "gambar_profil", $laporan->id);

        $laporanContoh->save();

        return response()->json(['test' => 'Berjaya', 'status' => 'success', 'borangId' => $laporanContoh->id]);
    }

    // Create Laporan Contoh Borang B
    public function createBorangB(Request $request)
    {

        $dateFormat = 'd/m/Y';
        $validatedData = $request->validate([
            'projectName' => ['required'],
            'projectStatus' => ['required'],
            'icNumber' => ['required'],
            'leaderName' => ['required'],
            'projectDesc' => ['required'],
            'tarikh_mula_projek' => ['required', 'date_format:' . $dateFormat],
            'tarikh_akhir_projek' => ['date_format:' . $dateFormat, 'after:' . Carbon::createFromFormat('d/m/Y', $request->tarikh_mula_projek)],
            //this is how you compare date with another date
            //due to different format of datepicker and function inside laravel, need to convert (createFromFormat) first.
        ], [
            'tarikh_akhir_projek.after' => "Tarikh Jangkaan Akhir Projek mesti melebihi Tarikh Mula Projek",
        ]);

        $id = $request->laporanContohId ?? 0; //prevent search null
        //create or find Laporan Contoh
        if ($id == 0) {
            $laporanContoh = new LaporanContoh;
            $laporanContoh->save();
        } else {
            $laporanContoh = LaporanContoh::firstOrCreate(['id' => $id]);
        }

        //for text, insert into model as usual
        $laporanContoh->nama_projek = $request->projectName;
        $laporanContoh->status_projek = $request->projectStatus;
        $laporanContoh->ic_pengerusi = $request->icNumber;
        $laporanContoh->nama_pengerusi = $request->leaderName;
        $laporanContoh->catatan = $request->projectDesc;
        $laporanContoh->tarikh_mula_projek = Carbon::createFromFormat('d/m/Y', $request->tarikh_mula_projek); //need to save date like this to make it compatible with database
        $laporanContoh->tarikh_akhir_projek = Carbon::createFromFormat('d/m/Y', $request->tarikh_akhir_projek);

        $laporanContoh->save();

        return response()->json(['test' => 'Berjaya', 'status' => 'success', 'borangId' => $laporanContoh->id]);
    }

    //Kuiri
    public function createOrUpdateKuiri(Request $request)
    {

        $validatedData = $request->validate([
            'kuiri' => ['required'],
        ]);

        $id = $request->laporanContohId ?? 0; //prevent search null
        //create or find Laporan Contoh
        if ($id == 0) {
            $laporanContoh = new LaporanContoh;
            $laporanContoh->save();
        } else {
            $laporanContoh = LaporanContoh::firstOrCreate(['id' => $id]);
        }

        //for text, insert into model as usual
        $laporanContoh->kuiri = $request->kuiri;

        $laporanContoh->save();

        return response()->json(['test' => 'Berjaya', 'status' => 'success', 'borangId' => $laporanContoh->id]);
    }

    public function listTableMuatTurun(Request $request)
    {

        $lampiran = null;
        $laporanContoh = LaporanContoh::where('id', $request->id)->first();
        if ($laporanContoh) {
            if ($laporanContoh->uploadedFiles('lampiran')->count() > 0) {
                $lampiran = $laporanContoh->uploadedFiles('lampiran')->get();
            }

        }
        return view('laporancontoh.tableMuatTurun', compact('lampiran'));
    }

    public function uploadFileMuatTurun(Request $request)
    {

        $validatedData = $request->validate([
            'files' => ['required', 'array'],
            'files.*' => ['mimes:pdf,docx'],
        ]);
        $id = $request->laporanContohId ?? 0; //prevent search null
        //create or find Laporan Contoh
        if ($id == 0) {
            $laporanContoh = new LaporanContoh;
            $laporanContoh->save();
        } else {
            $laporanContoh = LaporanContoh::firstOrCreate(['id' => $id]);
        }

        //Multiple files
        if ($request->TotalFiles > 0) {

            $success = FileHelper::uploadFile("LaporanContoh", $request->file('files'), "lampiran", $laporanContoh->id);
            if ($success != "success") {
                return back()->withErrors([
                    $request->exampleInputFile2 => "Size",
                ]);
            }
        }
        return response()->json(['success' => 'success']);
    }

    public function deleteMuatTurun(Request $request)
    {

        $file = UploadedFile::find($request->id);
        $file->delete();
        session()->put('success', 'Successfully deleted Borang');
        return response()->json(['success' => 'success']);
    }
}
