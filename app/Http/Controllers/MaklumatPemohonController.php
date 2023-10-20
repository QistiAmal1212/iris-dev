<?php

namespace App\Http\Controllers;

use App\Models\Calon\CalonBahasa;
use App\Models\Calon\CalonLesen;
use App\Models\Calon\CalonMatrikulasi;
use App\Models\Calon\CalonOku;
use App\Models\Calon\CalonPsl;
use App\Models\Reference\KodPelbagai;
use App\Models\Reference\Language;
use App\Models\Reference\MatriculationSubject;
use App\Models\Reference\Qualification;
use App\Models\Reference\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\DepartmentMinistry;
use App\Models\Reference\Eligibility;
use App\Models\Reference\Gender;
use App\Models\Reference\GredMatapelajaran;
use App\Models\Reference\Institution;
use App\Models\Reference\InterviewCentre;
use App\Models\Reference\JenisBekasTenteraPolis;
use App\Models\Reference\JenisPerkhidmatan;
use App\Models\Reference\KumpulanSSM;
use App\Models\Reference\MaritalStatus;
use App\Models\Reference\Penalty;
use App\Models\Reference\PeringkatPengajian;
use App\Models\Reference\PositionLevel;
use App\Models\Reference\Rank;
use App\Models\Reference\Race;
use App\Models\Reference\Religion;
use App\Models\Reference\SalaryGrade;
use App\Models\Reference\State;
use App\Models\Reference\Skim;
use App\Models\Reference\Subject;
use App\Models\Reference\Specialization;
use App\Models\Calon\Calon;
use App\Models\Calon\CalonTenteraPolis;
use App\Models\Calon\CalonPengalaman;
use App\Models\Calon\CalonPengajianTinggi;
use App\Models\Calon\CalonTatatertib;
use App\Models\Calon\CalonKeputusanSekolah;
use App\Models\Calon\CalonSkm;
use App\Models\Calon\CalonBakat;
use App\Models\Calon\CalonGarisMasa;
use App\Models\Calon\CalonSvm;
use App\Models\Calon\CalonProfesional;
use App\Models\Reference\Matriculation;
use App\Models\Reference\MatriculationCourse;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class MaklumatPemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchPemohon ()
    {
        $departmentMinistries = DepartmentMinistry::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $eligibilities = Eligibility::where('sah_yt', 'Y')->get();
        $genders = Gender::all();
        $gredPmr = GredMatapelajaran::where('tkt', 3)->orderBy('susunan', 'asc')->get();
        $gredSpm = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredSpmv = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredSvm = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredStpm = GredMatapelajaran::where('tkt', 6)->orderBy('susunan', 'asc')->get();
        $gredStam = GredMatapelajaran::where('tkt', 6)->orderBy('susunan', 'asc')->get();
        $institutions = Institution::where('sah_yt', 'Y')->orderBy('jenis_institusi', 'asc')->orderBy('diskripsi', 'asc')->get();
        $jenisBekasTenteraPolis = JenisBekasTenteraPolis::where('sah_yt', 'Y')->get();
        $jenisPerkhidmatan = JenisPerkhidmatan::all();
        $maritalStatuses = MaritalStatus::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $penalties = Penalty::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $peringkatPengajian = PeringkatPengajian::all();
        $positionLevels = PositionLevel::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $races = Race::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $pusatTemuduga = InterviewCentre::where('sah_yt', 'Y')->get();
        $ranks = Rank::where('sah_yt', 'Y')->get();
        $religions = Religion::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $states = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $skims = Skim::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $specializations = Specialization::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $subjekPmr = Subject::where('sah_yt', 'Y')->where('tkt', 3)->orderBy('diskripsi', 'asc')->get();
        $subjekSpm = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekSpmv = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekSvm = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekStpm = Subject::where('sah_yt', 'Y')->where('tkt', 6)->orderBy('diskripsi', 'asc')->get();
        $subjekStam = Subject::where('sah_yt', 'Y')->where('tkt', 6)->orderBy('diskripsi', 'asc')->get();
        $skmkod = Qualification::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $talentkod = Talent::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kolejMatrikulasi = Matriculation::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $jurusanMatrikulasi = MatriculationCourse::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $subjekMatrikulasi =  MatriculationSubject::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kategoriOKU = KodPelbagai::where('kategori', 'KECACATAN CALON')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $Bahasa = Language::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kategoriPenguasaan = KodPelbagai::where('kategori', 'PENGUASAAN BAHASA')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $jenisPeperiksaan = Qualification::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $sektorPekerjaan = KodPelbagai::where('kategori', 'JENIS PERKHIDMATAN')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $gredJawatan = SalaryGrade::where('sah_yt', 'Y')->orderBy('kod', 'asc')->get();
        $kumpulanPerkhidmatan = KumpulanSSM::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        return view('maklumat_pemohon.carian_pemohon', compact('departmentMinistries', 'eligibilities', 'genders', 'gredPmr', 'institutions', 'jenisBekasTenteraPolis', 'jenisPerkhidmatan', 'maritalStatuses', 'penalties', 'peringkatPengajian', 'positionLevels', 'pusatTemuduga', 'races', 'ranks', 'religions', 'states', 'skims', 'specializations', 'subjekPmr', 'skmkod', 'talentkod', 'gredSpm', 'subjekSpm', 'gredSpmv', 'subjekSpmv', 'gredSvm', 'subjekSvm', 'gredStpm', 'subjekStpm', 'gredStam', 'subjekStam', 'kolejMatrikulasi', 'jurusanMatrikulasi', 'subjekMatrikulasi', 'kategoriOKU', 'Bahasa', 'kategoriPenguasaan', 'jenisPeperiksaan', 'sektorPekerjaan', 'gredJawatan', 'kumpulanPerkhidmatan'));
    }

    public function viewMaklumatPemohon(){
        return view('maklumat_pemohon.index_pemohon');
    }

    public function listCarian(Request $request){
        $nama = $request->search_nama;
        if (!isset($request->page)) {
            $count = DB::select("SELECT count(*) FROM calon WHERE nama_penuh ilike ? and no_kp_baru is not null", ['%'.$nama.'%']);
            $total_pages = $count[0]->count/10;
            $total_pages = round($total_pages);
        } else {
            $total_pages = $request->total_pages;
        }


        $offset = $request->input('page', 1)*10 - 10;
        $currentPage = $request->input('page', 1);
        $previousPage = $currentPage-1;
        $nextPage = $currentPage+1;
        $sql = "SELECT no_kp_baru, nama_penuh, no_kp_lama FROM calon WHERE nama_penuh ilike ? and no_kp_baru is not null OFFSET ? LIMIT ?";
         
        $candidate = DB::select($sql, ['%' . $nama . '%', $offset, 10]);

        return view('maklumat_pemohon.list', compact('total_pages', 'candidate', 'previousPage', 'nextPage', 'currentPage'));
    }

    public function getCandidateDetails(Request $request)
    {
        $no_ic = $request->no_ic;

        DB::beginTransaction();
        try {

            $candidate = Calon::where(function ($query) use ($no_ic) {
                $query->where('no_kp_baru', $no_ic)->orWhere('no_kp_lama', $no_ic);
            })
            ->with([
                'license',
                'oku',
                'skim' => function ($query) {
                    $query->where([
                        ['sah_yt', '=', 'Y']
                    ]);
                    $query->with(['skim']);
                },
                'interviewCentre',
                'matriculation' => function ($query) {
                    $query->with(['course', 'college', 'subject']);
                },
                'skm' => function ($query) {
                    $query->with(['qualification']);
                },
                'diploma',
                'degree',
                'master',
                'phd',
                'experience',
                'psl' => function ($query) {
                    $query->with(['qualification']);
                },
                'armyPolice' => function ($query) {
                    $query->with(['rank']);
                },
                'language' => function ($query) {
                    $query->with(['language', 'kategori']);
                },
                'talent' => function ($query) {
                    $query->with(['talent']);
                },
                'penalty' => function ($query) {
                    $query->with(['penalty']);
                },
                'timeline',
            ])->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            $candidate->tarikh_lahir = ($candidate->tarikh_lahir != null) ? Carbon::parse($candidate->tarikh_lahir)->format('d/m/Y') : null;

            if($candidate->license){
                //$candidate->license->tempoh_tamat = ($candidate->license->tempoh_tamat != null) ? Carbon::parse($candidate->license->tempoh_tamat)->format('d/m/Y') : null;
            }

            $candidate->skim->transform(function ($skim) {
                $skim->tarikhCipta = ($skim->tarikh_cipta != null) ? $skim->tarikh_cipta->format('d/m/Y') : null;
                $skim->tarikh_daftar = ($skim->tarikh_daftar != null) ? Carbon::parse($skim->tarikh_daftar)->format('d/m/Y') : null;
                $skim->tarikh_luput = ($skim->tarikh_luput != null) ? Carbon::parse($skim->tarikh_luput)->format('d/m/Y') : null;

                return $skim;
            });

            if($candidate->diploma) {
                $candidate->diploma->tarikh_senat = ($candidate->diploma->tarikh_senat != null) ? Carbon::parse($candidate->diploma->tarikh_senat)->format('d/m/Y') : null;
            }

            if($candidate->degree) {
                $candidate->degree->tarikh_senat = ($candidate->degree->tarikh_senat != null) ? Carbon::parse($candidate->degree->tarikh_senat)->format('d/m/Y') : null;
            }

            if($candidate->master) {
                $candidate->master->tarikh_senat = ($candidate->master->tarikh_senat != null) ? Carbon::parse($candidate->master->tarikh_senat)->format('d/m/Y') : null;
            }

            if($candidate->phd) {
                $candidate->phd->tarikh_senat = ($candidate->phd->tarikh_senat != null) ? Carbon::parse($candidate->phd->tarikh_senat)->format('d/m/Y') : null;
            }

            if($candidate->experience){

                $candidate->experience->tarikh_lantik1 = ($candidate->experience->tarikh_lantik1 != null) ? Carbon::parse($candidate->experience->tarikh_lantik1)->format('d/m/Y') : null;
                $candidate->experience->tarikh_mula = ($candidate->experience->tarikh_mula != null) ? Carbon::parse($candidate->experience->tarikh_mula)->format('d/m/Y') : null;
                $candidate->experience->tarikh_disahkan = ($candidate->experience->tarikh_disahkan != null) ? Carbon::parse($candidate->experience->tarikh_disahkan)->format('d/m/Y') : null;
                $candidate->experience->tarikh_tamat = ($candidate->experience->tarikh_tamat != null) ? Carbon::parse($candidate->experience->tarikh_tamat)->format('d/m/Y') : null;

            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function listTimeline(Request $request)
    {
        $candidateTimeline = CalonGarisMasa::where('no_pengenalan', $request->noPengenalan)->orderBy('created_at', 'desc')->limit(10)->get();
        return view('maklumat_pemohon.pemohon.list_timeline', compact('candidateTimeline'));
    }

    public function updatePersonal(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->personal_no_pengenalan)->first();

            $request->validate([
                'gender' => 'required|string|exists:ruj_jantina,kod',
                'religion' => 'required|string|exists:ruj_agama,kod',
                'race' => 'required|string|exists:ruj_keturunan,kod',
                'date_of_birth' => 'required',
                'marital_status' => 'required|required|exists:ruj_taraf_kahwin,kod',
                'phone_number' => 'required',
                'email' => 'required|email:rfc,dns',
            ],[
                'gender.required' => 'Sila pilih jantina',
                'gender.exists' => 'Tiada rekod data jantina yang dipilih',
                'religion.required' => 'Sila pilih agama',
                'religion.exists' => 'Tiada rekod data agama yang dipilih',
                'race.required' => 'Sila pilih keturunan',
                'race.exists' => 'Tiada rekod data keturunan yang dipilih',
                'date_of_birth.required' => 'Sila isikan tarikh lahir',
                'marital_status.required' => 'Sila pilih taraf perkahwinan',
                'marital_status.exists' => 'Tiada rekod data taraf perkahwinan yang dipilih',
                'phone_number.required' => 'Sila isikan no telefon',
                'email.required' => 'Sila isikan emel',
                'email.email' => 'Sila isikan emel yang sah',
            ]);

            $candidate->update([
                'jan_kod' => $request->gender,
                'agama' => $request->religion,
                'ket_kod' => $request->race,
                'tarikh_lahir' => Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d'),
                'taraf_perkahwinan' => $request->marital_status,
                'e_mel' => $request->email,
                'no_tel' => $request->phone_number,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->personal_no_pengenalan,
                'activity_type_id' => 4,
                'details' => 'Kemaskini Maklumat Peribadi (Peribadi)',
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

    public function personalDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            $candidate->tarikh_lahir = Carbon::parse($candidate->tarikh_lahir)->format('d/m/Y');

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateAlamatTetap(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->alamat_tetap_no_pengenalan)->first();

            $request->validate([
                'permanent_address_1' => 'required|string',
                'permanent_address_2' => 'nullable|string',
                'permanent_address_3' => 'nullable|string',
                'permanent_poscode' => 'required|min:5|string',
                'permanent_city' => 'required|string',
                'permanent_state' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'permanent_address_1.required' => 'Sila isi alamat tetap',
                'permanent_poscode.required' => 'Sila isi poskod alamat tetap',
                'permanent_poscode.min' => 'Poskod alamat tetap mestilah sekurang-kurangnya 5 aksara',
                'permanent_city.required' => 'Sila isi bandar alamat tetap',
                'permanent_state.required' => 'Sila pilih negeri alamat tetap',
                'permanent_state.exists' => 'Tiada rekod data negeri yang dipilih',
            ]);

            $candidate->update([
                'alamat_1_tetap' => $request->permanent_address_1,
                'alamat_2_tetap' => $request->permanent_address_2,
                'alamat_3_tetap' => $request->permanent_address_3,
                'poskod_tetap' => $request->permanent_poscode,
                'bandar_tetap' => $request->permanent_city,
                'tempat_tinggal_tetap' => $request->permanent_state,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->alamat_tetap_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Alamat Tetap)',
                'activity_type_id' => 4,
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

    public function updateAlamatSurat(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->alamat_surat_no_pengenalan)->first();

            $request->validate([
                'address_1' => 'required|string',
                'address_2' => 'nullable|string',
                'address_3' => 'nullable|string',
                'poscode' => 'required|min:5|string',
                'city' => 'required|string',
                'state' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'address_1.required' => 'Sila isi alamat surat menyurat',
                'poscode.required' => 'Sila isi poskod alamat surat menyurat',
                'poscode.min' => 'Poskod alamat surat menyurat mestilah sekurang-kurangnya 5 aksara',
                'city.required' => 'Sila isi bandar alamat surat menyurat',
                'state.required' => 'Sila pilih negeri alamat surat menyurat',
                'state.exists' => 'Tiada rekod data negeri yang dipilih',
            ]);

            $candidate->update([
                'alamat_1' => $request->address_1,
                'alamat_2' => $request->address_2,
                'alamat_3' => $request->address_3,
                'poskod' => $request->poscode,
                'bandar' => $request->city,
                'tempat_tinggal' => $request->state,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->alamat_surat_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Alamat Surat Menyurat)',
                'activity_type_id' => 4,
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

    public function alamatDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateTempatLahir(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->tempat_lahir_no_pengenalan)->first();

            $request->validate([
                'place_of_birth' => 'required|string|exists:ruj_negeri,kod',
                'father_place_of_birth' => 'required|string|exists:ruj_negeri,kod',
                'mother_place_of_birth' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'place_of_birth.required' => 'Sila pilih tempat lahir',
                'place_of_birth.exists' => 'Tiada rekod tempat lahir yang dipilih',
                'father_place_of_birth.required' => 'Sila pilih tempat lahir ayah',
                'father_place_of_birth.exists' => 'Tiada rekod tempat lahir ayah yang dipilih',
                'mother_place_of_birth.required' => 'Sila pilih tempat lahir ibu',
                'mother_place_of_birth.exists' => 'Tiada rekod tempat lahir ibu yang dipilih',
            ]);

            $candidate->update([
                'tempat_lahir' => $request->place_of_birth,
                'tempat_lahir_bapa' => $request->father_place_of_birth,
                'tempat_lahir_ibu' => $request->mother_place_of_birth,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->tempat_lahir_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Tempat Lahir)',
                'activity_type_id' => 4,
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

    public function tempatLahirDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateLesenMemandu(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'license_type' => 'required|string|not_in:Tiada Maklumat',
                'license_expiry_date' => 'required|string|not_in:Tiada Maklumat',
                'license_blacklist_status' => 'required|string|not_in:Tiada Maklumat',
                'license_blacklist_details' => 'required|string|not_in:Tiada Maklumat',
            ],[
                'license_type.required' => 'Sila pilih jenis lesen',
                'license_expiry_date.required' => 'Sila pilih tarikh tamat tempoh',
                'license_blacklist_status.required' => 'Sila pilih senarai hitam status',
                'license_blacklist_details.required' => 'Sila pilih butiran senarai hitam',
            ]);

            $candidateLesen = CalonLesen::where('cal_no_pengenalan', $request->lesen_memandu_no_pengenalan)->first();

            if($candidateLesen){
                CalonLesen::where('cal_no_pengenalan',$request->lesen_memandu_no_pengenalan)->update([
                    'jenis_lesen' => $request->license_type,
                    //'tempoh_tamat' => Carbon::createFromFormat('d/m/Y', $request->license_expiry_date)->format('Y-m-d'),
                    'tempoh_tamat' => $request->license_expiry_date,
                    'status_senaraihitam' => $request->license_blacklist_status,
                    'msg_senaraihitam' => $request->license_blacklist_details,
                ]);
            }else{
                CalonLesen::create([
                    'cal_no_pengenalan' => $request->lesen_memandu_no_pengenalan,
                    'jenis_lesen' => $request->license_type,
                    //'tempoh_tamat' => Carbon::createFromFormat('d/m/Y', $request->license_expiry_date)->format('Y-m-d'),
                    'tempoh_tamat' => $request->license_expiry_date,
                    'status_senaraihitam' => $request->license_blacklist_status,
                    'msg_senaraihitam' => $request->license_blacklist_details,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->lesen_memandu_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Lesen Memandu)',
                'activity_type_id' => 4,
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

    public function lesenMemanduDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)
            ->with([
                'license'
            ])->first();
            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //$candidate->license->tempoh_tamat = ($candidate->license->tempoh_tamat != null) ? Carbon::parse($candidate->license->tempoh_tamat)->format('d/m/Y') : null;

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateOKU(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'oku_registration_no' => 'required|string|not_in:Tiada Maklumat',
                'oku_status' => 'required|string|not_in:Tiada Maklumat',
                'oku_category' => 'required|string|not_in:Tiada Maklumat',
                'oku_sub' => 'required|string',
            ],[
                'oku_registration_no.required' => 'Sila pilih nombor pendaftaran',
                'oku_status.required' => 'Sila pilih tempat status',
                'oku_category.required' => 'Sila pilih kategori',
                'oku_sub.required' => 'Sila pilih sub-kategori',
            ]);

            $candidateOku = CalonOku::where('no_pengenalan', $request->oku_no_pengenalan)->first();

            if($candidateOku){
                CalonOku::where('no_pengenalan',$request->oku_no_pengenalan)->update([
                    'no_daftar_jkm' => $request->oku_registration_no,
                    'status_oku' => $request->oku_status,
                    'kategori_oku' => $request->oku_category,
                    'sub_oku' => $request->oku_sub == 'Tiada Maklumat'? null : $request->oku_sub,
                    'pengguna' => auth()->user()->id,
                ]);
            }else{
                CalonOku::create([
                    'no_pengenalan' => $request->oku_no_pengenalan,
                    'no_daftar_jkm' => $request->oku_registration_no,
                    'status_oku' => $request->oku_status,
                    'kategori_oku' => $request->oku_category,
                    'sub_oku' => $request->oku_sub,
                    'id_pencipta' => auth()->user()->id,
                    'pengguna' => auth()->user()->id,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->oku_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (OKU)',
                'activity_type_id' => 4,
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

    public function OKUDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)
            ->with([
                'oku',
            ])->first();
            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updatePusatTemuduga(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->pusat_temuduga_no_pengenalan)->first();

            $request->validate([
                'pusat_temuduga' => 'required|string|exists:ruj_pusat_temuduga,kod',
            ],[
                'pusat_temuduga.required' => 'Sila pilih pusat temuduga',
                'pusat_temuduga.exists' => 'Tiada rekod pusat temuduga yang dipilih',
            ]);

            $candidate->update([
                'pusat_temuduga' => $request->pusat_temuduga,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pusat_temuduga_no_pengenalan,
                'details' => 'Kemaskini Maklumat Skim (Pusat Temuduga)',
                'activity_type_id' => 4,
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

    public function pusatTemudugaDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function storePmr(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_pmr' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_pmr' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_pmr' => 'required|string',
            ],[
                'subjek_pmr.required' => 'Sila pilih subjek pmr',
                'subjek_pmr.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_pmr.required' => 'Sila pilih gred pmr',
                'gred_pmr.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_pmr.required' => 'Sila pilih gred pmr',
                'tahun_pmr.exists' => 'Tiada rekod gred pmr yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->pmr_no_pengenalan,
                'mpel_kod' => $request->subjek_pmr,
                'gred' => $request->gred_pmr,
                'tahun' => $request->tahun_pmr,
                'mpel_tkt' => 3,
                'jenis_sijil' => 1, // 1 = PMR
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (PT3/PMR/SRP)',
                'activity_type_id' => 3,
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

    public function listPmr(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidatePmr = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('mpel_tkt', 3)->with('subjectForm3')
            ->whereHas('subjectForm3', function ($query) {
                $query->where('tkt', '3');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePmr]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePmr(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_pmr' => 'required|string',
                'gred_pmr' => 'required|string',
                'tahun_pmr' => 'required|string',
            ],[
                'subjek_pmr.required' => 'Sila pilih subjek pmr',
                'gred_pmr.required' => 'Sila pilih gred pmr',
                'tahun_pmr.required' => 'Sila pilih gred pmr',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_pmr)->update([
                'mpel_kod' => $request->subjek_pmr,
                'gred' => $request->gred_pmr,
                'tahun' => $request->tahun_pmr,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (PT3/PMR/SRP)',
                'activity_type_id' => 4,
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

    public function deletePmr(Request $request)
    {
        $pmr = CalonKeputusanSekolah::find($request-> idPmr);

        if (!$pmr) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $pmr->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm1' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_spm1' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spm1' => 'required|string',
            ],[
                'subjek_spm1.required' => 'Sila pilih subjek spm',
                'subjek_spm1.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spm1.required' => 'Sila pilih gred spm',
                'gred_spm1.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spm1.required' => 'Sila pilih gred spm',
                'tahun_spm1.exists' => 'Tiada rekod gred spm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->spm1_no_pengenalan,
                'kep_terbuka' => 1,
                'mpel_kod' => $request->subjek_spm1,
                'gred' => $request->gred_spm1,
                'tahun' => $request->tahun_spm1,
                'jenis_sijil' => 1,
                'mpel_tkt' => 5,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm1_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SPM/SPMV 1)',
                'activity_type_id' => 3,
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

    public function listSpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSpm = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 1)
            ->where('mpel_tkt', 5)
            ->whereIn('jenis_sijil', [1, 3])
            ->with('subjectForm5')
            ->whereHas('subjectForm5', function ($query) {
                $query->where('tkt', '5');
            })->get();

            $spm1 = [];
            foreach($candidateSpm as $calonSpm){
                $spm1['data'][] = $calonSpm;
            }

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $spm1]);

        } catch (\Throwable $e) {
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateSpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm1' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_spm1' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spm1' => 'required|string',
            ],[
                'subjek_spm1.required' => 'Sila pilih subjek spm',
                'subjek_spm1.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spm1.required' => 'Sila pilih gred spm',
                'gred_spm1.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spm1.required' => 'Sila pilih gred spm',
                'tahun_spm1.exists' => 'Tiada rekod gred spm yang dipilih',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_spm1)->update([
                'mpel_kod' => $request->subjek_spm1,
                'gred' => $request->gred_spm1,
                'tahun' => $request->tahun_spm1,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm1_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SPM/SPMV 1)',
                'activity_type_id' => 4,
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

    public function deleteSpm1(Request $request)
    {
        $spm = CalonKeputusanSekolah::find($request->idSpm);

        if (!$spm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $spm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm2' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_spm2' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spm2' => 'required|string',
            ],[
                'subjek_spm2.required' => 'Sila pilih subjek spm',
                'subjek_spm2.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spm2.required' => 'Sila pilih gred spm',
                'gred_spm2.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spm2.required' => 'Sila pilih gred spm',
                'tahun_spm2.exists' => 'Tiada rekod gred spm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->spm2_no_pengenalan,
                'kep_terbuka' => 2,
                'mpel_kod' => $request->subjek_spm2,
                'gred' => $request->gred_spm2,
                'tahun' => $request->tahun_spm2,
                'jenis_sijil' => 1,
                'mpel_tkt' => 5,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm2_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SPM/SPMV 2)',
                'activity_type_id' => 3,
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

    public function listSpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSpm = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 2)
            ->where('mpel_tkt', 5)
            ->whereIn('jenis_sijil', [1, 3])
            ->with('subjectForm5')
            ->whereHas('subjectForm5', function ($query) {
                $query->where('tkt', '5');
            })->get();

            $spm2 = [];
            foreach($candidateSpm as $calonSpm){
                $spm2['data'][] = $calonSpm;
            }

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $spm2]);

        } catch (\Throwable $e) {
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateSpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm2' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_spm2' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spm2' => 'required|string',
            ],[
                'subjek_spm2.required' => 'Sila pilih subjek spm',
                'subjek_spm2.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spm2.required' => 'Sila pilih gred spm',
                'gred_spm2.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spm2.required' => 'Sila pilih gred spm',
                'tahun_spm2.exists' => 'Tiada rekod gred spm yang dipilih',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_spm2)->update([
                'mpel_kod' => $request->subjek_spm2,
                'gred' => $request->gred_spm2,
                'tahun' => $request->tahun_spm2,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm2_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SPM/SPMV 2)',
                'activity_type_id' => 4,
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

    public function deleteSpm2(Request $request)
    {
        $spm = CalonKeputusanSekolah::find($request->idSpm);

        if (!$spm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $spm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spmv' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_spmv' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spmv' => 'required|string',
            ],[
                'subjek_spmv.required' => 'Sila pilih subjek spmv',
                'subjek_spmv.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spmv.required' => 'Sila pilih gred spmv',
                'gred_spmv.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spmv.required' => 'Sila pilih gred spmv',
                'tahun_spmv.exists' => 'Tiada rekod gred spmv yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->spmv_no_pengenalan,
                'mpel_kod' => $request->subjek_spmv,
                'gred' => $request->gred_spmv,
                'tahun' => $request->tahun_spmv,
                'jenis_sijil' => 3,
                'mpel_tkt'=> 5,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spmv_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SPMV)',
                'activity_type_id' => 3,
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

    public function listSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSpmv = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 5)->where('jenis_sijil', 3)->with('subjectForm5')->whereHas('subjectForm5', function ($query) {
                $query->where('tkt', '5');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSpmv]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spmv' => 'required|string',
                'gred_spmv' => 'required|string',
                'tahun_spmv' => 'required|string',
            ],[
                'subjek_spmv.required' => 'Sila pilih subjek spmv',
                'gred_spmv.required' => 'Sila pilih gred spmv',
                'tahun_spmv.required' => 'Sila pilih gred spmv',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_spmv)->update([
                'mpel_kod' => $request->subjek_spmv,
                'gred' => $request->gred_spmv,
                'tahun' => $request->tahun_spmv,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spmv_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SPMV)',
                'activity_type_id' => 4,
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

    public function deleteSpmv(Request $request)
    {
        $spmv = CalonKeputusanSekolah::find($request-> idSpmv);

        if (!$spmv) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $spmv->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_svm' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_svm' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_svm' => 'required|string',
            ],[
                'subjek_svm.required' => 'Sila pilih subjek svm',
                'subjek_svm.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_svm.required' => 'Sila pilih gred svm',
                'gred_svm.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_svm.required' => 'Sila pilih gred svm',
                'tahun_svm.exists' => 'Tiada rekod gred svm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->svm_no_pengenalan,
                'mpel_kod' => $request->subjek_svm,
                'gred' => $request->gred_svm,
                'tahun' => $request->tahun_svm,
                'jenis_sijil' => 5,
                'mpel_tkt'=> 5,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->svm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SVM)',
                'activity_type_id' => 3,
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

    public function listSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $noPengenalan = $request->noPengenalan;

            $candidateSvm = CalonSvm::where('cal_no_pengenalan', $noPengenalan)->where('mata_pelajaran', '104')->with(['qualification', 'subject'])->first();

            // $candidateSvm = CalonSvm::select('calon_svm.*')
            //     ->where('calon_svm.mata_pelajaran', '104')
            //     ->where('calon_svm.cal_no_pengenalan', $noPengenalan)
            //     ->leftJoin('calon_svm as svm2', function ($join) use ($noPengenalan) {
            //         $join->on('calon_svm.kel1_kod', '=', 'svm2.kel1_kod')
            //             ->where('svm2.cal_no_pengenalan', $noPengenalan)
            //             ->where('svm2.mata_pelajaran', '104')
            //             ->whereRaw('calon_svm.id > CAST(svm2.id AS bigint)');
            //     })
            //     ->whereNull('svm2.id')
            //     ->with(['qualification', 'subject'])
            //     ->get();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSvm]);

        } catch (\Throwable $e) {
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_svm' => 'required|string',
                'gred_svm' => 'required|string',
                'tahun_svm' => 'required|string',
            ],[
                'subjek_svm.required' => 'Sila pilih subjek svm',
                'gred_svm.required' => 'Sila pilih gred svm',
                'tahun_svm.required' => 'Sila pilih gred svm',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_svm)->update([
                'mpel_kod' => $request->subjek_svm,
                'gred' => $request->gred_svm,
                'tahun' => $request->tahun_svm,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->svm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SVM)',
                'activity_type_id' => 4,
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

    public function deleteSvm(Request $request)
    {
        $svm = CalonKeputusanSekolah::find($request-> idSvm);

        if (!$svm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $svm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm1' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stpm1' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stpm1' => 'required|string',
            ],[
                'subjek_stpm1.required' => 'Sila pilih subjek stpm',
                'subjek_stpm1.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stpm1.required' => 'Sila pilih gred stpm',
                'gred_stpm1.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stpm1.required' => 'Sila pilih gred stpm',
                'tahun_stpm1.exists' => 'Tiada rekod gred stpm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->stpm1_no_pengenalan,
                'kep_terbuka' => 1,
                'mpel_kod' => $request->subjek_stpm1,
                'gred' => $request->gred_stpm1,
                'tahun' => $request->tahun_stpm1,
                'jenis_sijil' => 1,
                'mpel_tkt'=> 6,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm1_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STPM 1)',
                'activity_type_id' => 3,
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

    public function listStpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStpm = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 1)
            ->where('mpel_tkt', 6)
            ->where('jenis_sijil', 1)
            ->with('subjectForm6')
            ->whereHas('subjectForm6', function ($query) {
                $query->where('tkt', '6');
            })->get();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStpm]);

        } catch (\Throwable $e) {

            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateStpm1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm1' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stpm1' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stpm1' => 'required|string',
            ],[
                'subjek_stpm1.required' => 'Sila pilih subjek stpm',
                'subjek_stpm1.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stpm1.required' => 'Sila pilih gred stpm',
                'gred_stpm1.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stpm1.required' => 'Sila pilih gred stpm',
                'tahun_stpm1.exists' => 'Tiada rekod gred stpm yang dipilih',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stpm1)->update([
                'mpel_kod' => $request->subjek_stpm1,
                'gred' => $request->gred_stpm1,
                'tahun' => $request->tahun_stpm1,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm1_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STPM 1)',
                'activity_type_id' => 4,
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

    public function deleteStpm1(Request $request)
    {
        $stpm = CalonKeputusanSekolah::find($request-> idStpm);

        if (!$stpm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stpm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm2' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stpm2' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stpm2' => 'required|string',
            ],[
                'subjek_stpm2.required' => 'Sila pilih subjek stpm',
                'subjek_stpm2.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stpm2.required' => 'Sila pilih gred stpm',
                'gred_stpm2.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stpm2.required' => 'Sila pilih gred stpm',
                'tahun_stpm2.exists' => 'Tiada rekod gred stpm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->stpm2_no_pengenalan,
                'kep_terbuka' => 2,
                'mpel_kod' => $request->subjek_stpm2,
                'gred' => $request->gred_stpm2,
                'tahun' => $request->tahun_stpm2,
                'jenis_sijil' => 1,
                'mpel_tkt'=> 6,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm2_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STPM 2)',
                'activity_type_id' => 3,
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

    public function listStpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStpm = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 2)
            ->where('mpel_tkt', 6)
            ->where('jenis_sijil', 1)
            ->with('subjectForm6')
            ->whereHas('subjectForm6', function ($query) {
                $query->where('tkt', '6');
            })->get();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStpm]);

        } catch (\Throwable $e) {

            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateStpm2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm2' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stpm2' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stpm2' => 'required|string',
            ],[
                'subjek_stpm2.required' => 'Sila pilih subjek stpm',
                'subjek_stpm2.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stpm2.required' => 'Sila pilih gred stpm',
                'gred_stpm2.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stpm2.required' => 'Sila pilih gred stpm',
                'tahun_stpm2.exists' => 'Tiada rekod gred stpm yang dipilih',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stpm2)->update([
                'mpel_kod' => $request->subjek_stpm2,
                'gred' => $request->gred_stpm2,
                'tahun' => $request->tahun_stpm2,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm2_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STPM 2)',
                'activity_type_id' => 4,
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

    public function deleteStpm2(Request $request)
    {
        $stpm = CalonKeputusanSekolah::find($request-> idStpm);

        if (!$stpm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stpm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStam1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam1' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stam1' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stam1' => 'required|string',
            ],[
                'subjek_stam1.required' => 'Sila pilih subjek stam',
                'subjek_stam1.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stam1.required' => 'Sila pilih gred stam',
                'gred_stam1.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stam1.required' => 'Sila pilih gred stam',
                'tahun_stam1.exists' => 'Tiada rekod gred stam yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->stam1_no_pengenalan,
                'kep_terbuka' => 1,
                'mpel_kod' => $request->subjek_stam1,
                'gred' => $request->gred_stam1,
                'tahun' => $request->tahun_stam1,
                'jenis_sijil' => 5,
                'mpel_tkt'=> 6,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam1_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STAM 1)',
                'activity_type_id' => 3,
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

    public function listStam1(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStam = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 1)
            ->where('mpel_tkt', 6)
            ->where('jenis_sijil', 5)
            ->with('subjectForm6')
            ->whereHas('subjectForm6', function ($query) {
                $query->where('tkt', '6');
            })->get();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStam]);

        } catch (\Throwable $e) {

            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateStam1(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam1' => 'required|string',
                'gred_stam1' => 'required|string',
                'tahun_stam1' => 'required|string',
            ],[
                'subjek_stam1.required' => 'Sila pilih subjek stam',
                'gred_stam1.required' => 'Sila pilih gred stam',
                'tahun_stam1.required' => 'Sila pilih gred stam',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stam1)->update([
                'mpel_kod' => $request->subjek_stam1,
                'gred' => $request->gred_stam1,
                'tahun' => $request->tahun_stam1,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam1_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STAM 1)',
                'activity_type_id' => 4,
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

    public function deleteStam1(Request $request)
    {
        $stam = CalonKeputusanSekolah::find($request-> idStam);

        if (!$stam) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stam->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStam2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam2' => 'required|string|exists:ruj_matapelajaran,kod',
                'gred_stam2' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stam2' => 'required|string',
            ],[
                'subjek_stam2.required' => 'Sila pilih subjek stam',
                'subjek_stam2.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stam2.required' => 'Sila pilih gred stam',
                'gred_stam2.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stam2.required' => 'Sila pilih gred stam',
                'tahun_stam2.exists' => 'Tiada rekod gred stam yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'cal_no_pengenalan' => $request->stam2_no_pengenalan,
                'kep_terbuka' => 2,
                'mpel_kod' => $request->subjek_stam2,
                'gred' => $request->gred_stam2,
                'tahun' => $request->tahun_stam2,
                'jenis_sijil' => 5,
                'mpel_tkt'=> 6,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam2_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STAM 2)',
                'activity_type_id' => 3,
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

    public function listStam2(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStam = CalonKeputusanSekolah::where('cal_no_pengenalan', $request->noPengenalan)
            ->where('kep_terbuka', 2)
            ->where('mpel_tkt', 6)
            ->where('jenis_sijil', 5)
            ->with('subjectForm6')
            ->whereHas('subjectForm6', function ($query) {
                $query->where('tkt', '6');
            })->get();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStam]);

        } catch (\Throwable $e) {

            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateStam2(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam2' => 'required|string',
                'gred_stam2' => 'required|string',
                'tahun_stam2' => 'required|string',
            ],[
                'subjek_stam2.required' => 'Sila pilih subjek stam',
                'gred_stam2.required' => 'Sila pilih gred stam',
                'tahun_stam2.required' => 'Sila pilih gred stam',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stam2)->update([
                'mpel_kod' => $request->subjek_stam2,
                'gred' => $request->gred_stam2,
                'tahun' => $request->tahun_stam2,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam2_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STAM 2)',
                'activity_type_id' => 4,
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

    public function deleteStam2(Request $request)
    {
        $stam = CalonKeputusanSekolah::find($request-> idStam);

        if (!$stam) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stam->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kolej_matrikulasi' => 'required|string',
                'jurusan_matrikulasi' => 'required|string',
                'matrik_matrikulasi' => 'required|string',
                'sesi_matrikulasi' => 'required|string',
                'semester_matrikulasi' => 'required|string',
                'subjek_matrikulasi' => 'required|string',
                'gred_matrikulasi' => 'required|string',
                'pngk_matrikulasi' => 'required|string',
            ],[
                'kolej_matrikulasi.required' => 'Sila pilih kolej matrikulasi',
                'jurusan_matrikulasi.required' => 'Sila pilih jurusan matrikulasi',
                'matrik_matrikulasi.required' => 'Sila isikan nombor matrik matrikulasi',
                'sesi_matrikulasi.required' => 'Sila isikan sesi matrikulasi',
                'semester_matrikulasi.required' => 'Sila isikan semester matrikulasi',
                'subjek_matrikulasi.required' => 'Sila pilih subjek matrikulasi',
                'gred_matrikulasi.required' => 'Sila isikan gred matrikulasi',
                'pngk_matrikulasi.required' => 'Sila isikan pngk matrikulasi',
            ]);

            CalonMatrikulasi::create([
                'cal_no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'no_matrik' => $request->matrik_matrikulasi,
                'jurusan' => $request->jurusan_matrikulasi,
                'sesi' => $request->sesi_matrikulasi,
                'semester' => $request->semester_matrikulasi,
                'kolej' => $request->kolej_matrikulasi,
                'kod_subjek' => $request->subjek_matrikulasi,
                'gred' => $request->gred_matrikulasi,
                'pngk' => $request->pngk_matrikulasi,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (Matrikulasi)',
                'activity_type_id' => 3,
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

    public function listMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateMatrikulasi = CalonMatrikulasi::where('cal_no_pengenalan', $request->noPengenalan)->with(['course', 'college', 'subject'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateMatrikulasi]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kolej_matrikulasi' => 'required|string',
                'jurusan_matrikulasi' => 'required|string',
                'matrik_matrikulasi' => 'required|string',
                'sesi_matrikulasi' => 'required|string',
                'semester_matrikulasi' => 'required|string',
                'subjek_matrikulasi' => 'required|string',
                'gred_matrikulasi' => 'required|string',
                'pngk_matrikulasi' => 'required|string',
            ],[
                'kolej_matrikulasi.required' => 'Sila pilih kolej matrikulasi',
                'jurusan_matrikulasi.required' => 'Sila pilih jurusan matrikulasi',
                'matrik_matrikulasi.required' => 'Sila isikan nombor matrik matrikulasi',
                'sesi_matrikulasi.required' => 'Sila isikan sesi matrikulasi',
                'semester_matrikulasi.required' => 'Sila isikan semester matrikulasi',
                'subjek_matrikulasi.required' => 'Sila pilih subjek matrikulasi',
                'gred_matrikulasi.required' => 'Sila isikan gred matrikulasi',
                'pngk_matrikulasi.required' => 'Sila isikan pngk matrikulasi',
            ]);

            CalonMatrikulasi::where('id',$request->id_matrikulasi)->update([
                'no_matrik' => $request->matrik_matrikulasi,
                'jurusan' => $request->jurusan_matrikulasi,
                'sesi' => $request->sesi_matrikulasi,
                'semester' => $request->semester_matrikulasi,
                'kolej' => $request->kolej_matrikulasi,
                'kod_subjek' => $request->subjek_matrikulasi,
                'gred' => $request->gred_matrikulasi,
                'pngk' => $request->pngk_matrikulasi,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (Matrikulasi)',
                'activity_type_id' => 4,
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

    public function deleteMatrikulasi(Request $request){
        $smatrikulasi = CalonMatrikulasi::find($request-> idMatrikulasi);

        if (!$smatrikulasi) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $smatrikulasi->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSkm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_skm' => 'required|string',
                'nama_skm' => 'required|string',
            ],[
                'tahun_skm.required' => 'Sila isi tahun kelulusan',
                'nama_skm.required' => 'Sila pilih kelulusan',
            ]);

            CalonSkm::create([
                'cal_no_pengenalan' => $request->skm_no_pengenalan,
                'kel1_kod' => $request->nama_skm,
                'tahun_lulus' => $request->tahun_skm,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->skm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SKM)',
                'activity_type_id' => 3,
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

    public function listSkm(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateSkm = CalonSkm::where('cal_no_pengenalan', $request->noPengenalan)->with(['qualification'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSkm]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSkm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_skm' => 'required|string',
                'nama_skm' => 'required|string',
            ],[
                'tahun_skm.required' => 'Sila isi tahun kelulusan',
                'nama_skm.required' => 'Sila pilih kelulusan',
            ]);

            CalonSkm::where('id',$request->id_skm)->update([
                'kel1_kod' => $request->nama_skm,
                'tahun_lulus' => $request->tahun_skm,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->skm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SKM)',
                'activity_type_id' => 4,
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

    public function deleteSkm(Request $request){
        $skm = CalonSkm::find($request-> idSkm);

        if (!$skm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $skm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeBahasa(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bahasa' => 'required|string',
                'penguasaan_bahasa' => 'required|string',
            ],[
                'nama_bahasa.required' => 'Sila pilih bahasa',
                'penguasaan_bahasa.required' => 'Sila pilih penguasaan',

            ]);

            CalonBahasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'jenis_bahasa' => $request->nama_bahasa,
                'penguasaan' => $request->penguasaan_bahasa,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'details' => 'Tambah Maklumat Tambahan (Bahasa)',
                'activity_type_id' => 3,
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

    public function listBahasa(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateBahasa = CalonBahasa::select(
            )->where('no_pengenalan', $request->noPengenalan)->with(['language', 'kategori'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateBahasa]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateBahasa(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bahasa' => 'required|string',
                'penguasaan_bahasa' => 'required|string',
            ],[
                'nama_bahasa.required' => 'Sila pilih bahasa',
                'penguasaan_bahasa.required' => 'Sila pilih penguasaan',

            ]);

            CalonBahasa::where('id',$request->id_bahasa)->update([
                'jenis_bahasa' => $request->nama_bahasa,
                'penguasaan' => $request->penguasaan_bahasa,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tamabahan (Bahasa)',
                'activity_type_id' => 4,
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

    public function deleteBahasa(Request $request){
        $bahasa = CalonBahasa::find($request-> idBahasa);

        if (!$bahasa) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $bahasa->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeBakat(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bakat' => 'required|string',
            ],[
                'nama_bakat.required' => 'Sila pilih kelulusan',
            ]);

            CalonBakat::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'bakat' => $request->nama_bakat,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'details' => 'Tambah Maklumat Tambahan (Bakat)',
                'activity_type_id' => 3,
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

    public function listBakat(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateBakat = CalonBakat::select(
            )->where('no_pengenalan', $request->noPengenalan)->with(['talent'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateBakat]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateBakat(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bakat' => 'required|string',
            ],[
                'nama_bakat.required' => 'Sila pilih kelulusan',
            ]);

            CalonBakat::where('id',$request->id_bakat)->update([
                'bakat' => $request->nama_bakat,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tamabahan (Bakat)',
                'activity_type_id' => 4,
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

    public function deleteBakat(Request $request){
        $bakat = CalonBakat::find($request-> idBakat);

        if (!$bakat) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $bakat->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    // public function updateDiploma(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidate = CalonPengajianTinggi::where('cal_no_pengenalan', $request->diploma_no_pengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 5);
    //             });
    //         })
    //         ->first();

    //         $request->validate([
    //             'tahun_diploma' => 'required|string',
    //             'kelayakan_diploma' => 'required|string|exists:ruj_kelayakan,kod',
    //             'cgpa_diploma' => 'required|string',
    //             'institusi_diploma' => 'required|string|exists:ruj_institusi,kod',
    //             'nama_sijil_diploma' => 'required|string',
    //             'pengkhususan_diploma' => 'required|string|exists:ruj_pengkhususan,kod',
    //             'fln_diploma' => 'required|integer|digits_between:1,2',
    //             'tarikh_senat_diploma' => 'required',
    //             'biasiswa_diploma' => 'required|boolean',
    //         ],[
    //             'tahun_diploma.required' => 'Sila pilih tahun pengajian tinggi',
    //             'kelayakan_diploma.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
    //             'kelayakan_diploma.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
    //             'cgpa_diploma.required' => 'Sila pilih cgpa pengajian tinggi',
    //             'institusi_diploma.required' => 'Sila pilih institusi pengajian tinggi',
    //             'institusi_diploma.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
    //             'nama_sijil_diploma.required' => 'Sila pilih nama sijil pengajian tinggi',
    //             'pengkhususan_diploma.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
    //             'pengkhususan_diploma.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
    //             'fln_diploma.required' => 'Sila pilih francais luar negara pengajian tinggi',
    //             'fln_diploma.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
    //             'tarikh_senat_diploma.required' => 'Sila pilih tarikh senat pengajian tinggi',
    //             'biasiswa_diploma.required' => 'Sila pilih biasiswa pengajian tinggi',
    //             'biasiswa_diploma.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
    //         ]);

    //         if(!$candidate){
    //             CalonPengajianTinggi::create([
    //                 'cal_no_pengenalan' => $request->diploma_no_pengenalan,
    //                 'peringkat_pengajian' => 4,
    //                 'tahun_lulus' => $request->tahun_diploma,
    //                 'kel_kod' => $request->kelayakan_diploma,
    //                 'cgpa' => $request->cgpa_diploma,
    //                 'ins_kod' => $request->institusi_diploma,
    //                 'nama_sijil' => $request->nama_sijil_diploma,
    //                 'pen_kod' => $request->pengkhususan_diploma,
    //                 'ins_fln' => $request->fln_diploma,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_diploma)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_diploma,
    //             ]);
    //         } else{
    //             $candidate->update([
    //                 'tahun_lulus' => $request->tahun_diploma,
    //                 'kel_kod' => $request->kelayakan_diploma,
    //                 'cgpa' => $request->cgpa_diploma,
    //                 'ins_kod' => $request->institusi_diploma,
    //                 'nama_sijil' => $request->nama_sijil_diploma,
    //                 'pen_kod' => $request->pengkhususan_diploma,
    //                 'ins_fln' => $request->fln_diploma,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_diploma)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_diploma,
    //             ]);
    //         }

    //         CalonGarisMasa::create([
    //             'no_pengenalan' => $request->diploma_no_pengenalan,
    //             'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi Diploma)',
    //             'activity_type_id' => 4,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id,
    //         ]);

    //         DB::commit();
    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

    //     } catch (\Throwable $e) {

    //         DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function diplomaDetails(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidateDiploma = CalonPengajianTinggi::where('cal_no_pengenalan', $request->noPengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 5);
    //             });
    //         })
    //         ->first();

    //         $candidateDiploma->tarikh_senat = ($candidateDiploma->tarikh_senat != null) ? Carbon::parse($candidateDiploma->tarikh_senat)->format('d/m/Y') : null;

    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateDiploma]);

    //     } catch (\Throwable $e) {

    //         //DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function updateDegree(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidate = CalonPengajianTinggi::where('cal_no_pengenalan', $request->degree_no_pengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 7);
    //             });
    //         })
    //         ->first();

    //         $request->validate([
    //             'tahun_degree' => 'required|string',
    //             'kelayakan_degree' => 'required|string|exists:ruj_kelayakan,kod',
    //             'cgpa_degree' => 'required|string',
    //             'institusi_degree' => 'required|string|exists:ruj_institusi,kod',
    //             'nama_sijil_degree' => 'required|string',
    //             'pengkhususan_degree' => 'required|string|exists:ruj_pengkhususan,kod',
    //             'fln_degree' => 'required|integer|digits_between:1,2',
    //             'tarikh_senat_degree' => 'required',
    //             'biasiswa_degree' => 'required|boolean',
    //         ],[
    //             'tahun_degree.required' => 'Sila pilih tahun pengajian tinggi',
    //             'kelayakan_degree.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
    //             'kelayakan_degree.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
    //             'cgpa_degree.required' => 'Sila pilih cgpa pengajian tinggi',
    //             'institusi_degree.required' => 'Sila pilih institusi pengajian tinggi',
    //             'institusi_degree.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
    //             'nama_sijil_degree.required' => 'Sila pilih nama sijil pengajian tinggi',
    //             'pengkhususan_degree.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
    //             'pengkhususan_degree.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
    //             'fln_degree.required' => 'Sila pilih francais luar negara pengajian tinggi',
    //             'fln_degree.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
    //             'tarikh_senat_degree.required' => 'Sila pilih tarikh senat pengajian tinggi',
    //             'biasiswa_degree.required' => 'Sila pilih biasiswa pengajian tinggi',
    //             'biasiswa_degree.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
    //         ]);

    //         if(!$candidate){
    //             CalonPengajianTinggi::create([
    //                 'cal_no_pengenalan' => $request->degree_no_pengenalan,
    //                 'peringkat_pengajian' => 3,
    //                 'tahun_lulus' => $request->tahun_degree,
    //                 'kel_kod' => $request->kelayakan_degree,
    //                 'cgpa' => $request->cgpa_degree,
    //                 'ins_kod' => $request->institusi_degree,
    //                 'nama_sijil' => $request->nama_sijil_degree,
    //                 'pen_kod' => $request->pengkhususan_degree,
    //                 'ins_fln' => $request->fln_degree,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_degree)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_degree,
    //             ]);
    //         } else{
    //             $candidate->update([
    //                 'tahun_lulus' => $request->tahun_degree,
    //                 'kel_kod' => $request->kelayakan_degree,
    //                 'cgpa' => $request->cgpa_degree,
    //                 'ins_kod' => $request->institusi_degree,
    //                 'nama_sijil' => $request->nama_sijil_degree,
    //                 'pen_kod' => $request->pengkhususan_degree,
    //                 'ins_fln' => $request->fln_degree,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_degree)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_degree,
    //             ]);
    //         }

    //         CalonGarisMasa::create([
    //             'no_pengenalan' => $request->degree_no_pengenalan,
    //             'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi Ijazah Sarjana Muda)',
    //             'activity_type_id' => 4,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id,
    //         ]);

    //         DB::commit();
    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

    //     } catch (\Throwable $e) {

    //         DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function degreeDetails(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidateDegree = CalonPengajianTinggi::where('cal_no_pengenalan', $request->noPengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 7);
    //             });
    //         })
    //         ->first();

    //         $candidateDegree->tarikh_senat = ($candidateDegree->tarikh_senat != null) ? Carbon::parse($candidateDegree->tarikh_senat)->format('d/m/Y') : null;

    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateDegree]);

    //     } catch (\Throwable $e) {

    //         //DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function updateMaster(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidate = CalonPengajianTinggi::where('cal_no_pengenalan', $request->master_no_pengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 8);
    //             });
    //         })
    //         ->first();

    //         $request->validate([
    //             'tahun_master' => 'required|string',
    //             'kelayakan_master' => 'required|string|exists:ruj_kelayakan,kod',
    //             'cgpa_master' => 'required|string',
    //             'institusi_master' => 'required|string|exists:ruj_institusi,kod',
    //             'nama_sijil_master' => 'required|string',
    //             'pengkhususan_master' => 'required|string|exists:ruj_pengkhususan,kod',
    //             'fln_master' => 'required|integer|digits_between:1,2',
    //             'tarikh_senat_master' => 'required',
    //             'biasiswa_master' => 'required|boolean',
    //         ],[
    //             'tahun_master.required' => 'Sila pilih tahun pengajian tinggi',
    //             'kelayakan_master.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
    //             'kelayakan_master.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
    //             'cgpa_master.required' => 'Sila pilih cgpa pengajian tinggi',
    //             'institusi_master.required' => 'Sila pilih institusi pengajian tinggi',
    //             'institusi_master.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
    //             'nama_sijil_master.required' => 'Sila pilih nama sijil pengajian tinggi',
    //             'pengkhususan_master.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
    //             'pengkhususan_master.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
    //             'fln_master.required' => 'Sila pilih francais luar negara pengajian tinggi',
    //             'fln_master.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
    //             'tarikh_senat_master.required' => 'Sila pilih tarikh senat pengajian tinggi',
    //             'biasiswa_master.required' => 'Sila pilih biasiswa pengajian tinggi',
    //             'biasiswa_master.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
    //         ]);

    //         if(!$candidate){
    //             CalonPengajianTinggi::create([
    //                 'cal_no_pengenalan' => $request->master_no_pengenalan,
    //                 'peringkat_pengajian' => 2,
    //                 'tahun_lulus' => $request->tahun_master,
    //                 'kel_kod' => $request->kelayakan_master,
    //                 'cgpa' => $request->cgpa_master,
    //                 'ins_kod' => $request->institusi_master,
    //                 'nama_sijil' => $request->nama_sijil_master,
    //                 'pen_kod' => $request->pengkhususan_master,
    //                 'ins_fln' => $request->fln_master,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_master)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_master,
    //             ]);
    //         } else{
    //             $candidate->update([
    //                 'tahun_lulus' => $request->tahun_master,
    //                 'kel_kod' => $request->kelayakan_master,
    //                 'cgpa' => $request->cgpa_master,
    //                 'ins_kod' => $request->institusi_master,
    //                 'nama_sijil' => $request->nama_sijil_master,
    //                 'pen_kod' => $request->pengkhususan_master,
    //                 'ins_fln' => $request->fln_master,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_master)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_master,
    //             ]);
    //         }

    //         CalonGarisMasa::create([
    //             'no_pengenalan' => $request->master_no_pengenalan,
    //             'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi Ijazah Sarjana)',
    //             'activity_type_id' => 4,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id,
    //         ]);

    //         DB::commit();
    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

    //     } catch (\Throwable $e) {

    //         DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function masterDetails(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidateMaster = CalonPengajianTinggi::where('cal_no_pengenalan', $request->noPengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 8);
    //             });
    //         })
    //         ->first();

    //         $candidateMaster->tarikh_senat = ($candidateMaster->tarikh_senat != null) ? Carbon::parse($candidateMaster->tarikh_senat)->format('d/m/Y') : null;

    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateMaster]);

    //     } catch (\Throwable $e) {

    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function updatePhd(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidate = CalonPengajianTinggi::where('cal_no_pengenalan', $request->phd_no_pengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 9);
    //             });
    //         })
    //         ->first();

    //         $request->validate([
    //             'tahun_phd' => 'required|string',
    //             'kelayakan_phd' => 'required|string|exists:ruj_kelayakan,kod',
    //             'cgpa_phd' => 'required|string',
    //             'institusi_phd' => 'required|string|exists:ruj_institusi,kod',
    //             'nama_sijil_phd' => 'required|string',
    //             'pengkhususan_phd' => 'required|string|exists:ruj_pengkhususan,kod',
    //             'fln_phd' => 'required|integer|digits_between:1,2',
    //             'tarikh_senat_phd' => 'required',
    //             'biasiswa_phd' => 'required|boolean',
    //         ],[
    //             'tahun_phd.required' => 'Sila pilih tahun pengajian tinggi',
    //             'kelayakan_phd.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
    //             'kelayakan_phd.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
    //             'cgpa_phd.required' => 'Sila pilih cgpa pengajian tinggi',
    //             'institusi_phd.required' => 'Sila pilih institusi pengajian tinggi',
    //             'institusi_phd.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
    //             'nama_sijil_phd.required' => 'Sila pilih nama sijil pengajian tinggi',
    //             'pengkhususan_phd.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
    //             'pengkhususan_phd.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
    //             'fln_phd.required' => 'Sila pilih francais luar negara pengajian tinggi',
    //             'fln_phd.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
    //             'tarikh_senat_phd.required' => 'Sila pilih tarikh senat pengajian tinggi',
    //             'biasiswa_phd.required' => 'Sila pilih biasiswa pengajian tinggi',
    //             'biasiswa_phd.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
    //         ]);

    //         if(!$candidate){
    //             CalonPengajianTinggi::create([
    //                 'cal_no_pengenalan' => $request->phd_no_pengenalan,
    //                 'peringkat_pengajian' => 1,
    //                 'tahun_lulus' => $request->tahun_phd,
    //                 'kel_kod' => $request->kelayakan_phd,
    //                 'cgpa' => $request->cgpa_phd,
    //                 'ins_kod' => $request->institusi_phd,
    //                 'nama_sijil' => $request->nama_sijil_phd,
    //                 'pen_kod' => $request->pengkhususan_phd,
    //                 'ins_fln' => $request->fln_phd,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_phd)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_phd,
    //             ]);
    //         } else{
    //             $candidate->update([
    //                 'tahun_lulus' => $request->tahun_phd,
    //                 'kel_kod' => $request->kelayakan_phd,
    //                 'cgpa' => $request->cgpa_phd,
    //                 'ins_kod' => $request->institusi_phd,
    //                 'nama_sijil' => $request->nama_sijil_phd,
    //                 'pen_kod' => $request->pengkhususan_phd,
    //                 'ins_fln' => $request->fln_phd,
    //                 'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_phd)->format('Y-m-d'),
    //                 'biasiswa' => $request->biasiswa_phd,
    //             ]);
    //         }

    //         CalonGarisMasa::create([
    //             'no_pengenalan' => $request->phd_no_pengenalan,
    //             'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi Ijazah Doktor Falsafah)',
    //             'activity_type_id' => 4,
    //             'created_by' => auth()->user()->id,
    //             'updated_by' => auth()->user()->id,
    //         ]);

    //         DB::commit();
    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

    //     } catch (\Throwable $e) {

    //         DB::rollback();
    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    // public function phdDetails(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {

    //         $candidatePhd = CalonPengajianTinggi::where('cal_no_pengenalan', $request->noPengenalan)
    //         ->with('eligibility')->whereHas('eligibility', function ($query) {
    //             $query->with('kelayakanSetaraf');
    //             $query->whereHas('kelayakanSetaraf', function ($query2) {
    //                 $query2->where('kod', 9);
    //             });
    //         })
    //         ->first();

    //         $candidatePhd->tarikh_senat = ($candidatePhd->tarikh_senat != null) ? Carbon::parse($candidatePhd->tarikh_senat)->format('d/m/Y') : null;

    //         return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePhd]);

    //     } catch (\Throwable $e) {

    //         return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
    //     }
    // }

    public function storePt(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_pengajian_tinggi' => 'required|string',
                'peringkat_pengajian_tinggi' => 'required|string|exists:ruj_peringkat_pengajian,id',
                'kelayakan_pengajian_tinggi' => 'required|string|exists:ruj_kelayakan,kod',
                'cgpa_pengajian_tinggi' => 'required|string',
                'institusi_pengajian_tinggi' => 'required|string|exists:ruj_institusi,kod',
                'nama_sijil_pengajian_tinggi' => 'required|string',
                'pengkhususan_pengajian_tinggi' => 'required|string|exists:ruj_pengkhususan,kod',
                'fln_pengajian_tinggi' => 'required|integer|digits_between:1,2',
                'tarikh_senat_pengajian_tinggi' => 'required',
                'biasiswa_pengajian_tinggi' => 'required|boolean',
            ],[
                'tahun_pengajian_tinggi.required' => 'Sila pilih tahun pengajian tinggi',
                'kelayakan_pengajian_tinggi.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
                'kelayakan_pengajian_tinggi.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
                'cgpa_pengajian_tinggi.required' => 'Sila pilih cgpa pengajian tinggi',
                'institusi_pengajian_tinggi.required' => 'Sila pilih institusi pengajian tinggi',
                'institusi_pengajian_tinggi.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
                'nama_sijil_pengajian_tinggi.required' => 'Sila pilih nama sijil pengajian tinggi',
                'pengkhususan_pengajian_tinggi.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
                'pengkhususan_pengajian_tinggi.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
                'fln_pengajian_tinggi.required' => 'Sila pilih francais luar negara pengajian tinggi',
                'fln_pengajian_tinggi.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
                'tarikh_senat_pengajian_tinggi.required' => 'Sila pilih tarikh senat pengajian tinggi',
                'biasiswa_pengajian_tinggi.required' => 'Sila pilih biasiswa pengajian tinggi',
                'biasiswa_pengajian_tinggi.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
            ]);

            CalonPengajianTinggi::create([
                'cal_no_pengenalan' => $request->pengajian_tinggi_no_pengenalan,
                'tahun_lulus' => $request->tahun_pengajian_tinggi,
                'peringkat_pengajian' => $request->peringkat_pengajian_tinggi,
                'kel_kod' => $request->kelayakan_pengajian_tinggi,
                'cgpa' => $request->cgpa_pengajian_tinggi,
                'ins_kod' => $request->institusi_pengajian_tinggi,
                'nama_sijil' => $request->nama_sijil_pengajian_tinggi,
                'pen_kod' => $request->pengkhususan_pengajian_tinggi,
                'ins_fln' => $request->fln_pengajian_tinggi,
                'tarikh_senat' => $request->tarikh_senat_pengajian_tinggi,
                'biasiswa' => $request->biasiswa_pengajian_tinggi,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pengajian_tinggi_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (Pengajian Tinggi)',
                'activity_type_id' => 3,
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

    public function listPt(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidatePt = CalonPengajianTinggi::where('cal_no_pengenalan', $request->noPengenalan)
            ->with(['institution'])
            ->with(['eligibility'])
            ->with(['specialization'])
            ->with(['peringkat'])
            ->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePt]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }
    public function detailPt(Request $request, $idPt)
    {
        DB::beginTransaction();
        try {
            $candidatePt = CalonPengajianTinggi::where('id', $idPt)->first();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePt]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePt(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_pengajian_tinggi' => 'required|string',
                'peringkat_pengajian_tinggi' => 'required|string|exists:ruj_peringkat_pengajian,id',
                'kelayakan_pengajian_tinggi' => 'required|string|exists:ruj_kelayakan,kod',
                'cgpa_pengajian_tinggi' => 'required|string',
                'institusi_pengajian_tinggi' => 'required|string|exists:ruj_institusi,kod',
                'nama_sijil_pengajian_tinggi' => 'required|string',
                'pengkhususan_pengajian_tinggi' => 'required|string|exists:ruj_pengkhususan,kod',
                'fln_pengajian_tinggi' => 'required|integer|digits_between:1,2',
                'tarikh_senat_pengajian_tinggi' => 'required',
                'biasiswa_pengajian_tinggi' => 'required|boolean',
            ],[
                'tahun_pengajian_tinggi.required' => 'Sila pilih tahun pengajian tinggi',
                'kelayakan_pengajian_tinggi.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
                'kelayakan_pengajian_tinggi.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
                'cgpa_pengajian_tinggi.required' => 'Sila pilih cgpa pengajian tinggi',
                'institusi_pengajian_tinggi.required' => 'Sila pilih institusi pengajian tinggi',
                'institusi_pengajian_tinggi.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
                'nama_sijil_pengajian_tinggi.required' => 'Sila pilih nama sijil pengajian tinggi',
                'pengkhususan_pengajian_tinggi.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
                'pengkhususan_pengajian_tinggi.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
                'fln_pengajian_tinggi.required' => 'Sila pilih francais luar negara pengajian tinggi',
                'fln_pengajian_tinggi.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
                'tarikh_senat_pengajian_tinggi.required' => 'Sila pilih tarikh senat pengajian tinggi',
                'biasiswa_pengajian_tinggi.required' => 'Sila pilih biasiswa pengajian tinggi',
                'biasiswa_pengajian_tinggi.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
            ]);


            CalonPengajianTinggi::where('id',$request->id_pt)->update([
                'tahun_lulus' => $request->tahun_pengajian_tinggi,
                'peringkat_pengajian' => $request->peringkat_pengajian_tinggi,
                'kel_kod' => $request->kelayakan_pengajian_tinggi,
                'cgpa' => $request->cgpa_pengajian_tinggi,
                'ins_kod' => $request->institusi_pengajian_tinggi,
                'nama_sijil' => $request->nama_sijil_pengajian_tinggi,
                'pen_kod' => $request->pengkhususan_pengajian_tinggi,
                'ins_fln' => $request->fln_pengajian_tinggi,
                'tarikh_senat' => $request->tarikh_senat_pengajian_tinggi,
                'biasiswa' => $request->biasiswa_pengajian_tinggi,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pengajian_tinggi_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi)',
                'activity_type_id' => 4,
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

    public function deletePt(Request $request){
        $skm = CalonSkm::find($request-> idSkm);

        if (!$skm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $skm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeProfesional(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'no_ahli_profesional' => 'required|string',
                'kelulusan_profesional' => 'required|string|exists:ruj_kelulusan,kod',
                'tarikh_keahlian_profesional' => 'required',
            ],[
                'no_ahli_profesional.required' => 'Sila isikan no ahli',
                'kelulusan_profesional.required' => 'Sila pilih kelayakan profesional / ikhtisas',
                'kelulusan_profesional.exists' => 'Tiada rekod kelayakan profesional / ikhtisas yang dipilih',
                'tarikh_keahlian_profesional.required' => 'Sila isikan tarikh keahlian',
            ]);

            CalonProfesional::create([
                'cal_no_pengenalan' => $request->profesional_no_pengenalan,
                'no_ahli' => $request->no_ahli_profesional,
                'kel1_kod' => $request->kelulusan_profesional,
                'tarikh' => Carbon::createFromFormat('d/m/Y', $request->tarikh_keahlian_profesional)->format('Y-m-d'),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->profesional_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (Profesional)',
                'activity_type_id' => 3,
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

    public function listProfesional(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateProfesional = CalonProfesional::where('cal_no_pengenalan', $request->noPengenalan)->with(['qualification'])->get();

            $candidateProfesional->transform(function ($professional){
                $professional->tarikh = ($professional->tarikh != null) ? Carbon::parse($professional->tarikh)->format('d/m/Y') : null;
                return $professional;
            });

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateProfesional]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateProfesional(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'no_ahli_profesional' => 'required|string',
                'kelulusan_profesional' => 'required|string|exists:ruj_kelulusan,kod',
                'tarikh_keahlian_profesional' => 'required',
            ],[
                'no_ahli_profesional.required' => 'Sila isikan no ahli',
                'kelulusan_profesional.required' => 'Sila pilih kelayakan profesional / ikhtisas',
                'kelulusan_profesional.exists' => 'Tiada rekod kelayakan profesional / ikhtisas yang dipilih',
                'tarikh_keahlian_profesional.required' => 'Sila isikan tarikh keahlian',
            ]);

            CalonProfesional::where('id', $request->id_profesional)->update([
                'no_ahli' => $request->no_ahli_profesional,
                'kel1_kod' => $request->kelulusan_profesional,
                'tarikh' => Carbon::createFromFormat('d/m/Y', $request->tarikh_keahlian_profesional)->format('Y-m-d'),
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->profesional_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (Profesional)',
                'activity_type_id' => 4,
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

    public function deleteProfesional(Request $request){
        $profesional = CalonProfesional::find($request->idProfesional);

        if (!$profesional) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $profesional->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storePsl(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'jenis_peperiksaan' => 'required|string',
                'tarikh_peperiksaan' => 'required|string',
            ],[
                'jenis_peperiksaan.required' => 'Sila pilih jenis peperiksaan',
                'tarikh_peperiksaan.required' => 'Sila pilih tarikh peperiksaan',

            ]);

            CalonPsl::create([
                'cal_no_pengenalan' => $request->psl_no_pengenalan,
                'kel1_kod' => $request->jenis_peperiksaan,
                'tarikh_exam' => Carbon::createFromFormat('d/m/Y', $request->tarikh_peperiksaan)->format('Y-m-d'),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->psl_no_pengenalan,
                'details' => 'Tambah Maklumat Pegawai Berkhidmat (PSL)',
                'activity_type_id' => 3,
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

    public function listPsl(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidatePsl = CalonPsl::where('cal_no_pengenalan', $request->noPengenalan)->with(['qualification'])->get();

            foreach($candidatePsl as $psl){
                $psl->tarikh_exam = ($psl->tarikh_exam != null) ? Carbon::parse($psl->tarikh_exam)->format('d/m/Y') : null;
            }

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePsl]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePsl(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'jenis_peperiksaan' => 'required|string',
                'tarikh_peperiksaan' => 'required|string',
            ],[
                'jenis_peperiksaan.required' => 'Sila pilih jenis peperiksaan',
                'tarikh_peperiksaan.required' => 'Sila pilih tarikh peperiksaan',

            ]);

            CalonPsl::where('id',$request->id_psl)->update([
                'kel1_kod' => $request->jenis_peperiksaan,
                'tarikh_exam' => Carbon::createFromFormat('d/m/Y', $request->tarikh_peperiksaan)->format('Y-m-d'),
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->psl_no_pengenalan,
                'details' => 'Kemaskini Maklumat Pegawai Berkhidmat (PSL)',
                'activity_type_id' => 4,
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

    public function deletePsl(Request $request){
        $psl = CalonPsl::find($request-> idPsl);

        if (!$psl) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $psl->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function updateExperience(Request $request)
    {
        DB::beginTransaction();
        try {

            if($request->type == 'A'){
                $noPengenalan = $request->experienceA_no_pengenalan;
                $details = 'Kemaskini Pegawai Berkhidmat (Maklumat PSB/PSL A)';

                $request->validate([
                    'experience_job_sector' => 'required|string',
                    'experience_appoint_date' => 'required',
                    'experience_position_level' => 'required|string|exists:ruj_taraf_jawatan,kod',
                ],[
                    'experience_job_sector' => 'Sila pilih jenis perkhidmatan',
                    'experience_appoint_date.required' => 'Sila pilih tarikh lantikan pertama',
                    'experience_position_level.required' => 'Sila pilih taraf jawatan',
                    'experience_position_level.exists' => 'Tiada rekod taraf jawatan yang dipilih',
                ]);

                //Check if JENIS_PERKHIDMATAN kod from ruj_kod_pelbagai exists
                $existsJenisPerkhidmatan = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'JENIS PERKHIDMATAN')->where('kod', $request->experience_job_sector)->first();
                if(!$existsJenisPerkhidmatan){
                    return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => 'Tiada rekod jenis perkhidmatan yang dipilih'], 404);
                }
            } else if($request->type == 'B'){
                $noPengenalan = $request->experienceB_no_pengenalan;
                $details = 'Kemaskini Pegawai Berkhidmat (Maklumat PSB/PSL B)';

                $request->validate([
                    'experience_skim' => 'required|string|exists:ruj_skim,kod',
                    'experience_service_group' => 'required|string|exists:ruj_kumpulan_ssm,kod',
                    'experience_position_grade' => 'required|string|exists:ruj_gred_gaji_hdr,kod',
                    'experience_start_date' => 'required',
                    'experience_verify_date' => 'required',
                ],[
                    'experience_skim.required' => 'Sila pilih skim perkhidmatan',
                    'experience_skim.exists' => 'Tiada rekod skim perkhidmatan yang dipilih',
                    'experience_service_group.required' => 'Sila pilih kumpulan perkhidmatan',
                    'experience_service_group.exists' => 'Tiada rekod kumpulan perkhidmatan yang dipilih',
                    'experience_position_grade.required' => 'Sila pilih gred jawatan',
                    'experience_position_grade.exists' => 'Tiada rekod gred jawatan yang dipilih',
                    'experience_start_date.required' => 'Sila pilih tarikh lantikan',
                    'experience_verify_date.required' => 'Sila pilih tarikh pengesahan lantikan',
                ]);
            } else if($request->type == 'C') {
                $noPengenalan = $request->experienceC_no_pengenalan;
                $details = 'Kemaskini Pegawai Berkhidmat (Maklumat PSB/PSL C)';

                $request->validate([
                    'experience_department_ministry' => 'required|string|exists:ruj_kem_jabatan,kod',
                    'experience_department_state' => 'required|string|exists:ruj_negeri,kod',
                ],[
                    'experience_department_ministry.required' => 'Sila pilih kementerian/jabatan',
                    'experience_department_ministry.exists' => 'Tiada rekod kementerian/jabatan yang dipilih',
                    'experience_department_state.required' => 'Sila pilih negeri kementerian/jabatan',
                    'experience_department_state.exists' => 'Tiada rekod negeri kementerian/jabatan yang dipilih',
                ]);
            }

            $candidate = CalonPengalaman::where('cal_no_pengenalan', $noPengenalan)->first();

            $dataPengalaman = [];
            if(!$candidate){

                if($request->type == 'A'){
                    $dataPengalaman = [
                        'cal_no_pengenalan' => $noPengenalan,
                        'sektor_pekerjaan', $request->experience_job_sector,
                        'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->experience_appoint_date)->format('Y-m-d'),
                        'id_pencipta' => auth()->user()->id,
                        'pengguna' => auth()->user()->id,
                    ];
                } else if($request->type == 'B'){
                    $dataPengalaman = [
                        'cal_no_pengenalan' => $noPengenalan,
                        'ski_kod' => $request->experience_skim,
                        'kump_pkhidmat' => $request->experience_service_group,
                        'ggh_kod' => $request->experience_position_grade,
                        'tarikh_lantik1' => Carbon::createFromFormat('d/m/Y', $request->experience_start_date)->format('Y-m-d'),
                        'tarikh_disahkan' => Carbon::createFromFormat('d/m/Y', $request->experience_verify_date)->format('Y-m-d'),
                        'id_pencipta' => auth()->user()->id,
                        'pengguna' => auth()->user()->id,
                    ];
                } else if($request->type == 'C') {
                    $dataPengalaman = [
                        'cal_no_pengenalan' => $noPengenalan,
                        'kj_kod' => $request->experience_department_ministry,
                        //'negeri_jabatan' => $request->experience_department_state,
                        'neg_kod' => $request->experience_department_state,
                        'id_pencipta' => auth()->user()->id,
                        'pengguna' => auth()->user()->id,
                    ];
                }
                CalonPengalaman::create($dataPengalaman);
            } else {

                if($request->type == 'A'){
                    $dataPengalaman = [
                        'sektor_pekerjaan' => $request->experience_job_sector,
                        'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->experience_appoint_date)->format('Y-m-d'),
                        'taraf_jawatan' => $request->experience_position_level,
                        'pengguna' => auth()->user()->id,
                    ];
                } else if($request->type == 'B'){
                    $dataPengalaman = [
                        'ski_kod' => $request->experience_skim,
                        'kump_pkhidmat' => $request->experience_service_group,
                        'ggh_kod' => $request->experience_position_grade,
                        'tarikh_lantik1' => Carbon::createFromFormat('d/m/Y', $request->experience_start_date)->format('Y-m-d'),
                        'tarikh_disahkan' => Carbon::createFromFormat('d/m/Y', $request->experience_verify_date)->format('Y-m-d'),
                        'pengguna' => auth()->user()->id,
                    ];
                } else if($request->type == 'C') {
                    $dataPengalaman = [
                        'kj_kod' => $request->experience_department_ministry,
                        //'negeri_jabatan' => $request->experience_department_state,
                        'neg_kod' => $request->experience_department_state,
                        'pengguna' => auth()->user()->id,
                    ];
                }
                $candidate->update($dataPengalaman);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $noPengenalan,
                'details' => $details,
                'activity_type_id' => 4,
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

    public function experienceDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateExperience = CalonPengalaman::where('cal_no_pengenalan', $request->noPengenalan)->first();

            $candidateExperience->tarikh_lantik1 = ($candidateExperience->tarikh_lantik1 != null) ? Carbon::parse($candidateExperience->tarikh_lantik1)->format('d/m/Y') : null;
            $candidateExperience->tarikh_mula = ($candidateExperience->tarikh_mula != null) ? Carbon::parse($candidateExperience->tarikh_mula)->format('d/m/Y') : null;
            $candidateExperience->tarikh_disahkan = ($candidateExperience->tarikh_disahkan != null) ? Carbon::parse($candidateExperience->tarikh_disahkan)->format('d/m/Y') : null;
            $candidateExperience->tarikh_tamat = ($candidateExperience->tarikh_tamat != null) ? Carbon::parse($candidateExperience->tarikh_tamat)->format('d/m/Y') : null;

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateExperience]);

        } catch (\Throwable $e) {

            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateTenteraPolis(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = CalonTenteraPolis::where('no_pengenalan', $request->tentera_polis_no_pengenalan)->first();

            $request->validate([
                'jenis_perkhidmatan_tentera_polis' => 'required|string|exists:ruj_jenis_perkhidmatan,id',
                'pangkat_tentera_polis' => 'required|string|exists:ruj_pangkat,kod',
                'jenis_bekas_tentera_polis' => 'required|string|exists:ruj_jenis_bekas_tentera_polis,kod',
            ],[
                'jenis_perkhidmatan_tentera_polis.required' => 'Sila pilih jenis penamatan perkhidmatan',
                'jenis_perkhidmatan_tentera_polis.exists' => 'Tiada rekod jenis penamatan perkhidmatan yang dipilih',
                'pangkat_tentera_polis.required' => 'Sila pilih pangkat dalam tentera',
                'pangkat_tentera_polis.exists' => 'Tiada rekod pangkat dalam tentera yang dipilih',
                'jenis_bekas_tentera_polis.required' => 'Sila pilih kategori',
                'jenis_bekas_tentera_polis.exists' => 'Tiada rekod kategori yang dipilih',
            ]);

            if(!$candidate){
                CalonTenteraPolis::create([
                    'no_pengenalan' =>$request->tentera_polis_no_pengenalan,
                    'jenis_pkhidmat' => $request->jenis_perkhidmatan_tentera_polis,
                    'pangkat_tent_polis' => $request->pangkat_tentera_polis,
                    'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis,
                    'id_pencipta' => auth()->user()->id,
                    'pengguna' => auth()->user()->id,
                ]);
            } else {
                $candidate->update([
                    'jenis_pkhidmat' => $request->jenis_perkhidmatan_tentera_polis,
                    'pangkat_tent_polis' => $request->pangkat_tentera_polis,
                    'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis,
                    'pengguna' => auth()->user()->id,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->tentera_polis_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tambahan (Maklumat Bekas Tentera)',
                'activity_type_id' => 4,
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

    public function tenteraPolisDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateArmyPolice = CalonTenteraPolis::where('no_pengenalan', $request->noPengenalan)->first();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            // }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateArmyPolice]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function storePenalty(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'penalty_no_pengenalan' => 'required|string|exists:calon,no_pengenalan',
                'penalty' => 'required|string|exists:ruj_tatatertib,kod',
                'penalty_duration' => 'required|integer',
                'penalty_type' => 'required',
                'penalty_start' => 'required',
                'penalty_end' => 'required',
            ],[
                'penalty_no_pengenalan.required' => 'Sila isikan no kad pengenalan',
                'penalty_no_pengenalan.exists' => 'Rekod data no kad pengenalan tidak dijumpai',
                'penalty.required' => 'Sila pilih tindakan tatatertib',
                'penalty_duration.required' => 'Sila isikan tempoh hukuman',
                'penalty_type.required' => 'Sila isikan jenis tempoh hukuman',
                'penalty_start.required' => 'Sila isikan tarikh mula hukuman',
                'penalty_end.required' => 'Sila isikan tarikh akhir hukuman',
            ]);

            $candidatePenalty = CalonTatatertib::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'kod_ruj_penalti' => $request->penalty,
                'tempoh' => $request->penalty_duration,
                'jenis' => $request->penalty_type,
                'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->penalty_start)->format('Y-m-d'),
                'tarikh_tamat' => Carbon::createFromFormat('d/m/Y', $request->penalty_end)->format('Y-m-d'),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'details' => 'Tambah Tatatertib',
                'activity_type_id' => 3,
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

    public function listPenalty(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidatePenalty = CalonTatatertib::where('no_pengenalan', $request->noPengenalan)->with('penalty')->get();

            foreach($candidatePenalty as $penalty){
                $penalty->tarikh_mula = ($penalty->tarikh_mula != null) ? Carbon::parse($penalty->tarikh_mula)->format('d/m/Y') : null;
                $penalty->tarikh_tamat = ($penalty->tarikh_tamat != null) ? Carbon::parse($penalty->tarikh_tamat)->format('d/m/Y') : null;
            }

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePenalty]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePenalty(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'penalty_no_pengenalan' => 'required|string',
                'penalty' => 'required|string',
                'penalty_duration' => 'required|integer',
                'penalty_type' => 'required',
                'penalty_start' => 'required',
                'penalty_end' => 'required',
            ],[
                'penalty_no_pengenalan.required' => 'Sila isikan no kad pengenalan',
                'penalty.required' => 'Sila pilih tindakan tatatertib',
                'penalty_duration.required' => 'Sila isikan tempoh hukuman',
                'penalty_type.required' => 'Sila isikan jenis tempoh hukuman',
                'penalty_start.required' => 'Sila isikan tarikh mula hukuman',
                'penalty_end.required' => 'Sila isikan tarikh akhir hukuman',
            ]);

            CalonTatatertib::where('id',$request->id_penalty)->update([
                'kod_ruj_penalti' => $request->penalty,
                'tempoh' => $request->penalty_duration,
                'jenis' => $request->penalty_type,
                'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->penalty_start)->format('Y-m-d'),
                'tarikh_tamat' => Carbon::createFromFormat('d/m/Y', $request->penalty_end)->format('Y-m-d'),
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tatatertib',
                'activity_type_id' => 4,
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

    public function deletePenalty(Request $request){
        $penalty = CalonTatatertib::find($request-> idPenalty);

        if (!$penalty) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $penalty->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function calculatePenalty(Request $request)
    {
        $duration = $request->duration;
        $type = $request->type;
        $start = $request->start;

        if($type == 'Tahun'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addYears($duration)->format('d/m/Y');
        } else if($type == 'Bulan'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addMonths($duration)->format('d/m/Y');
        } else if($type == 'Hari'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addDays($duration)->format('d/m/Y');
        }

        //$end = $type;
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $end]);
    }

}
