<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-diploma-info" role="tab" id="academic-diploma-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    1
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Diploma
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_dip" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-degree-info" role="tab" id="academic-degree-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    2
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Ijazah Sarjana Muda
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_ism" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-master-info" role="tab" id="academic-master-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    3
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Ijazah Sarjana
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_is" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-phd-info" role="tab" id="academic-phd-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    4
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Ijazah Doktor Falsafah
                    </span>

                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1" id="tm_idf" hidden>Tiada Maklumat</span>
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- Diploma --}}
        <div id="academic-diploma-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-diploma-info-trigger">
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-diploma-1" aria-expanded="false" aria-controls="result-diploma-1">
                <span class="badge badge-light-primary">
                    Diploma [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-diploma-1">
                <div id="update_diploma" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editDiploma()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form
                id="diplomaForm"
                action="{{ route('diploma.update') }}"
                method="POST"
                data-refreshFunctionName="reloadTimeline"
                data-refreshFunctionNameIfSuccess="reloadDiploma"
                data-reloadPage="false">
                    @csrf
                    <input type="hidden" id="diploma_no_pengenalan" name="diploma_no_pengenalan">
                    <div class="row">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Peringkat Kelulusan</label>
                            <select class="select2 form-control" name="kelayakan_diploma" id="kelayakan_diploma" disabled>
                                <option value="" hidden>Peringkat Kelulusan</option>
                                @foreach($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->kod }}">{{ $eligibility->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" name="tahun_diploma" id="tahun_diploma" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">CGPA</label>
                            <input type="text" class="form-control" value="" name="cgpa_diploma" id="cgpa_diploma" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Institusi</label>
                            <select class="select2 form-control" name="institusi_diploma" id="institusi_diploma" disabled>
                                <option value="" hidden>Institusi</option>
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->kod }}">{{ $institution->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <input type="text" class="form-control" value="" name="nama_sijil_diploma" id="nama_sijil_diploma" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Pengkhususan/ Bidang</label>
                            <select class="select2 form-control" name="pengkhususan_diploma" id="pengkhususan_diploma" disabled>
                                <option value="" hidden>Pengkhususan/ Bidang</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Francais Luar Negara</label>
                            <select class="select2 form-control" name="fln_diploma" id="fln_diploma" disabled>
                                <option value="" hidden>Francais Luar Negara</option>
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tarikh Senat</label>
                            <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_diploma" id="tarikh_senat_diploma" disabled>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Biasiswa</label>
                            <select class="select2 form-control" name="biasiswa_diploma" id="biasiswa_diploma" disabled>
                                <option value="" hidden>Biasiswa</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>

                    <div id="button_action_diploma" style="display:none">
                        <button type="button" id="btnEditDiploma" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditDiploma',
                                {
                                    peringkat_diploma: $('#peringkat_diploma').find(':selected').text(),
                                    tahun_diploma: $('#tahun_diploma').val(),
                                    kelayakan_diploma: $('#kelayakan_diploma').find(':selected').text(),
                                    cgpa_diploma: $('#cgpa_diploma').val(),
                                    institusi_diploma: $('#institusi_diploma').find(':selected').text(),
                                    nama_sijil_diploma: $('#nama_sijil_diploma').val(),
                                    pengkhususan_diploma: $('#pengkhususan_diploma').find(':selected').text(),
                                    fln_diploma: $('#fln_diploma').find(':selected').text(),
                                    tarikh_senat_diploma: $('#tarikh_senat_diploma').val(),
                                    biasiswa_diploma: $('#biasiswa_diploma').find(':selected').text(),
                                },
                                {
                                    peringkat_diploma: 'Peringkat Pengajian',
                                    tahun_diploma: 'Tahun Pengajian',
                                    kelayakan_diploma: 'Peringkat Kelulusan',
                                    cgpa_diploma: 'CGPA',
                                    institusi_diploma: 'Institusi',
                                    nama_sijil_diploma: 'Nama Sijil',
                                    pengkhususan_diploma: 'Pengkhususan/Bidang',
                                    fln_diploma: 'Francais Luar Negara',
                                    tarikh_senat_diploma: 'Tarikh Senat',
                                    biasiswa_diploma: 'Biasiswa',
                                }
                                );">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Degree --}}
        <div id="academic-degree-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-degree-info-trigger">
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-degree-1" aria-expanded="false" aria-controls="result-degree-1">
                <span class="badge badge-light-primary">
                    Ijazah Sarjana Muda [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-degree-1">
                <div id="update_degree" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editDegree()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form
                    id="degreeForm"
                    action="{{ route('degree.update') }}"
                    method="POST"
                    data-refreshFunctionName="reloadTimeline"
                    data-refreshFunctionNameIfSuccess="reloadDegree"
                    data-reloadPage="false">
                    @csrf
                    <input type="hidden" id="degree_no_pengenalan" name="degree_no_pengenalan">
                    <div class="row">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Peringkat Kelulusan</label>
                            <select class="select2 form-control" name="kelayakan_degree" id="kelayakan_degree" disabled>
                                <option value="" hidden>Peringkat Kelulusan</option>
                                @foreach($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->kod }}">{{ $eligibility->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" name="tahun_degree" id="tahun_degree" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">CGPA</label>
                            <input type="text" class="form-control" value="" name="cgpa_degree" id="cgpa_degree" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Institusi</label>
                            <select class="select2 form-control" name="institusi_degree" id="institusi_degree" disabled>
                                <option value="" hidden>Institusi</option>
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->kod }}">{{ $institution->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <input type="text" class="form-control" value="" name="nama_sijil_degree" id="nama_sijil_degree" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Pengkhususan/ Bidang</label>
                            <select class="select2 form-control" name="pengkhususan_degree" id="pengkhususan_degree" disabled>
                                <option value="" hidden>Pengkhususan/ Bidang</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Francais Luar Negara</label>
                            <select class="select2 form-control" name="fln_degree" id="fln_degree" disabled>
                                <option value="" hidden>Francais Luar Negara</option>
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tarikh Senat</label>
                            <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_degree" id="tarikh_senat_degree" disabled>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Biasiswa</label>
                            <select class="select2 form-control" name="biasiswa_degree" id="biasiswa_degree" disabled>
                                <option value="" hidden>Biasiswa</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>

                    <div id="button_action_degree" style="display:none">
                        <button type="button" id="btnEditDegree" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditDegree',
                                {
                                    peringkat_degree: $('#peringkat_degree').find(':selected').text(),
                                    tahun_degree: $('#tahun_degree').val(),
                                    kelayakan_degree: $('#kelayakan_degree').find(':selected').text(),
                                    cgpa_degree: $('#cgpa_degree').val(),
                                    institusi_degree: $('#institusi_degree').find(':selected').text(),
                                    nama_sijil_degree: $('#nama_sijil_degree').val(),
                                    pengkhususan_degree: $('#pengkhususan_degree').find(':selected').text(),
                                    fln_degree: $('#fln_degree').find(':selected').text(),
                                    tarikh_senat_degree: $('#tarikh_senat_degree').val(),
                                    biasiswa_degree: $('#biasiswa_degree').find(':selected').text(),
                                },
                                {
                                    peringkat_degree: 'Peringkat Pengajian',
                                    tahun_degree: 'Tahun Pengajian',
                                    kelayakan_degree: 'Peringkat Kelulusan',
                                    cgpa_degree: 'CGPA',
                                    institusi_degree: 'Institusi',
                                    nama_sijil_degree: 'Nama Sijil',
                                    pengkhususan_degree: 'Pengkhususan/Bidang',
                                    fln_degree: 'Francais Luar Negara',
                                    tarikh_senat_degree: 'Tarikh Senat',
                                    biasiswa_degree: 'Biasiswa',
                                }
                                );">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Master --}}
        <div id="academic-master-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-master-info-trigger">
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-master-1" aria-expanded="false" aria-controls="result-master-1">
                <span class="badge badge-light-primary">
                    Ijazah Sarjana [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-master-1">
                <div id="update_master" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editMaster()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form
                    id="masterForm"
                    action="{{ route('master.update') }}"
                    method="POST"
                    data-refreshFunctionName="reloadTimeline"
                    data-refreshFunctionNameIfSuccess="reloadMaster"
                    data-reloadPage="false">
                    @csrf
                    <input type="hidden" id="master_no_pengenalan" name="master_no_pengenalan">
                    <div class="row">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Peringkat Kelulusan</label>
                            <select class="select2 form-control" name="kelayakan_master" id="kelayakan_master" disabled>
                                <option value="" hidden>Peringkat Kelulusan</option>
                                @foreach($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->kod }}">{{ $eligibility->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" name="tahun_master" id="tahun_master" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">CGPA</label>
                            <input type="text" class="form-control" value="" name="cgpa_master" id="cgpa_master" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Institusi</label>
                            <select class="select2 form-control" name="institusi_master" id="institusi_master" disabled>
                                <option value="" hidden>Institusi</option>
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->kod }}">{{ $institution->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <input type="text" class="form-control" value="" name="nama_sijil_master" id="nama_sijil_master" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Pengkhususan/ Bidang</label>
                            <select class="select2 form-control" name="pengkhususan_master" id="pengkhususan_master" disabled>
                                <option value="" hidden>Pengkhususan/ Bidang</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Francais Luar Negara</label>
                            <select class="select2 form-control" name="fln_master" id="fln_master" disabled>
                                <option value="" hidden>Francais Luar Negara</option>
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tarikh Senat</label>
                            <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_master" id="tarikh_senat_master" disabled>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Biasiswa</label>
                            <select class="select2 form-control" name="biasiswa_master" id="biasiswa_master" disabled>
                                <option value="" hidden>Biasiswa</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>

                    <div id="button_action_master" style="display:none">
                        <button type="button" id="btnEditMaster" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditMaster',
                                {
                                    peringkat_master: $('#peringkat_master').find(':selected').text(),
                                    tahun_master: $('#tahun_master').val(),
                                    kelayakan_master: $('#kelayakan_master').find(':selected').text(),
                                    cgpa_master: $('#cgpa_master').val(),
                                    institusi_master: $('#institusi_master').find(':selected').text(),
                                    nama_sijil_master: $('#nama_sijil_master').val(),
                                    pengkhususan_master: $('#pengkhususan_master').find(':selected').text(),
                                    fln_master: $('#fln_master').find(':selected').text(),
                                    tarikh_senat_master: $('#tarikh_senat_master').val(),
                                    biasiswa_master: $('#biasiswa_master').find(':selected').text(),
                                },
                                {
                                    peringkat_master: 'Peringkat Pengajian',
                                    tahun_master: 'Tahun Pengajian',
                                    kelayakan_master: 'Peringkat Kelulusan',
                                    cgpa_master: 'CGPA',
                                    institusi_master: 'Institusi',
                                    nama_sijil_master: 'Nama Sijil',
                                    pengkhususan_master: 'Pengkhususan/Bidang',
                                    fln_master: 'Francais Luar Negara',
                                    tarikh_senat_master: 'Tarikh Senat',
                                    biasiswa_master: 'Biasiswa',
                                }
                                );">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- PhD --}}
        <div id="academic-phd-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-phd-info-trigger">
            <h6 class="fw-bolder" data-bs-toggle="collapse" data-bs-target="#result-phd-1" aria-expanded="false" aria-controls="result-phd-1">
                <span class="badge badge-light-primary">
                    Ijazah Doktor Falsafah [1]
                    <i class="fa-solid fa-chevron-down ms-3"></i>
                </span>
            </h6>

            <div class="collapse show mb-3" id="result-phd-1">
                <div id="update_phd" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editPhd()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>
                <form
                    id="phdForm"
                    action="{{ route('phd.update') }}"
                    method="POST"
                    data-refreshFunctionName="reloadTimeline"
                    data-refreshFunctionNameIfSuccess="reloadPhd"
                    data-reloadPage="false">
                    @csrf
                    <input type="hidden" id="phd_no_pengenalan" name="phd_no_pengenalan">
                    <div class="row">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Peringkat Kelulusan</label>
                            <select class="select2 form-control" name="kelayakan_phd" id="kelayakan_phd" disabled>
                                <option value="" hidden>Peringkat Kelulusan</option>
                                @foreach($eligibilities as $eligibility)
                                    <option value="{{ $eligibility->kod }}">{{ $eligibility->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" name="tahun_phd" id="tahun_phd" disabled>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">CGPA</label>
                            <input type="text" class="form-control" value="" name="cgpa_phd" id="cgpa_phd" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Institusi</label>
                            <select class="select2 form-control" name="institusi_phd" id="institusi_phd" disabled>
                                <option value="" hidden>Institusi</option>
                                    @foreach($institutions as $institution)
                                        <option value="{{ $institution->kod }}">{{ $institution->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <input type="text" class="form-control" value="" name="nama_sijil_phd" id="nama_sijil_phd" disabled>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Pengkhususan/ Bidang</label>
                            <select class="select2 form-control" name="pengkhususan_phd" id="pengkhususan_phd" disabled>
                                <option value="" hidden>Pengkhususan/ Bidang</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{ $specialization->kod }}">{{ $specialization->diskripsi }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Francais Luar Negara</label>
                            <select class="select2 form-control" name="fln_phd" id="fln_phd" disabled>
                                <option value="" hidden>Francais Luar Negara</option>
                                <option value="1">Tidak</option>
                                <option value="2">Ya</option>
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tarikh Senat</label>
                            <input type="text" class="form-control flatpickr" value="" name="tarikh_senat_phd" id="tarikh_senat_phd" disabled>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Biasiswa</label>
                            <select class="select2 form-control" name="biasiswa_phd" id="biasiswa_phd" disabled>
                                <option value="" hidden>Biasiswa</option>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>

                    <div id="button_action_phd" style="display:none">
                        <button type="button" id="btnEditPhd" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditPhd',
                                {
                                    peringkat_phd: $('#peringkat_phd').find(':selected').text(),
                                    tahun_phd: $('#tahun_phd').val(),
                                    kelayakan_phd: $('#kelayakan_phd').find(':selected').text(),
                                    cgpa_phd: $('#cgpa_phd').val(),
                                    institusi_phd: $('#institusi_phd').find(':selected').text(),
                                    nama_sijil_phd: $('#nama_sijil_phd').val(),
                                    pengkhususan_phd: $('#pengkhususan_phd').find(':selected').text(),
                                    fln_phd: $('#fln_phd').find(':selected').text(),
                                    tarikh_senat_phd: $('#tarikh_senat_phd').val(),
                                    biasiswa_phd: $('#biasiswa_phd').find(':selected').text(),
                                },
                                {
                                    peringkat_phd: 'Peringkat Pengajian',
                                    tahun_phd: 'Tahun Pengajian',
                                    kelayakan_phd: 'Peringkat Kelulusan',
                                    cgpa_phd: 'CGPA',
                                    institusi_phd: 'Institusi',
                                    nama_sijil_phd: 'Nama Sijil',
                                    pengkhususan_phd: 'Pengkhususan/Bidang',
                                    fln_phd: 'Francais Luar Negara',
                                    tarikh_senat_phd: 'Tarikh Senat',
                                    biasiswa_phd: 'Biasiswa',
                                }
                                );">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function editDiploma() {
        $('#diplomaForm select[name="peringkat_diploma"]').attr('disabled', false);
        $('#diplomaForm input[name="tahun_diploma"]').attr('disabled', false);
        $('#diplomaForm select[name="kelayakan_diploma"]').attr('disabled', false);
        $('#diplomaForm input[name="cgpa_diploma"]').attr('disabled', false);
        $('#diplomaForm select[name="institusi_diploma"]').attr('disabled', false);
        $('#diplomaForm input[name="nama_sijil_diploma"]').attr('disabled', false);
        $('#diplomaForm select[name="pengkhususan_diploma"]').attr('disabled', false);
        $('#diplomaForm select[name="fln_diploma"]').attr('disabled', false);
        $('#diplomaForm input[name="tarikh_senat_diploma"]').attr('disabled', false);
        $('#diplomaForm select[name="biasiswa_diploma"]').attr('disabled', false);

        $("#button_action_diploma").attr("style", "display:block");
    }

    function reloadDiploma() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadDiplomaUrl = "{{ route('diploma.details', ':replaceThis') }}"
        reloadDiplomaUrl = reloadDiplomaUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadDiplomaUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#diplomaForm select[name="peringkat_diploma"]').val(data.detail.peringkat_pengajian).trigger('change');
                $('#diplomaForm select[name="peringkat_diploma"]').attr('disabled', true);
                $('#diplomaForm input[name="tahun_diploma"]').val(data.detail.tahun_lulus);
                $('#diplomaForm input[name="tahun_diploma"]').attr('disabled', true);
                $('#diplomaForm select[name="kelayakan_diploma"]').val(data.detail.kel_kod).trigger('change');
                $('#diplomaForm select[name="kelayakan_diploma"]').attr('disabled', true);
                $('#diplomaForm input[name="cgpa_diploma"]').val(data.detail.cgpa);
                $('#diplomaForm input[name="cgpa_diploma"]').attr('disabled', true);
                $('#diplomaForm select[name="institusi_diploma"]').val(data.detail.ins_kod).trigger('change');
                $('#diplomaForm select[name="institusi_diploma"]').attr('disabled', true);
                $('#diplomaForm input[name="nama_sijil_diploma"]').val(data.detail.nama_sijil);
                $('#diplomaForm input[name="nama_sijil_diploma"]').attr('disabled', true);
                $('#diplomaForm select[name="pengkhususan_diploma"]').val(data.detail.pen_kod).trigger('change');
                $('#diplomaForm select[name="pengkhususan_diploma"]').attr('disabled', true);
                $('#diplomaForm select[name="fln_diploma"]').val(data.detail.ins_fln).trigger('change');
                $('#diplomaForm select[name="fln_diploma"]').attr('disabled', true);
                $('#diplomaForm input[name="tarikh_senat_diploma"]').val(data.detail.tarikh_senat);
                $('#diplomaForm input[name="tarikh_senat_diploma"]').attr('disabled', true);
                $('#diplomaForm select[name="biasiswa_diploma"]').val((data.detail.biasiswa == true) ? 1 : 0).trigger('change');
                $('#diplomaForm select[name="biasiswa_diploma"]').attr('disabled', true);

                var tmDiplomaElement = $("#tm_dip");
                tmDiplomaElement.attr("hidden", true);

                $("#button_action_diploma").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editDegree() {
        $('#degreeForm select[name="peringkat_degree"]').attr('disabled', false);
        $('#degreeForm input[name="tahun_degree"]').attr('disabled', false);
        $('#degreeForm select[name="kelayakan_degree"]').attr('disabled', false);
        $('#degreeForm input[name="cgpa_degree"]').attr('disabled', false);
        $('#degreeForm select[name="institusi_degree"]').attr('disabled', false);
        $('#degreeForm input[name="nama_sijil_degree"]').attr('disabled', false);
        $('#degreeForm select[name="pengkhususan_degree"]').attr('disabled', false);
        $('#degreeForm select[name="fln_degree"]').attr('disabled', false);
        $('#degreeForm input[name="tarikh_senat_degree"]').attr('disabled', false);
        $('#degreeForm select[name="biasiswa_degree"]').attr('disabled', false);

        $("#button_action_degree").attr("style", "display:block");
    }

    function reloadDegree() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadDegreeUrl = "{{ route('degree.details', ':replaceThis') }}"
        reloadDegreeUrl = reloadDegreeUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadDegreeUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#degreeForm select[name="peringkat_degree"]').val(data.detail.peringkat_pengajian).trigger('change');
                $('#degreeForm select[name="peringkat_degree"]').attr('disabled', true);
                $('#degreeForm input[name="tahun_degree"]').val(data.detail.tahun_lulus);
                $('#degreeForm input[name="tahun_degree"]').attr('disabled', true);
                $('#degreeForm select[name="kelayakan_degree"]').val(data.detail.kel_kod).trigger('change');
                $('#degreeForm select[name="kelayakan_degree"]').attr('disabled', true);
                $('#degreeForm input[name="cgpa_degree"]').val(data.detail.cgpa);
                $('#degreeForm input[name="cgpa_degree"]').attr('disabled', true);
                $('#degreeForm select[name="institusi_degree"]').val(data.detail.ins_kod).trigger('change');
                $('#degreeForm select[name="institusi_degree"]').attr('disabled', true);
                $('#degreeForm input[name="nama_sijil_degree"]').val(data.detail.nama_sijil);
                $('#degreeForm input[name="nama_sijil_degree"]').attr('disabled', true);
                $('#degreeForm select[name="pengkhususan_degree"]').val(data.detail.pen_kod).trigger('change');
                $('#degreeForm select[name="pengkhususan_degree"]').attr('disabled', true);
                $('#degreeForm select[name="fln_degree"]').val(data.detail.ins_fln).trigger('change');
                $('#degreeForm select[name="fln_degree"]').attr('disabled', true);
                $('#degreeForm input[name="tarikh_senat_degree"]').val(data.detail.tarikh_senat);
                $('#degreeForm input[name="tarikh_senat_degree"]').attr('disabled', true);
                $('#degreeForm select[name="biasiswa_degree"]').val((data.detail.biasiswa == true) ? 1 : 0).trigger('change');
                $('#degreeForm select[name="biasiswa_degree"]').attr('disabled', true);

                var tmDegElement = $("#tm_ism");
                tmDegElement.attr("hidden", true);

                $("#button_action_degree").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editMaster() {
        $('#masterForm select[name="peringkat_master"]').attr('disabled', false);
        $('#masterForm input[name="tahun_master"]').attr('disabled', false);
        $('#masterForm select[name="kelayakan_master"]').attr('disabled', false);
        $('#masterForm input[name="cgpa_master"]').attr('disabled', false);
        $('#masterForm select[name="institusi_master"]').attr('disabled', false);
        $('#masterForm input[name="nama_sijil_master"]').attr('disabled', false);
        $('#masterForm select[name="pengkhususan_master"]').attr('disabled', false);
        $('#masterForm select[name="fln_master"]').attr('disabled', false);
        $('#masterForm input[name="tarikh_senat_master"]').attr('disabled', false);
        $('#masterForm select[name="biasiswa_master"]').attr('disabled', false);

        $("#button_action_master").attr("style", "display:block");
    }

    function reloadMaster() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadMasterUrl = "{{ route('master.details', ':replaceThis') }}"
        reloadMasterUrl = reloadMasterUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadMasterUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#masterForm select[name="peringkat_master"]').val(data.detail.peringkat_pengajian).trigger('change');
                $('#masterForm select[name="peringkat_master"]').attr('disabled', true);
                $('#masterForm input[name="tahun_master"]').val(data.detail.tahun_lulus);
                $('#masterForm input[name="tahun_master"]').attr('disabled', true);
                $('#masterForm select[name="kelayakan_master"]').val(data.detail.kel_kod).trigger('change');
                $('#masterForm select[name="kelayakan_master"]').attr('disabled', true);
                $('#masterForm input[name="cgpa_master"]').val(data.detail.cgpa);
                $('#masterForm input[name="cgpa_master"]').attr('disabled', true);
                $('#masterForm select[name="institusi_master"]').val(data.detail.ins_kod).trigger('change');
                $('#masterForm select[name="institusi_master"]').attr('disabled', true);
                $('#masterForm input[name="nama_sijil_master"]').val(data.detail.nama_sijil);
                $('#masterForm input[name="nama_sijil_master"]').attr('disabled', true);
                $('#masterForm select[name="pengkhususan_master"]').val(data.detail.pen_kod).trigger('change');
                $('#masterForm select[name="pengkhususan_master"]').attr('disabled', true);
                $('#masterForm select[name="fln_master"]').val(data.detail.ins_fln).trigger('change');
                $('#masterForm select[name="fln_master"]').attr('disabled', true);
                $('#masterForm input[name="tarikh_senat_master"]').val(data.detail.tarikh_senat);
                $('#masterForm input[name="tarikh_senat_master"]').attr('disabled', true);
                $('#masterForm select[name="biasiswa_master"]').val((data.detail.biasiswa == true) ? 1 : 0).trigger('change');
                $('#masterForm select[name="biasiswa_master"]').attr('disabled', true);

                var tmMasterElement = $("#tm_is");
                tmMasterElement.attr("hidden", true);

                $("#button_action_master").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editPhd() {
        $('#phdForm select[name="peringkat_phd"]').attr('disabled', false);
        $('#phdForm input[name="tahun_phd"]').attr('disabled', false);
        $('#phdForm select[name="kelayakan_phd"]').attr('disabled', false);
        $('#phdForm input[name="cgpa_phd"]').attr('disabled', false);
        $('#phdForm select[name="institusi_phd"]').attr('disabled', false);
        $('#phdForm input[name="nama_sijil_phd"]').attr('disabled', false);
        $('#phdForm select[name="pengkhususan_phd"]').attr('disabled', false);
        $('#phdForm select[name="fln_phd"]').attr('disabled', false);
        $('#phdForm input[name="tarikh_senat_phd"]').attr('disabled', false);
        $('#phdForm select[name="biasiswa_phd"]').attr('disabled', false);

        $("#button_action_phd").attr("style", "display:block");
    }

    function reloadPhd() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPhdUrl = "{{ route('phd.details', ':replaceThis') }}"
        reloadPhdUrl = reloadPhdUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPhdUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#phdForm select[name="peringkat_phd"]').val(data.detail.peringkat_pengajian).trigger('change');
                $('#phdForm select[name="peringkat_phd"]').attr('disabled', true);
                $('#phdForm input[name="tahun_phd"]').val(data.detail.tahun_lulus);
                $('#phdForm input[name="tahun_phd"]').attr('disabled', true);
                $('#phdForm select[name="kelayakan_phd"]').val(data.detail.kel_kod).trigger('change');
                $('#phdForm select[name="kelayakan_phd"]').attr('disabled', true);
                $('#phdForm input[name="cgpa_phd"]').val(data.detail.cgpa);
                $('#phdForm input[name="cgpa_phd"]').attr('disabled', true);
                $('#phdForm select[name="institusi_phd"]').val(data.detail.ins_kod).trigger('change');
                $('#phdForm select[name="institusi_phd"]').attr('disabled', true);
                $('#phdForm input[name="nama_sijil_phd"]').val(data.detail.nama_sijil);
                $('#phdForm input[name="nama_sijil_phd"]').attr('disabled', true);
                $('#phdForm select[name="pengkhususan_phd"]').val(data.detail.pen_kod).trigger('change');
                $('#phdForm select[name="pengkhususan_phd"]').attr('disabled', true);
                $('#phdForm select[name="fln_phd"]').val(data.detail.ins_fln).trigger('change');
                $('#phdForm select[name="fln_phd"]').attr('disabled', true);
                $('#phdForm input[name="tarikh_senat_phd"]').val(data.detail.tarikh_senat);
                $('#phdForm input[name="tarikh_senat_phd"]').attr('disabled', true);
                $('#phdForm select[name="biasiswa_phd"]').val((data.detail.biasiswa == true) ? 1 : 0).trigger('change');
                $('#phdForm select[name="biasiswa_phd"]').attr('disabled', true);

                var tmDrElement = $("#tm_idf");
                tmDrElement.attr("hidden", true);

                $("#button_action_phd").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

</script>
