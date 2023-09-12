@extends('layouts.app')

@section('header')
Maklumat Pemohon
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="#"> Maklumat Pemohon </a></li>
@endsection

@section('content')
<section id="faq-search-filter">
    <div class="card faq-search" style="background-image: url('{{asset('images/banner/banner.png')}}')">
        <div class="card-body text-center">
            <h2 class="text-primary">Carian Maklumat Pemohon</h2>
            <p class="card-text mb-2">Isikan no. kad pengenalan calon dan tekan butang Cari</p>

            <div class="faq-search-input">
                <div class="input-group input-group-merge">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>

                    {{-- Search form --}}
                        <input type="text" class="form-control" id="search_ic" placeholder="No. Kad Pegenalan Calon" maxlength="12"/>
                        <button class="btn btn-primary waves-effect" type="button" onclick="searchCandidate()">Cari</button>
                </div>
            </div>
        </div>
    </div>
</section>

<hr>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 order-1 order-lg-1">
        <div class="card">
            <div class="card-body">
                <p class="card-title fw-bolder">Maklumat Permohonan</p>
                <hr>

                {{-- Maklumat Pemohon [Nama dan No KP] --}}
                <div class="mt-2">
                    <h5 class="fw-bolder">Nama Pemohon:</h5>
                    <p class="card-text" id="candidate_name">
                    </p>
                </div>
                <div class="mt-2">
                    <h5 class="fw-bolder">No Kad Pengenalan:</h5>
                    <p class="card-text" id="candidate_ic">
                    </p>
                </div>
                <input type="hidden" id="candidate_no_pengenalan" name="candidate_no_pengenalan" value="">
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-title fw-bolder">Garis Masa Permohonan</p>
                <hr>
                <div id="candidate_timeline">
                {{-- TIMELINE PERMOHONAN --}}

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 order-2 order-lg-2">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder active" id="peribadi-tab" data-bs-toggle="tab" href="#peribadi" aria-controls="peribadi" role="tab" aria-selected="true">
                                Maklumat <br> Peribadi
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder" id="skim-tab" data-bs-toggle="tab" href="#skim" aria-controls="skim" role="tab" aria-selected="true">
                                Maklumat <br> Skim
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder" id="akademik-tab" data-bs-toggle="tab" href="#akademik" aria-controls="akademik" role="tab" aria-selected="true">
                                Maklumat <br> Akademik
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder" id="perkhidmatan-tab" data-bs-toggle="tab" href="#perkhidmatan" aria-controls="perkhidmatan" role="tab" aria-selected="true">
                                Pegawai <br> Berkhidmat
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder" id="tambahan-tab" data-bs-toggle="tab" href="#tambahan" aria-controls="tambahan" role="tab" aria-selected="true">
                                Maklumat <br> Tambahan
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder" id="tatatertib-tab" data-bs-toggle="tab" href="#tatatertib" aria-controls="tatatertib" role="tab" aria-selected="true">
                                Maklumat <br> Tatatertib
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="peribadi" role="tabpanel" aria-labelledby="peribadi-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_peribadi')
                        </div>
                        <div class="tab-pane fade" id="skim" role="tabpanel" aria-labelledby="skim-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_skim')
                        </div>
                        <div class="tab-pane fade" id="akademik" role="tabpanel" aria-labelledby="akademik-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_akademik')
                        </div>
                        <div class="tab-pane fade" id="perkhidmatan" role="tabpanel" aria-labelledby="perkhidmatan-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_perkhidmatan')
                        </div>
                        <div class="tab-pane fade" id="tambahan" role="tabpanel" aria-labelledby="tambahan-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_tambahan')
                        </div>
                        <div class="tab-pane fade" id="tatatertib" role="tabpanel" aria-labelledby="tatatertib-tab">
                            <hr>
                            @include('maklumat_pemohon.pemohon.maklumat_tatatertib.tatatertib')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var originalVal = {};
    var data_not_available = "Tiada Maklumat";

    function checkInput(inputId, alertId) {
        var inputElement = document.getElementById(inputId);
        var alertElement = document.getElementById(alertId);

        if (inputElement.value === "") {
            if(originalVal[inputId]){
                alertElement.innerHTML = "Maklumat Asal: " + originalVal[inputId];
            }else{
                alertElement.innerHTML = "Maklumat Asal: Tiada Maklumat Asal" ;
            }
        } else {
            alertElement.innerHTML = "";
        }
    }

    function searchCandidate() {
        var search_ic = $('#search_ic').val();

        if(search_ic == ''){
            Swal.fire('Gagal', 'Sila isikan no kad pengenalan', 'error');
        } else {
            $.ajax({
                url: "{{ route('get-candidate-details') }}",
                method: 'POST',
                async: true,
                data : {
                    no_ic : search_ic
                },
                success: function(data) {

                    $('#update_alamat').attr('hidden', false);
                    $('#update_personal').attr('hidden', false);
                    $('#update_tempat_lahir').attr('hidden', false);
                    $('#update_penalty').attr('hidden', false);

                    $('#candidate_name').html(data.detail.full_name);
                    $('#candidate_ic').html(data.detail.no_ic);
                    $('#candidate_no_pengenalan').val(data.detail.no_pengenalan);

                    var timelineUrl = "{{ route('timeline.list', ':replaceThis') }}"
                    timelineUrl = timelineUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#candidate_timeline').load(timelineUrl)

                    $('#personalForm select[name="gender"]').attr('disabled', true);
                    $('#personalForm select[name="gender"]').val(data.detail.ref_gender_code).trigger('change');
                    $('#personalForm select[name="religion"]').attr('disabled', true);
                    $('#personalForm select[name="religion"]').val(data.detail.ref_religion_code).trigger('change');
                    $('#personalForm select[name="race"]').attr('disabled', true);
                    $('#personalForm select[name="race"]').val(data.detail.ref_race_code).trigger('change');

                    $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                    $('#personalForm input[name="date_of_birth"]').val(data.detail.date_of_birth ? data.detail.date_of_birth : data_not_available);
                    originalVal['date_of_birth'] = data.detail.date_of_birth;

                    $('#personalForm select[name="marital_status"]').attr('disabled', true);
                    $('#personalForm select[name="marital_status"]').val(data.detail.ref_marital_status_code).trigger('change');

                    $('#personalForm input[name="phone_number"]').attr('disabled', true);
                     $('#personalForm input[name="phone_number"]').val(data.detail.phone_number ? data.detail.phone_number : data_not_available);
                    originalVal['phone_number'] = data.detail.phone_number;

                    $('#personalForm input[name="email"]').attr('disabled', true);
                    $('#personalForm input[name="email"]').val(data.detail.email ? data.detail.email : data_not_available);
                    originalVal['email'] = data.detail.email;

                    $('#personalForm input[name="personal_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_1"]').val(data.detail.permanent_address_1 ? data.detail.permanent_address_1 : data_not_available);
                    originalVal['permanent_address_1'] = data.detail.permanent_address_1;
                    $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_2"]').val(data.detail.permanent_address_2 ? data.detail.permanent_address_2 : data_not_available);
                    originalVal['permanent_address_2'] = data.detail.permanent_address_2;
                    $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_3"]').val(data.detail.permanent_address_3 ? data.detail.permanent_address_3 : data_not_available);
                    originalVal['permanent_address_3'] = data.detail.permanent_address_3;
                    $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_poscode"]').val(data.detail.permanent_poscode ? data.detail.permanent_poscode : data_not_available);
                    originalVal['permanent_poscode'] = data.detail.permanent_poscode;
                    $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_city"]').val(data.detail.permanent_city ? data.detail.permanent_city : data_not_available);
                    originalVal['permanent_city'] = data.detail.permanent_city;
                    $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                    $('#alamatForm select[name="permanent_state"]').val(data.detail.permanent_ref_state_code ? data.detail.permanent_ref_state_code : data_not_available).trigger('change');
                    originalVal['permanent_state'] = data.detail.permanent_ref_state_code;
                    $('#alamatForm input[name="address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="address_1"]').val(data.detail.address_1 ? data.detail.address_1 : data_not_available);
                    originalVal['address_1'] = data.detail.address_1;
                    $('#alamatForm input[name="address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="address_2"]').val(data.detail.address_2 ? data.detail.address_2 : data_not_available);
                    originalVal['address_2'] = data.detail.address_2;
                    $('#alamatForm input[name="address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="address_3"]').val(data.detail.address_3 ? data.detail.address_3 : data_not_available);
                    originalVal['address_3'] = data.detail.address_3;
                    $('#alamatForm input[name="poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="poscode"]').val(data.detail.poscode ? data.detail.poscode : data_not_available);
                    originalVal['poscode'] = data.detail.poscode;
                    $('#alamatForm input[name="city"]').attr('disabled', true);
                    $('#alamatForm input[name="city"]').val(data.detail.city ? data.detail.city : data_not_available);
                    originalVal['city'] = data.detail.city;
                    $('#alamatForm select[name="state"]').attr('disabled', true);
                    $('#alamatForm select[name="state"]').val(data.detail.ref_state_code ? data.detail.ref_state_code : data_not_available).trigger('change');
                    originalVal['state'] = data.detail.ref_state_code;
                    $('#alamatForm input[name="alamat_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#tempatLahirForm select[name="place_of_birth"]').val(data.detail.place_of_birth ? data.detail.place_of_birth : data_not_available).trigger('change');
                    originalVal['place_of_birth'] = data.detail.place_of_birth;
                    $('#tempatLahirForm select[name="father_place_of_birth"]').val(data.detail.father_place_of_birth ? data.detail.father_place_of_birth : data_not_available).trigger('change');
                    originalVal['father_place_of_birth'] = data.detail.father_place_of_birth;
                    $('#tempatLahirForm select[name="mother_place_of_birth"]').val(data.detail.mother_place_of_birth ? data.detail.mother_place_of_birth : data_not_available).trigger('change');
                    originalVal['mother_place_of_birth'] = data.detail.mother_place_of_birth;
                    $('#tempatLahirForm input[name="tempat_lahir_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.license != null) {
                        $('#license_type').val(data.detail.license.type);
                        originalVal['license_type'] = data.detail.license.type;
                        $('#license_expiry_date').val(data.detail.license.expiryDate);
                        originalVal['license_type'] = data.detail.license.expiryDate;
                        $('#license_blacklist_status').val(data.detail.license.is_blacklist).trigger('change');
                        originalVal['license_type'] = data.detail.license.is_blacklist;
                        $('#license_blacklist_details').val(data.detail.license.blacklist_details);
                        originalVal['license_type'] = data.detail.license.blacklist_details;
                    }else{
                        $('#license_type').val(data_not_available);
                        $('#license_expiry_date').val(data_not_available);
                        $('#license_blacklist_status').val(data_not_available).trigger('change');
                        $('#license_blacklist_details').val(data_not_available);
                    }

                    if(data.detail.oku != null) {
                        $('#oku_registration_no').val(data.detail.oku.no_registration);
                        originalVal['oku_registration_no'] = data.detail.oku.no_registration;
                        $('#oku_status').val(data.detail.oku.status);
                        originalVal['oku_status'] = data.detail.oku.status;
                        $('#oku_category').val(data.detail.oku.category);
                        originalVal['oku_category'] = data.detail.oku.category;
                        $('#oku_sub').val(data.detail.oku.sub);
                        originalVal['oku_sub'] = data.detail.oku.sub;
                    }else{
                        $('#oku_registration_no').val(data_not_available);
                        $('#oku_status').val(data_not_available);
                        $('#oku_category').val(data_not_available);
                        $('#oku_sub').val(data_not_available);
                    }

                    $('#table-skim tbody').empty();
                    if(data.detail.skim.length == 0){
                        var trSkim = '<tr><td align="center" colspan="6">*Tiada Rekod*</td></tr>';
                    } else {
                        var trSkim = '';
                        var bilSkim = 0;
                        $.each(data.detail.skim, function (i, item) {
                            bilSkim += 1;
                            trSkim += '<tr>';
                            trSkim += '<td align="center">' + bilSkim + '</td>'
                            trSkim += '<td>' + item.ref_skim_code + '</td>'
                            trSkim += '<td>' + item.skim.name + '</td>';
                            trSkim += '<td>' + (item.register_date ? item.registerDate : '') + '</td>';
                            trSkim += '<td>' + (item.expiry_date ? item.expiry_date : '') + '</td>';
                            trSkim += '<td>' + (item.interview_centre ? item.interview_centre.name : '') + '</td>';
                            //trSkim += '<td>' + item.interview_centre.name + '</td>';
                            trSkim += '</tr>';
                        });
                }
                    $('#table-skim tbody').append(trSkim);

                    $('#table-pmr tbody').empty();
                    if(data.detail.pmr.length == 0){
                        var trPmr = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trPmr = '';
                        var bilPmr = 0;
                        $.each(data.detail.pmr, function (i, item) {
                            if(item.subject != null) {
                                bilPmr += 1;
                                trPmr += '<tr>';
                                trPmr += '<td align="center">' + bilPmr + '</td>';
                                trPmr += '<td>' + item.subject.code + '</td>';
                                trPmr += '<td>' + item.subject.name + '</td>';
                                trPmr += '<td>' + item.grade + '</td>';
                                trPmr += '</tr>';
                            }
                        });
                    }
                    $('#table-pmr tbody').append(trPmr);

                    $('#table-spm tbody').empty();
                    if(data.detail.spm.length == 0){
                        var trSpm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trSpm = '';
                        var bilSpm = 0;
                        $.each(data.detail.spm, function (i, item) {
                            if(item.subject != null) {
                                bilSpm += 1;
                                trSpm += '<tr>';
                                trSpm += '<td align="center">' + bilSpm + '</td>';
                                trSpm += '<td>' + item.subject.code + '</td>';
                                trSpm += '<td>' + item.subject.name + '</td>';
                                trSpm += '<td>' + item.grade + '</td>';
                                trSpm += '</tr>';
                            }
                        });
                    }
                    $('#table-spm tbody').append(trSpm);

                    $('#table-spmv tbody').empty();
                    if(data.detail.spmv.length == 0){
                        var trSpmv = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trSpmv = '';
                        var bilSpmv = 0;
                        $.each(data.detail.spmv, function (i, item) {
                            if(item.subject != null) {
                                bilSpmv += 1;
                                trSpmv += '<tr>';
                                trSpmv += '<td align="center">' + bilSpmv + '</td>';
                                trSpmv += '<td>' + item.subject.code + '</td>';
                                trSpmv += '<td>' + item.subject.name + '</td>';
                                trSpmv += '<td>' + item.grade + '</td>';
                                trSpmv += '</tr>';
                            }
                        });
                    }
                    $('#table-spmv tbody').append(trSpmv);

                    $('#table-svm tbody').empty();
                    if(data.detail.svm.length == 0){
                        var trSvm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trSvm = '';
                        var bilSvm = 0;
                        $.each(data.detail.svm, function (i, item) {
                            if(item.subject != null) {
                                bilSvm += 1;
                                trSvm += '<tr>';
                                trSvm += '<td align="center">' + bilSvm + '</td>';
                                trSvm += '<td>' + item.subject.code + '</td>';
                                trSvm += '<td>' + item.subject.name + '</td>';
                                trSvm += '<td>' + item.grade + '</td>';
                                trSvm += '</tr>';
                            }
                        });
                    }
                    $('#table-svm tbody').append(trSvm);

                    $('#table-stpm tbody').empty();
                    if(data.detail.stpm.length == 0){
                        var trStpm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trStpm = '';
                        var bilStpm = 0;
                        $.each(data.detail.stpm, function (i, item) {
                            if(item.subject != null) {
                                bilStpm += 1;
                                trStpm += '<tr>';
                                trStpm += '<td align="center">' + bilStpm + '</td>';
                                trStpm += '<td>' + item.subject.code + '</td>';
                                trStpm += '<td>' + item.subject.name + '</td>';
                                trStpm += '<td>' + item.grade + '</td>';
                                trStpm += '</tr>';
                            }
                        });
                    }
                    $('#table-stpm tbody').append(trStpm);

                    $('#table-stam tbody').empty();
                    if(data.detail.stam.length == 0){
                        var trStam = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trStam = '';
                        var bilStam = 0;
                        $.each(data.detail.stam, function (i, item) {
                            if(item.subject != null) {
                                bilStam += 1;
                                trStam += '<tr>';
                                trStam += '<td align="center">' + bilStam + '</td>';
                                trStam += '<td>' + item.subject.code + '</td>';
                                trStam += '<td>' + item.subject.name + '</td>';
                                trStam += '<td>' + item.grade + '</td>';
                                trStam += '</tr>';
                            }
                        });
                    }
                    $('#table-stam tbody').append(trStam);

                    $('#table-matriculation tbody').empty();
                    if(data.detail.matriculation.length == 0){
                        var trMatriculation = '<tr><td align="center" colspan="9">*Tiada Rekod*</td></tr>';
                    } else {
                        var trMatriculation = '';
                        var bilMatriculation = 0;
                        $.each(data.detail.matriculation, function (i, item) {
                                bilMatriculation += 1;
                                trMatriculation += '<tr>';
                                trMatriculation += '<td align="center">' + bilMatriculation + '</td>'
                                trMatriculation += '<td>' + item.college.name + '</td>';
                                trMatriculation += '<td>' + item.course.name + '</td>';
                                trMatriculation += '<td>' + item.matric_no + '</td>';
                                trMatriculation += '<td>' + item.session + '</td>';
                                trMatriculation += '<td>' + item.semester + '</td>';
                                trMatriculation += '<td>' + item.subject.name + '</td>';
                                trMatriculation += '<td>' + item.grade + '</td>';
                                trMatriculation += '<td>' + item.pngk + '</td>';
                                trMatriculation += '</tr>';
                        });
                    }
                    $('#table-matriculation tbody').append(trMatriculation);

                    $('#table-skm tbody').empty();
                    if(data.detail.skm.length == 0){
                        var trSkm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trSkm = '';
                        var bilSkm = 0;
                        $.each(data.detail.skm, function (i, item) {
                            bilSkm += 1;
                            trSkm += '<tr>';
                            trSkm += '<td align="center">' + bilSkm + '</td>'
                            trSkm += '<td>' + item.year + '</td>';
                            trSkm += '<td>' + item.qualification.code + '</td>';
                            trSkm += '<td>' + item.qualification.name + '</td>';
                            trSkm += '</tr>';
                        });
                    }
                    $('#table-skm tbody').append(trSkm);

                    if(data.detail.higher_education != null) {
                        $('#higherEducationForm input[name="tahun_pengajian_tinggi"]').val(data.detail.higher_education.year);
                        $('#higherEducationForm input[name="cgpa_pengajian_tinggi"]').val(data.detail.higher_education.cgpa);
                        $('#higherEducationForm select[name="institusi_pengajian_tinggi"]').val(data.detail.higher_education.ref_institution_code).trigger('change');
                        $('#higherEducationForm select[name="pengkhususan_pengajian_tinggi"]').val(data.detail.higher_education.ref_specialization_code).trigger('change');
                    }

                    $('#table-professional tbody').empty();
                    if(data.detail.professional.length == 0){
                        var trProfessional = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trProfessional = '';
                        var bilProfessional = 0;
                        $.each(data.detail.professional, function (i, item) {
                            bilProfessional += 1;
                            trProfessional += '<tr>';
                            trProfessional += '<td align="center">' + bilProfessional + '</td>'
                            trProfessional += '<td>' + (item.member_no ? item.member_no : '') + '</td>';
                            trProfessional += '<td>' + item.specialization.name + '</td>';
                            trProfessional += '<td>' + (item.date ? item.newDate : '') + '</td>';
                            trProfessional += '</tr>';
                        });
                    }
                    $('#table-professional tbody').append(trProfessional);

                    if(data.detail.experience != null){
                        $('#experienceForm select[name="experience_position_level"]').val(data.detail.experience.ref_position_level_code).trigger('change');
                        $('#experienceForm select[name="experience_skim"]').val(data.detail.experience.ref_skim_code).trigger('change');
                        $('#experienceForm input[name="experience_verify_date"]').val(data.detail.experience.date_verify);
                        $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.experience.ref_department_ministry_code).trigger('change');
                        $('#experienceForm select[name="experience_department_state"]').val(data.detail.experience.state_department).trigger('change');
                    }

                    $('#table-psl tbody').empty();
                    if(data.detail.psl.length == 0){
                        var trPsl = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    } else {
                        var trPsl = '';
                        var bilPsl = 0;
                        $.each(data.detail.psl, function (i, item) {
                            bilPsl += 1;
                            trPsl += '<tr>';
                            trPsl += '<td align="center">' + bilPsl + '</td>'
                            trPsl += '<td>' + item.qualification.code + '</td>';
                            trPsl += '<td>' + item.qualification.name + '</td>';
                            trPsl += '<td>' + (item.exam_date ? item.examDate : '') + '</td>';
                            trPsl += '</tr>';
                        });
                    }
                    $('#table-psl tbody').append(trPsl);

                    if(data.detail.army_police != null){
                        $('#army_police_rank').val(data.detail.army_police.ref_rank_code).trigger('change');
                    }

                    $('#table-language tbody').empty();
                    if(data.detail.language.length == 0){
                        var trLanguage = '<tr><td align="center" colspan="3">*Tiada Rekod*</td></tr>';
                    } else {
                        var trLanguage = '';
                        var bilLanguage = 0;
                        $.each(data.detail.language, function (i, item) {
                            var languageLevel = '';
                            if(item.level == 1){
                                languageLevel = 'BERTUTUR DAN MENULIS';
                            } else if(item.level == 2){
                                languageLevel = 'BERTUTUR';
                            } else if(item.level == 3){
                                languageLevel = 'MENULIS';
                            }
                            bilLanguage += 1;
                            trLanguage += '<tr>';
                            trLanguage += '<td align="center">' + bilLanguage + '</td>'
                            trLanguage += '<td>' + item.language.name + '</td>';
                            trLanguage += '<td>' + languageLevel + '</td>';
                            trLanguage += '</tr>';
                        });
                    }
                    $('#table-language tbody').append(trLanguage);

                    $('#table-talent tbody').empty();
                    if(data.detail.talent.length == 0){
                        var trTalent = '<tr><td align="center" colspan="2">*Tiada Rekod*</td></tr>';
                    } else {
                        var trTalent = '';
                        var bilTalent = 0;
                        $.each(data.detail.talent, function (i, item) {
                            bilTalent += 1;
                            trTalent += '<tr>';
                            trTalent += '<td align="center">' + bilTalent + '</td>'
                            trTalent += '<td>' + item.talent.name + '</td>';
                            trTalent += '</tr>';
                        });
                    }
                    $('#table-talent tbody').append(trTalent);

                    $('#penaltyForm select[name="penalty"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_duration"]').attr('disabled', true);
                    $('#penaltyForm select[name="penalty_type"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_start"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('readonly', false);
                    $('#penaltyForm input[name="penalty_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#table-penalty tbody').empty();
                    if(data.detail.penalty.length == 0){
                        var trPenalty = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    } else {
                        var trPenalty = '';
                        var bilPenalty = 0;
                        $.each(data.detail.penalty, function (i, item) {
                            bilPenalty += 1;
                            trPenalty += '<tr>';
                            trPenalty += '<td align="center">' + bilPenalty + '</td>'
                            trPenalty += '<td>' + item.penalty.name + '</td>';
                            trPenalty += '<td>' + item.duration + ' ' + item.type + '</td>';
                            trPenalty += '<td>' + item.startDate + '</td>';
                            trPenalty += '<td>' + item.endDate + '</td>';
                            trPenalty += '</tr>';
                        });
                    }
                    $('#table-penalty tbody').append(trPenalty);


                },
                error: function(data) {

                    $('#update_personal').attr('hidden', true);
                    $('#update_alamat').attr('hidden', true);
                    $('#update_tempat_lahir').attr('hidden', true);
                    $('#update_penalty').attr('hidden', true);

                    $("#button_action_personal").attr("style", "display:none");
                    $("#button_action_alamat").attr("style", "display:none");
                    $("#button_action_tempat_lahir").attr("style", "display:none");
                    $("#button_action_penalty").attr("style", "display:none");

                    $('#personalForm select[name="gender"]').attr('disabled', true);
                    $('#personalForm select[name="gender"]').val('').trigger('change');
                    $('#personalForm select[name="religion"]').attr('disabled', true);
                    $('#personalForm select[name="religion"]').val('').trigger('change');
                    $('#personalForm select[name="race"]').attr('disabled', true);
                    $('#personalForm select[name="race"]').val('').trigger('change');
                    $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                    $('#personalForm input[name="date_of_birth"]').val('');
                    $('#personalForm select[name="marital_status"]').attr('disabled', true);
                    $('#personalForm select[name="marital_status"]').val('').trigger('change');
                    $('#personalForm input[name="phone_number"]').attr('disabled', true);
                    $('#personalForm input[name="phone_number"]').val('');
                    $('#personalForm input[name="email"]').attr('disabled', true);
                    $('#personalForm input[name="email"]').val('');
                    $('#personalForm input[name="personal_no_pengenalan"]').val('');

                    $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_1"]').val('');
                    $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_2"]').val('');
                    $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_3"]').val('');
                    $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_poscode"]').val('');
                    $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_city"]').val('');
                    $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                    $('#alamatForm select[name="permanent_state"]').val('').trigger('change');
                    $('#alamatForm input[name="address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="address_1"]').val('');
                    $('#alamatForm input[name="address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="address_2"]').val('');
                    $('#alamatForm input[name="address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="address_3"]').val('');
                    $('#alamatForm input[name="poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="poscode"]').val('');
                    $('#alamatForm input[name="city"]').attr('disabled', true);
                    $('#alamatForm input[name="city"]').val('');
                    $('#alamatForm select[name="state"]').attr('disabled', true);
                    $('#alamatForm select[name="state"]').val('').trigger('change');
                    $('#alamatForm input[name="alamat_no_pengenalan"]').val('');

                    $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', true);
                    $('#tempatLahirForm select[name="place_of_birth"]').val('').trigger('change');
                    $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', true);
                    $('#tempatLahirForm select[name="father_place_of_birth"]').val('').trigger('change');
                    $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', true);
                    $('#tempatLahirForm select[name="mother_place_of_birth"]').val('').trigger('change');
                    $('#tempatLahirForm input[name="tempat_lahir_no_pengenalan"]').val('');

                    $('#penaltyForm select[name="penalty"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_duration"]').attr('disabled', true);
                    $('#penaltyForm select[name="penalty_type"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_start"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('readonly', false);
                    $('#penaltyForm input[name="penalty_no_pengenalan"]').val('');

                    $("#button_action_penalty").attr("style", "display:none");
                    $('#table-penalty tbody').empty();

                    var data = data.responseJSON;
                    Swal.fire(data.title, data.detail, 'error');
                }
            });
        }
    }

    function reloadTimeline() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadUrl = "{{ route('timeline.list', ':replaceThis') }}"
        reloadUrl = reloadUrl.replace(':replaceThis', no_pengenalan);
        $('#candidate_timeline').load(reloadUrl)
    }
</script>
@endsection
