<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PemohonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Calon\Calon;
use App\Models\Calon\CalonLesen;
use App\Models\Calon\CalonOku;
use App\Models\Calon\CalonSkim;
use App\Models\Calon\CalonKeputusanSekolah;
use App\Models\Calon\CalonStpmPngk;
use App\Models\Calon\CalonSpmUlangan;
use App\Models\Calon\CalonSvm;
use App\Models\Calon\CalonSkm;
use App\Models\Calon\CalonMatrikulasi;
use App\Models\Calon\CalonPengajianTinggi;
use App\Models\Calon\CalonProfesional;
use App\Models\Calon\CalonPengalaman;
use App\Models\Calon\CalonPsl;
use App\Models\Calon\CalonTenteraPolis;
use App\Models\Calon\CalonBahasa;
use App\Models\Calon\CalonBakat;
use Carbon;

class PemohonController extends ApiController
{
    public function store(PemohonRequest $request)
    {
        $request->validated();

        $noPengenalan = $request->no_kp;

        if($request->jantina == 'L' || $request->jantina == '1'){
            $jantina = '1';
        } else if($request->jantina == 'P' || $request->jantina == '2'){
            $jantina = '2';
        } else {
            $jantina = null;
        }

        $agama = str_replace('0', '', $request->agama);

        $tempatLahir = $this->getKodNegeri($request->tempat_lahir);
        $tempatLahirBapa = $this->getKodNegeri($request->tempat_lahir_bapa);
        $tempatLahirIbu = $this->getKodNegeri($request->tempat_lahir_ibu);

        $jenisLesen = null;
        if(isset($request->jenis_lesen) || $request->jenis_lesen != null){
            $jenisLesen = str_replace('CDL - ', '', $request->jenis_lesen);
        }

        try {
            DB::beginTransaction();
            //Validate emel and no_tel
            $checkCalon = Calon::where('no_kp_baru', $request->no_kp)->first();

            if($checkCalon){
                $checkCalon->update([
                    'nama_penuh' => $request->nama_penuh,
                    // 'no_kp_baru' => $request->no_kp,
                    'e_mel' => $request->emel,
                    'no_tel' => $request->no_tel,
                    'tarikh_lahir' => $request->tarikh_lahir,
                    'jan_kod' => $jantina,
                    'agama' => $agama,
                    'ket_kod' => $request->keturunan,
                    'taraf_perkahwinan' => $request->status_kahwin,
                    'kewarganegaraan' => 1,
                    'tempat_lahir' => $tempatLahir,
                    'tempat_lahir_bapa' => $tempatLahirBapa,
                    'tempat_lahir_ibu' => $tempatLahirIbu,
                    'alamat_1_tetap' => $request->alamat1_tetap,
                    'alamat_2_tetap' => $request->alamat2_tetap,
                    'alamat_3_tetap' => $request->alamat3_tetap,
                    'poskod_tetap' => $request->poskod_tetap,
                    'bandar_tetap' => $request->bandar_tetap,
                    'negeri_tetap' => $request->negeri_tetap,
                    'alamat_1' => $request->alamat1_surat,
                    'alamat_2' => $request->alamat2_surat,
                    'alamat_3' => $request->alamat3_surat,
                    'poskod' => $request->poskod_surat,
                    'bandar' => $request->bandar_surat,
                    'negeri' => $request->negeri_surat,
                    'ketinggian' => $request->tinggi,
                    'berat' => $request->berat,
                    'pusat_temuduga' => $request->pusat_temuduga,
                ]);
            } else {
                $calon = Calon::create([
                    'nama_penuh' => $request->nama_penuh,
                    'no_pengenalan' => $noPengenalan,
                    'no_kp_baru' => $request->no_kp,
                    'e_mel' => $request->emel,
                    'no_tel' => $request->no_tel,
                    'tarikh_lahir' => $request->tarikh_lahir,
                    'jan_kod' => $jantina,
                    'agama' => $agama,
                    'ket_kod' => $request->keturunan,
                    'taraf_perkahwinan' => $request->status_kahwin,
                    'kewarganegaraan' => 1,
                    'tempat_lahir' => $tempatLahir,
                    'tempat_lahir_bapa' => $tempatLahirBapa,
                    'tempat_lahir_ibu' => $tempatLahirIbu,
                    'alamat_1_tetap' => $request->alamat1_tetap,
                    'alamat_2_tetap' => $request->alamat2_tetap,
                    'alamat_3_tetap' => $request->alamat3_tetap,
                    'poskod_tetap' => $request->poskod_tetap,
                    'bandar_tetap' => $request->bandar_tetap,
                    'negeri_tetap' => $request->negeri_tetap,
                    'alamat_1' => $request->alamat1_surat,
                    'alamat_2' => $request->alamat2_surat,
                    'alamat_3' => $request->alamat3_surat,
                    'poskod' => $request->poskod_surat,
                    'bandar' => $request->bandar_surat,
                    'negeri' => $request->negeri_surat,
                    'ketinggian' => $request->tinggi,
                    'berat' => $request->berat,
                    'pusat_temuduga' => $request->pusat_temuduga,
                ]);
            }


            if($jenisLesen != null){
                $lesen = CalonLesen::where('cal_no_pengenalan', $noPengenalan)->first();
                if($lesen){
                    $lesen->update([
                        'jenis_lesen' => $jenisLesen,
                        'tempoh_tamat' => $request->tempoh_tamat_lesen,
                        'status_senaraihitam' => $request->status_senaraihitam_lesen,
                        'msg_senaraihitam' => ($request->status_senaraihitam_lesen == true) ? $request->msg_senaraihitam_lesen : null,
                    ]);
                } else {
                    CalonLesen::create([
                        'cal_no_pengenalan' => $noPengenalan,
                        'jenis_lesen' => $jenisLesen,
                        'tempoh_tamat' => $request->tempoh_tamat_lesen,
                        'status_senaraihitam' => $request->status_senaraihitam_lesen,
                        'msg_senaraihitam' => ($request->status_senaraihitam_lesen == true) ? $request->msg_senaraihitam_lesen : null,
                    ]);
                }
            }

            if($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null){
                $oku = CalonOku::where('no_pengenalan', $noPengenalan)->first();
                if($oku){
                    $oku->update([
                        'kecacatan_calon' => ($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null) ? 'O' : null,
                        'no_daftar_jkm' => $request->no_daftar_rujukan_oku,
                        'kategori_oku' => $request->jenis_bantuan_oku,
                        'sub_oku' => $request->sub_kategori_oku,
                        'status_oku' => $request->status_oku,
                    ]);
                } else {
                    CalonOku::create([
                        'no_pengenalan' => $noPengenalan,
                        'kecacatan_calon' => ($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null) ? 'O' : null,
                        'no_daftar_jkm' => $request->no_daftar_rujukan_oku,
                        'kategori_oku' => $request->jenis_bantuan_oku,
                        'sub_oku' => $request->sub_kategori_oku,
                        'status_oku' => $request->status_oku,
                    ]);
                }
            }

            if($request->skim != null){
                foreach($request->skim as $skim) {

                    $calonSkim = CalonSkim::where('cal_no_pengenalan', $noPengenalan)->where('ski_kod', $skim['skim'])->first();

                    if($calonSkim){
                        $dataSkim = [
                            'tarikh_daftar' => $skim['tarikh_daftar'],
                            'no_kelompok' => $skim['no_kelompok'],
                            'no_siri' => $skim['no_siri'],
                            'pusat_td_pilihan' => $request->pusat_temuduga,
                        ];

                        $calonSkim->update($dataSkim);
                    } else {
                        $dataSkim = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'tarikh_daftar' => $skim['tarikh_daftar'],
                            'ski_kod' => $skim['skim'],
                            'no_kelompok' => $skim['no_kelompok'],
                            'no_siri' => $skim['no_siri'],
                            'pusat_td_pilihan' => $request->pusat_temuduga,
                        ];
                        CalonSkim::create($dataSkim);
                    }
                }
            }

            if($request->daftar_calon != null){
                //Kalau ada relationship between calon and calon daftar tmbh logic mcm calon skim
                foreach($request->daftar_calon as $daftar) {

                    $calonDaftar = DB::table('calon_daftar')->where('no_pengenalan', $noPengenalan)->where('skim', $daftar['skim'])->first();

                    if($calonDaftar){
                        $dataDaftar = [
                            'tarikh_daftar' => $daftar['tarikh_daftar'],
                            'tarikh_daftar_1' => $daftar['tarikh_daftar'],
                            'j_daftar' => '03',
                            'keutamaan' => $daftar['keutamaan'],
                            'status_akuan' => '1',
                        ];
                        DB::table('calon_daftar')->where('no_pengenalan', $noPengenalan)->where('skim', $daftar['skim'])->update($dataDaftar);
                    } else {
                        $dataDaftar = [
                            'no_pengenalan' => $noPengenalan,
                            'skim' => $daftar['skim'],
                            'tarikh_daftar' => $daftar['tarikh_daftar'],
                            'tarikh_daftar_1' => $daftar['tarikh_daftar'],
                            'j_daftar' => '03',
                            'keutamaan' => $daftar['keutamaan'],
                            'status_akuan' => '1',
                        ];
                        DB::table('calon_daftar')->insert($dataDaftar);
                    }
                }
            }

            //Validate kod matapelajaran utk setiap tingkatan

            if($request->tingkatan_3 != null){
                foreach($request->tingkatan_3 as $tkt3){
                    if($tkt3['jenis_sijil'] == 'PMR' || $tkt3['jenis_sijil'] == '1'){
                        $sijilTkt3 = 1;
                    } else if($tkt3['jenis_sijil'] == 'SRP' || $tkt3['jenis_sijil'] == '2') {
                        $sijilTkt3 = 2;
                    } else if($tkt3['jenis_sijil'] == 'LCE' || $tkt3['jenis_sijil'] == '3') {
                        $sijilTkt3 = 3;
                    } else if($tkt3['jenis_sijil'] == 'LAIN-LAIN' || $tkt3['jenis_sijil'] == '4') {
                        $sijilTkt3 = 4;
                    } else {
                        $sijilTkt3 = null;
                    }

                    $calonTkt3 = CalonKeputusanSekolah::where('cal_no_pengenalan', $noPengenalan)
                    ->where('jenis_sijil', $sijilTkt3)
                    ->where('tahun', $tkt3['tahun'])
                    ->where('mpel_tkt', 3)
                    ->where('mpel_kod', $tkt3['mata_pelajaran'])->first();

                    if($calonTkt3){
                        $dataTkt3 = [
                            'kep_terbuka' => $tkt3['keputusan_terbuka'],
                            'gred' => $tkt3['gred'],
                        ];
                        $calonTkt3->update($dataTkt3);
                    } else {
                        $dataTkt3 = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'jenis_sijil' => $sijilTkt3,
                            'kep_terbuka' => $tkt3['keputusan_terbuka'],
                            'tahun' => $tkt3['tahun'],
                            'mpel_tkt' => '3',
                            'mpel_kod' => $tkt3['mata_pelajaran'],
                            'gred' => $tkt3['gred'],
                        ];
                        CalonKeputusanSekolah::create($dataTkt3);
                    }
                }
            }

            if($request->tingkatan_5 != null){
                foreach($request->tingkatan_5 as $tkt5){

                    $calonTkt5 = CalonKeputusanSekolah::where('cal_no_pengenalan', $noPengenalan)
                    ->where('jenis_sijil', $tkt5['jenis_sijil'])
                    ->where('tahun', $tkt5['tahun'])
                    ->where('mpel_tkt', 5)
                    ->where('mpel_kod', $tkt5['mata_pelajaran'])->first();

                    if($calonTkt5){
                        $dataTkt5 = [
                            'kep_terbuka' => $tkt5['keputusan_terbuka'],
                            'gred' => $tkt5['gred'],
                        ];
                        $calonTkt5->update($dataTkt5);
                    } else {
                        $dataTkt5 = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'jenis_sijil' => $tkt5['jenis_sijil'],
                            'kep_terbuka' => $tkt5['keputusan_terbuka'],
                            'tahun' => $tkt5['tahun'],
                            'mpel_tkt' => '5',
                            'mpel_kod' => $tkt5['mata_pelajaran'],
                            'gred' => $tkt5['gred'],
                        ];
                        CalonKeputusanSekolah::create($dataTkt5);
                    }
                }
            }

            if(
                $request->spmu_angka_giliran_1 != null ||
                $request->spmu_keputusan_1 != null ||
                $request->spmu_mata_pelajaran_1 != null ||
                $request->spmu_tahun_1 != null ||
                $request->spmu_angka_giliran_2 ||
                $request->spmu_keputusan_2 != null ||
                $request->spmu_mata_pelajaran_2 != null ||
                $request->spmu_tahun_2 != null 
            ){
                $calonSpmu = CalonSpmUlangan::where('no_pengenalan', $noPengenalan)->first();

                if($calonSpmu){
                    $calonSpmu->update([
                        'angka_giliran_1' => $request->spmu_angka_giliran_1,
                        'keputusan_1' => $request->spmu_keputusan_1,
                        'mata_pelajaran_1' => $request->spmu_mata_pelajaran_1,
                        'tahun_1' => $request->spmu_tahun_1,
                        'angka_giliran_2' => $request->spmu_angka_giliran_2,
                        'keputusan_2' => $request->spmu_keputusan_2,
                        'mata_pelajaran_2' => $request->spmu_mata_pelajaran_2,
                        'tahun_2' => $request->spmu_tahun_2,
                    ]);
                } else {
                    CalonSpmUlangan::create([
                        'no_pengenalan' => $noPengenalan,
                        'angka_giliran_1' => $request->spmu_angka_giliran_1,
                        'keputusan_1' => $request->spmu_keputusan_1,
                        'mata_pelajaran_1' => $request->spmu_mata_pelajaran_1,
                        'tahun_1' => $request->spmu_tahun_1,
                        'angka_giliran_2' => $request->spmu_angka_giliran_2,
                        'keputusan_2' => $request->spmu_keputusan_2,
                        'mata_pelajaran_2' => $request->spmu_mata_pelajaran_2,
                        'tahun_2' => $request->spmu_tahun_2,
                    ]);
                }
            }

            if($request->tingkatan_6 != null){
                foreach($request->tingkatan_6 as $tkt6){

                    $calonTkt6 = CalonKeputusanSekolah::where('cal_no_pengenalan', $noPengenalan)
                    ->where('jenis_sijil', $tkt6['jenis_sijil'])
                    ->where('tahun', $tkt6['tahun'])
                    ->where('mpel_tkt', 6)
                    ->where('mpel_kod', $tkt6['mata_pelajaran'])->first();

                    if($calonTkt6){
                        $dataTkt6 = [
                            'kep_terbuka' => $tkt6['keputusan_terbuka'],
                            'gred' => $tkt6['gred'],
                        ];
                        $calonTkt6->update($dataTkt6);
                    } else {
                        $dataTkt6 = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'jenis_sijil' => $tkt6['jenis_sijil'],
                            'kep_terbuka' => $tkt6['keputusan_terbuka'],
                            'tahun' => $tkt6['tahun'],
                            'mpel_tkt' => '6',
                            'mpel_kod' => $tkt6['mata_pelajaran'],
                            'gred' => $tkt6['gred'],
                        ];
                        CalonKeputusanSekolah::create($dataTkt6);
                    }
                }
            }

            if($request->tingkatan_6_pngk != null){
                foreach($request->tingkatan_6_pngk as $tkt6pngk){
                    $pngkTkt6 = CalonStpmPngk::where('no_pengenalan', $noPengenalan)
                    ->where('tahun', $tkt6pngk['tahun'])->first();

                    if($pngkTkt6){
                        $dataPngkTkt6 = [
                            'pngk' => $tkt6pngk['pngk'],
                        ];
                        $pngkTkt6->update($dataPngkTkt6);
                    } else {
                        $dataPngkTkt6 = [
                            'no_pengenalan' => $noPengenalan,
                            'tahun' => $tkt6pngk['tahun'],
                            'pngk' => $tkt6pngk['pngk'],
                        ];
                        CalonStpmPngk::create($dataPngkTkt6);
                    }
                }
            }

            if($request->svm != null){
                foreach($request->svm as $svm){

                    $calonSvm = CalonSvm::where('cal_no_pengenalan', $noPengenalan)
                    ->where('kel1_kod', $svm['kelulusan'])
                    ->where('tahun_lulus', $svm['tahun_lulus'])
                    ->where('mata_pelajaran', $svm['mata_pelajaran'])->first();

                    if($calonSvm){
                        $dataSvm = [
                            'pngka' => $svm['pngka'],
                            'pngkv' => $svm['pngkv'],
                            'gred' => $svm['gred']
                        ];
                        $calonSvm->update($dataSvm);
                    } else {
                        $dataSvm = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'kel1_kod' => $svm['kelulusan'],
                            'tahun_lulus' => $svm['tahun_lulus'],
                            'pngka' => $svm['pngka'],
                            'pngkv' => $svm['pngkv'],
                            'mata_pelajaran' => $svm['mata_pelajaran'],
                            'gred' => $svm['gred']
                        ];
                        $insertSvm = CalonSvm::create($dataSvm);
                    }
                }
            }

            if($request->skm != null){
                foreach($request->skm as $skm){

                    $calonSkm = CalonSkm::where('cal_no_pengenalan', $noPengenalan)
                    ->where('kel1_kod', $skm['kelulusan'])->first();

                    if($calonSkm){
                        $calonSkm->update([
                            'tahun_lulus' => $skm['tahun_lulus'],
                        ]);
                    } else {
                        $dataSkm = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'kel1_kod' => $skm['kelulusan'],
                            'tahun_lulus' => $skm['tahun_lulus'],
                        ];
                        CalonSkm::create($dataSkm);
                    }
                }
            }

            if($request->matrikulasi != null){
                foreach($request->matrikulasi as $matrik){

                    $calonMatrik = CalonMatrikulasi::where('cal_no_pengenalan', $noPengenalan)
                    ->where('jurusan', $matrik['jurusan'])
                    ->where('kolej', $matrik['kolej'])
                    ->where('kod_subjek', $matrik['subjek'])->first();

                    if($calonMatrik){
                        $dataMatrik = [
                            'no_matrik' => $matrik['no_matrik'],
                            'sesi' => $matrik['sesi'],
                            'semester' => $matrik['semester'],
                            'gred' => $matrik['gred'],
                            'pngk' => $matrik['pngk'],
                        ];
                        $calonMatrik->update($dataMatrik);
                    } else {
                        $dataMatrik = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'no_matrik' => $matrik['no_matrik'],
                            'jurusan' => $matrik['jurusan'],
                            'sesi' => $matrik['sesi'],
                            'semester' => $matrik['semester'],
                            'kolej' => $matrik['kolej'],
                            'kod_subjek' => $matrik['subjek'],
                            'gred' => $matrik['gred'],
                            'pngk' => $matrik['pngk'],
                        ];
                        CalonMatrikulasi::create($dataMatrik);
                    }
                }
            }

            if($request->pengajian_tinggi != null){
                foreach($request->pengajian_tinggi as $pengajian){

                    $calonPengajian = CalonPengajianTinggi::where('cal_no_pengenalan', $noPengenalan)
                    ->where('ins_kod', $pengajian['institusi'])
                    ->where('kel_kod', $pengajian['kelayakan'])
                    ->where('pen_kod', $pengajian['pengkhususan'])->first();

                    if($calonPengajian){
                        $dataPengajian = [
                            'cgpa' => $pengajian['cgpa'],
                            'ins_fln' => $pengajian['institusi_francais'],
                            'nama_sijil' => $pengajian['nama_sijil'],
                            'tarikh_senat' => $pengajian['tarikh_senat'],
                            'peringkat_pengajian' => $pengajian['peringkat'],
                            'biasiswa' => $pengajian['biasiswa'],
                        ];
                        $calonPengajian->update($dataPengajian);
                    } else {
                        $dataPengajian = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'ins_kod' => $pengajian['institusi'],
                            'kel_kod' => $pengajian['kelayakan'],
                            'pen_kod' => $pengajian['pengkhususan'],
                            'tahun_lulus' => $pengajian['tahun'],
                            'cgpa' => $pengajian['cgpa'],
                            'ins_fln' => $pengajian['institusi_francais'],
                            'nama_sijil' => $pengajian['nama_sijil'],
                            'tarikh_senat' => $pengajian['tarikh_senat'],
                            'peringkat_pengajian' => $pengajian['peringkat'],
                            'biasiswa' => $pengajian['biasiswa'],
                        ];
                        CalonPengajianTinggi::create($dataPengajian);
                    }
                }
            }

            if($request->profesional != null){
                foreach($request->profesional as $profesional){

                    $calonProfesional = CalonProfesional::where('cal_no_pengenalan', $noPengenalan)
                    ->where('kel1_kod', $profesional['kelulusan'])->first();

                    if($calonProfesional){
                        $calonProfesional->update([
                            'no_ahli' => $profesional['no_ahli'],
                            'tarikh' => $profesional['tarikh']
                        ]);
                    } else {
                        $dataProfesional = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'kel1_kod' => $profesional['kelulusan'],
                            'no_ahli' => $profesional['no_ahli'],
                            'tarikh' => $profesional['tarikh']
                        ];
                        CalonProfesional::create($dataProfesional);
                    }
                }
            }

            if($request->pengalaman_skim != null){
                $calonPengalaman = CalonPengalaman::where('cal_no_pengenalan', $noPengenalan)->first();

                if($calonPengalaman){
                    $calonPengalaman->update([
                        'sektor_pekerjaan' => $request->pengalaman_jenis_perkhidmatan,
                        'taraf_jawatan' => $request->pengalaman_jenis_lantikan,
                        'tarikh_lantik1' => $request->pengalaman_tarikh_lantikan,
                        'tarikh_mula' => $request->pengalaman_tarikh_lantikan_pertama,
                        'tarikh_disahkan' => $request->pengalaman_tarikh_sah,
                        'ski_kod' => $request->pengalaman_skim,
                        'ggh_kod' => $request->pengalaman_gred_gaji,
                        'kj_kod' => $request->pengalaman_kementerian,
                        'negeri_jabatan' => $request->pengalaman_negeri_bertugas,
                        'neg_kod' => $request->pengalaman_negeri_bertugas,
                        'daerah_bertugas' => $request->pengalaman_daerah_bertugas,
                        'tarikh_tamat_kontrak' => $request->pengalaman_tarikh_tamat_kontrak,
                        'kump_pkhidmat' => $request->pengalaman_kumpulan_pkhidmat,
                    ]);
                } else {
                    $pengalaman = CalonPengalaman::create([
                        'cal_no_pengenalan' => $noPengenalan,
                        'sektor_pekerjaan' => $request->pengalaman_jenis_perkhidmatan,
                        'taraf_jawatan' => $request->pengalaman_jenis_lantikan,
                        'tarikh_lantik1' => $request->pengalaman_tarikh_lantikan,
                        'tarikh_mula' => $request->pengalaman_tarikh_lantikan_pertama,
                        'tarikh_disahkan' => $request->pengalaman_tarikh_sah,
                        'ski_kod' => $request->pengalaman_skim,
                        'ggh_kod' => $request->pengalaman_gred_gaji,
                        'kj_kod' => $request->pengalaman_kementerian,
                        'negeri_jabatan' => $request->pengalaman_negeri_bertugas,
                        'neg_kod' => $request->pengalaman_negeri_bertugas,
                        'daerah_bertugas' => $request->pengalaman_daerah_bertugas,
                        'tarikh_tamat_kontrak' => $request->pengalaman_tarikh_tamat_kontrak,
                        'kump_pkhidmat' => $request->pengalaman_kumpulan_pkhidmat,
                    ]);
                }
            }

            if($request->psl != null){
                foreach($request->psl as $psl){

                    $calonPsl = CalonPsl::where('cal_no_pengenalan', $noPengenalan)
                    ->where('kel1_kod', $psl['kelulusan'])->first();

                    if($calonPsl){
                        $calonPsl->update([
                            'tarikh_exam' => $psl['tarikh_exam'],
                        ]);
                    } else {
                        $dataPsl = [
                            'cal_no_pengenalan' => $noPengenalan,
                            'kel1_kod' => $psl['kelulusan'],
                            'tarikh_exam' => $psl['tarikh_exam'],
                        ];
                        CalonPsl::create($dataPsl);
                    }
                }
            }

            if($request->kategori_tentera_polis != null || $request->pangkat_tentera_polis != null){

                $calonTenteraPolis = CalonTenteraPolis::where('no_pengenalan', $noPengenalan)->first();

                if($calonTenteraPolis){
                    $calonTenteraPolis->update([
                        'status_pkhidmat' => $request->kategori_tentera_polis,
                        'pangkat_tent_polis' => $request->pangkat_tentera_polis,
                        'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis
                    ]);
                } else {
                    $tenteraPolis = CalonTenteraPolis::create([
                        'no_pengenalan' => $noPengenalan,
                        'status_pkhidmat' => $request->kategori_tentera_polis,
                        'pangkat_tent_polis' => $request->pangkat_tentera_polis,
                        'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis
                    ]);
                }
            }

            if($request->bahasa != null){
                foreach($request->bahasa as $bahasa){

                    $calonBahasa = CalonBahasa::where('no_pengenalan', $noPengenalan)
                    ->where('jenis_bahasa', $bahasa['bahasa'])->first();

                    if($calonBahasa){
                        $calonBahasa->update([
                         'penguasaan' => $bahasa['penguasaan']
                        ]);
                    } else {
                        $dataBahasa = [
                            'no_pengenalan' => $noPengenalan,
                            'jenis_bahasa' => $bahasa['bahasa'],
                            'penguasaan' => $bahasa['penguasaan']
                        ];
                        CalonBahasa::create($dataBahasa);
                    }
                }
            }

            if($request->bakat != null){
                foreach($request->bakat as $bakat){

                    $calonBakat = CalonBakat::where('no_pengenalan', $noPengenalan)
                    ->where('bakat', $bakat['bakat'])->first();

                    if($calonBakat){
                        $calonBakat->update([
                            'bakat_detail' => $bakat['bakat_detail']
                        ]);
                    } else {
                        $dataBakat = [
                            'no_pengenalan' => $noPengenalan,
                            'bakat' => $bakat['bakat'],
                            'bakat_detail' => $bakat['bakat_detail']
                        ];
                        CalonBakat::create($dataBakat);
                    }
                }
            }

            DB::commit();
            $response = config('status.status_codes.success');
        } catch (Exception $e) {
        //} catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Store Pemohon API Error: ' . $e);

            $response = config('status.status_codes.internal_server_error');
        }

        if($response == config('status.status_codes.internal_server_error')){
            return $this->errorResponseFormat(
                config('status.status_codes.internal_server_error'),
                'Internal server error!',
                [],
                config('status.http_codes.internal_server_error')
            );
        }

        return $this->successResponseFormat(
            $response,
            'Data berjaya disimpan.',
            []
        );
    }

    private static function getKodNegeri($kod){

        if($kod == '01' || $kod == '21' || $kod == '22' || $kod == '23' || $kod == '24') {
            $kodNegeri = '01';
        } else if($kod == '02' || $kod == '25' || $kod == '26' || $kod == '27') {
            $kodNegeri = '02';
        } else if($kod == '03' || $kod == '28' || $kod == '29') {
            $kodNegeri = '03';
        } else if($kod == '04' || $kod == '30') {
            $kodNegeri = '04';
        } else if($kod == '05' || $kod == '31' || $kod == '59') {
            $kodNegeri = '05';
        } else if($kod == '06' || $kod == '32' || $kod == '33') {
            $kodNegeri = '06';
        } else if($kod == '07' || $kod == '34' || $kod == '35') {
            $kodNegeri = '07';
        } else if($kod == '08' || $kod == '36' || $kod == '37' || $kod == '38' || $kod == '39') {
            $kodNegeri = '08';
        } else if($kod == '09' || $kod == '40') {
            $kodNegeri = '09';
        } else if($kod == '10' || $kod == '41' || $kod == '42' || $kod == '43' || $kod == '44') {
            $kodNegeri = '10';
        } else if($kod == '11' || $kod == '45' || $kod == '46') {
            $kodNegeri = '11';
        } else if($kod == '12' || $kod == '47' || $kod == '48' || $kod == '49') {
            $kodNegeri = '12';
        } else if($kod == '13' || $kod == '50' || $kod == '51' || $kod == '52' || $kod == '53') {
            $kodNegeri = '13';
        } else if($kod == '14' || $kod == '54' || $kod == '55' || $kod == '56' || $kod == '57') {
            $kodNegeri = '14';
        } else if($kod == '15' || $kod == '58') {
            $kodNegeri = '15';
        } else if($kod == '82') {
            $kodNegeri = '82';
        } else if($kod == '99') {
            $kodNegeri = '99';
        } else {
            $kodNegeri = '99';
        }

        return $kodNegeri;
    }
}
