@extends('layouts.app')

@section('header')
Maklumat Pemohon
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="#"> Maklumat Pemohon </a></li>
@endsection

@section('content')
<style>
    .suggestions-container {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 50vh;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
        display: none;
        text-align: left;
        cursor: pointer;
    }

    .suggestion {
        padding: 7px;
        border-bottom: 1px solid #ccc;
    }

</style>
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
                        <input type="text" class="form-control" id="search_ic" placeholder="No. Kad Pegenalan Calon" oninput="getSuggestions(this.value)"/>
                        <input type="text" class="form-control" id="selected_ic" hidden/>
                        <button class="btn btn-primary waves-effect" type="button" onclick="searchCandidate()">Cari</button>

                        <div class="suggestions-container"></div>
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

        // if (inputElement.value === "Tiada Maklumat") {
        //         inputElement.style.color = "maroon";
        // } else {
        //     inputElement.style.color = "";
        // }
    }

    function selectionNull(inputID, formID){
        var x = document.getElementById(inputID);
        var existingOption = x.querySelector('option[value="Tiada Maklumat"]');

        if(existingOption){
            x.removeChild(existingOption);
        }

        var option = document.createElement("option");
        option.text = "Tiada Maklumat";
        option.value = "Tiada Maklumat";
        option.disabled = true;
        x.add(option);

        $('#' + formID + ' select[name="' + inputID + '"]').val("Tiada Maklumat").trigger('change');
    }

    function deleteItem(id, itemUrl, reload){
        var deleteUrl = itemUrl;
        deleteUrl = deleteUrl.replace(':replaceThis', id);
        $.ajax({
            url: deleteUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reload();
            }
        });
    }

    function confirmSubmit(btnName, newValues, columnHead) {
        var htmlContent = '<p>Perubahan:</p>';

        for (var key in originalVal) {
        if (originalVal.hasOwnProperty(key)) {
            if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
                if (originalVal[key] == null || originalVal[key] === '') {
                    if (newValues[key] !== 'Tiada Maklumat') {
                        if(newValues[key] !== null){
                            htmlContent += '<p>' + columnHead[key] + ':<br>';
                            htmlContent += 'Tiada Maklumat kepada ' + newValues[key] + '</p>';
                        }

                    }
                } else {
                    htmlContent += '<p>' + columnHead[key] + ':<br>';
                    htmlContent += originalVal[key] + ' kepada ' + newValues[key] + '</p>';
                }
        }}
        }


        if (htmlContent === '<p>Perubahan:</p>') {
            Swal.fire({
                title: 'Tiada Perubahan Dibuat',
                icon: 'info',
                confirmButtonText: 'OK'
            });
            return;
        }

        Swal.fire({
        title: 'Adakah anda ingin simpan perubahan ini?',
        html: htmlContent,
        showCancelButton: true,
        confirmButtonText: 'Sahkan',
        cancelButtonText: 'Batal',
        }).then((result) => {
        if (result.isConfirmed) {
            $('#'+btnName).trigger('click');
            // for (var key in originalVal) {
            //     if (originalVal.hasOwnProperty(key)) {
            //         if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
            //             originalVal[key] = newValues[key];
            //         }
            //     }
            // }
        }
        })
    }

    function searchCandidate() {
        var searvh_ic = '';
        if($('#search_ic').val().length <= 12){
            search_ic = $('#search_ic').val();
        }else{
            search_ic = $('#selected_ic').val();
        }


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
                    var container = $('.suggestions-container');
                    container.hide();
                    $('#update_alamat').attr("style", "display:block");
                    $('#update_personal').attr("style", "display:block");
                    $('#update_tempat_lahir').attr("style", "display:block");
                    $('#update_pmr').attr("style", "display:block");
                    $('#update_pengajian_tinggi').attr("style", "display:block");
                    $('#update_experience').attr("style", "display:block");
                    $('#update_tentera_polis').attr("style", "display:block");
                    $('#update_penalty').attr("style", "display:block");
                    $('#update_lesen_memandu').attr("style", "display:block");
                    $('#update_oku').attr("style", "display:block");
                    $('#update_pmr').attr("style", "display:block");
                    $('#update_skm').attr("style", "display:block");
                    $('#update_bahasa').attr("style", "display:block");
                    $('#update_bakat').attr("style", "display:block");
                    $('#update_psl').attr("style", "display:block");
                    $('#update_spm').attr("style", "display:block");
                    $('#update_spmv').attr("style", "display:block");
                    $('#update_svm').attr("style", "display:block");
                    $('#update_stpm').attr("style", "display:block");
                    $('#update_stam').attr("style", "display:block");
                    $('#update_matrikulasi').attr("style", "display:block");

                    $('#candidate_name').html(data.detail.full_name);
                    $('#candidate_ic').html(data.detail.no_ic);
                    $('#candidate_no_pengenalan').val(data.detail.no_pengenalan);

                    var timelineUrl = "{{ route('timeline.list', ':replaceThis') }}"
                    timelineUrl = timelineUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#candidate_timeline').load(timelineUrl)

                    $('#personalForm select[name="gender"]').attr('disabled', true);
                    if(data.detail.ref_gender_code) { $('#personalForm select[name="gender"]').val(data.detail.ref_gender_code).trigger('change'); }
                    else { selectionNull('gender', 'personalForm');}
                    originalVal['gender'] = $('#personalForm select[name="gender"]').find(':selected').text();
                    $('#personalForm select[name="religion"]').attr('disabled', true);
                    if(data.detail.ref_religion_code) { $('#personalForm select[name="religion"]').val(data.detail.ref_religion_code).trigger('change'); }
                    else { selectionNull('religion', 'personalForm'); }
                    originalVal['religion'] = $('#personalForm select[name="religion"]').find(':selected').text();
                    $('#personalForm select[name="race"]').attr('disabled', true);
                    if(data.detail.ref_race_code) { $('#personalForm select[name="race"]').val(data.detail.ref_race_code).trigger('change'); }
                    else { selectionNull('race', 'personalForm'); }
                    originalVal['race'] = $('#personalForm select[name="race"]').find(':selected').text();

                    $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                    $('#personalForm input[name="date_of_birth"]').val(data.detail.date_of_birth ? data.detail.date_of_birth : data_not_available);
                    originalVal['date_of_birth'] = data.detail.date_of_birth;

                    $('#personalForm select[name="marital_status"]').attr('disabled', true);
                    if(data.detail.ref_marital_status_code) { $('#personalForm select[name="marital_status"]').val(data.detail.ref_marital_status_code).trigger('change'); }
                    else { selectionNull('marital_status', 'personalForm'); }
                    originalVal['marital_status'] = $('#personalForm select[name="marital_status"]').find(':selected').text();

                    $('#personalForm input[name="phone_number"]').attr('disabled', true);
                     $('#personalForm input[name="phone_number"]').val(data.detail.phone_number ? data.detail.phone_number : data_not_available);
                    originalVal['phone_number'] = data.detail.phone_number;

                    $('#personalForm input[name="email"]').attr('disabled', true);
                    $('#personalForm input[name="email"]').val(data.detail.email ? data.detail.email : data_not_available);
                    originalVal['email'] = data.detail.email;

                    $('#personalForm input[name="personal_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_1"]').val(data.detail.permanent_address_1 ? data.detail.permanent_address_1 : data_not_available);
                    // data.detail.permanent_address_1 ? '' : $('#alamatForm input[name="permanent_address_1"]').css('color', 'maroon');
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
                    if(data.detail.permanent_ref_state_code) { $('#alamatForm select[name="permanent_state"]').val(data.detail.permanent_ref_state_code).trigger('change'); }
                    else { selectionNull('permanent_state', 'alamatForm'); }
                    originalVal['permanent_state'] = $('#alamatForm select[name="permanent_state"]').find(':selected').text();
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
                    if(data.detail.ref_state_code) { $('#alamatForm select[name="state"]').val(data.detail.ref_state_code).trigger('change'); }
                    else { selectionNull('state', 'alamatForm'); }
                    originalVal['state'] = $('#alamatForm select[name="state"]').find(':selected').text();
                    $('#alamatForm input[name="alamat_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.place_of_birth) { $('#tempatLahirForm select[name="place_of_birth"]').val(data.detail.place_of_birth).trigger('change'); }
                    else { selectionNull('place_of_birth', 'tempatLahirForm'); }
                    originalVal['place_of_birth'] = $('#tempatLahirForm select[name="place_of_birth"]').find(':selected').text();
                    if(data.detail.father_place_of_birth) { $('#tempatLahirForm select[name="father_place_of_birth"]').val(data.detail.father_place_of_birth).trigger('change'); }
                    else { selectionNull('father_place_of_birth', 'tempatLahirForm'); }
                    originalVal['father_place_of_birth'] = $('#tempatLahirForm select[name="father_place_of_birth"]').find(':selected').text();
                    if(data.detail.mother_place_of_birth) { $('#tempatLahirForm select[name="mother_place_of_birth"]').val(data.detail.mother_place_of_birth).trigger('change'); }
                    else { selectionNull('mother_place_of_birth', 'tempatLahirForm'); }
                    originalVal['mother_place_of_birth'] = $('#tempatLahirForm select[name="mother_place_of_birth"]').find(':selected').text();
                    $('#tempatLahirForm input[name="tempat_lahir_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.license != null) {
                        $('#lesenMemanduForm input[name="license_type"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_type"]').val(data.detail.license.type ? data.detail.license.type : data_not_available);
                        originalVal['license_type'] = data.detail.license.type;
                        $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_expiry_date"]').val(data.detail.license.expiry_date ? data.detail.license.expiry_date : data_not_available);
                        originalVal['license_expiry_date'] = data.detail.license.expiry_date;
                        $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', true);
                        if(data.detail.license.is_blacklist) { $('#lesenMemanduForm select[name="license_blacklist_status"]').val(data.detail.license.is_blacklist).trigger('change'); }
                        else { selectionNull('license_blacklist_status', 'lesenMemanduForm'); }
                        originalVal['license_blacklist_status'] = $('#lesenMemanduForm select[name="license_blacklist_status"]').find(':selected').text();
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', true);
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').val(data.detail.license.blacklist_details ? data.detail.license.blacklist_details : data_not_available);
                        originalVal['license_blacklist_details'] = data.detail.license.blacklist_details;
                    }else{
                        $('#lesenMemanduForm input[name="license_type"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_type"]').val(data_not_available);
                        originalVal['license_type'] = "";
                        $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_expiry_date"]').val(data_not_available);
                        originalVal['license_expiry_date'] = "";
                        $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', true);
                        selectionNull('license_blacklist_status', 'lesenMemanduForm');
                        originalVal['license_blacklist_status'] = "";
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', true);
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').val(data_not_available);
                        originalVal['license_blacklist_details'] = "";
                    }
                    $('#lesenMemanduForm input[name="lesen_memandu_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.oku != null) {
                        $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
                        $('#okuForm input[name="oku_registration_no"]').val(data.detail.oku.no_registration ? data.detail.oku.no_registration : data_not_available);
                        originalVal['oku_registration_no'] = data.detail.oku.no_registration;
                        $('#okuForm input[name="oku_status"]').attr('disabled', true);
                        $('#okuForm input[name="oku_status"]').val(data.detail.oku.status ? data.detail.oku.status : data_not_available);
                        originalVal['oku_status'] = data.detail.oku.status;
                        // $('#okuForm input[name="oku_category"]').attr('disabled', true);
                        if(data.detail.oku.category) { $('#okuForm select[name="oku_category"]').val(data.detail.oku.category).trigger('change'); }
                        else { selectionNull('oku_category', 'okuForm'); }
                        originalVal['oku_category'] = $('#okuForm select[name="oku_category"]').find(':selected').text();
                        $('#okuForm input[name="oku_sub"]').attr('disabled', true);
                        $('#okuForm input[name="oku_sub"]').val(data.detail.oku.sub ? data.detail.oku.sub : data_not_available);
                        originalVal['oku_sub'] = data.detail.oku.sub;
                    }else{
                        $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
                        $('#okuForm input[name="oku_registration_no"]').val(data_not_available);
                        originalVal['oku_registration_no'] = "";
                        $('#okuForm input[name="oku_status"]').attr('disabled', true);
                        $('#okuForm input[name="oku_status"]').val(data_not_available);
                        originalVal['oku_status'] = "";
                        // $('#okuForm input[name="oku_category"]').attr('disabled', true);
                        selectionNull('oku_category', 'okuForm');
                        originalVal['oku_category'] = "";
                        $('#okuForm input[name="oku_sub"]').attr('disabled', true);
                        $('#okuForm input[name="oku_sub"]').val(data_not_available);
                        originalVal['oku_sub'] = "";
                    }
                    $('#okuForm input[name="oku_no_pengenalan"]').val(data.detail.no_pengenalan);

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
                            trSkim += '<td>' + (item.register_date ? item.register_date : '') + '</td>';
                            trSkim += '<td>' + (item.expiry_date ? item.expiry_date : '') + '</td>';
                            trSkim += '<td>' + (item.interview_centre ? item.interview_centre.nama : '') + '</td>';
                            trSkim += '</tr>';
                        });
                }
                    $('#table-skim tbody').append(trSkim);

                    $('#pmrForm input[name="pmr_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-pmr tbody').empty();
                    reloadPmr();

                    $('#spmForm input[name="spm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-spm tbody').empty();
                    reloadSpm();

                    $('#spmvForm input[name="spmv_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-spmv tbody').empty();
                    reloadSpmv();

                    $('#svmForm input[name="svm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-svm tbody').empty();
                    reloadSvm();

                    $('#stpmForm input[name="stpm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stpm tbody').empty();
                    reloadStpm();

                    $('#stamForm input[name="stam_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stam tbody').empty();
                    reloadStam();

                    $('#matrikulasiForm input[name="matrikulasi_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-matrikulasi tbody').empty();
                    reloadMatrikulasi();

                    $('#skmForm input[name="skm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-skm tbody').empty();
                    reloadSkm();

                    $('#pengajianTinggiForm input[name="pengajian_tinggi_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.higher_education != null) {
                        if(data.detail.higher_education.peringkat_pengajian) { $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').val(data.detail.higher_education.peringkat_pengajian).trigger('change'); }
                        else { selectionNull('peringkat_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['peringkat_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val(data.detail.higher_education.year ? data.detail.higher_education.year : data_not_available);
                        originalVal['tahun_pengajian_tinggi'] = data.detail.higher_education.year;
                        if(data.detail.higher_education.ref_eligibility_code) { $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val(data.detail.higher_education.ref_eligibility_code).trigger('change'); }
                        else { selectionNull('kelayakan_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['kelayakan_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val(data.detail.higher_education.cgpa ? data.detail.higher_education.cgpa : data_not_available);
                        originalVal['cgpa_pengajian_tinggi'] = data.detail.higher_education.cgpa;
                        if(data.detail.higher_education.ref_institution_code) { $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val(data.detail.higher_education.ref_institution_code).trigger('change'); }
                        else { selectionNull('institusi_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['institusi_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val(data.detail.higher_education.nama_sijil ? data.detail.higher_education.nama_sijil : data_not_available);
                        originalVal['nama_sijil_pengajian_tinggi'] = data.detail.higher_education.nama_sijil;
                        if(data.detail.higher_education.ref_specialization_code) { $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val(data.detail.higher_education.ref_specialization_code).trigger('change'); }
                        else { selectionNull('pengkhususan_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['pengkhususan_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').find(':selected').text();
                        if(data.detail.higher_education.ins_fln) { $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val(data.detail.higher_education.ins_fln).trigger('change'); }
                        else { selectionNull('fln_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['fln_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val(data.detail.higher_education.tarikh_senat ? data.detail.higher_education.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_pengajian_tinggi'] = data.detail.higher_education.tarikh_senat;
                        if(data.detail.higher_education.biasiswa) { $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val(data.detail.higher_education.biasiswa).trigger('change'); }
                        else { selectionNull('biasiswa_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['biasiswa_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').find(':selected').text();
                    }else{
                        selectionNull('peringkat_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['peringkat_pengajian_tinggi'] = '';
                        $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val(data_not_available);
                        originalVal['tahun_pengajian_tinggi'] = '';
                        selectionNull('kelayakan_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['kelayakan_pengajian_tinggi'] = '';
                        $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val(data_not_available);
                        originalVal['cgpa_pengajian_tinggi'] = '';
                        selectionNull('institusi_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['institusi_pengajian_tinggi'] = '';
                        $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val(data_not_available);
                        originalVal['nama_sijil_pengajian_tinggi'] = '';
                        selectionNull('pengkhususan_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['pengkhususan_pengajian_tinggi'] = '';
                        selectionNull('fln_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['fln_pengajian_tinggi'] = '';
                        $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val(data_not_available);
                        originalVal['tarikh_senat_pengajian_tinggi'] = '';
                        selectionNull('biasiswa_pengajian_tinggi', 'pengajianTinggiForm');
                        originalVal['biasiswa_pengajian_tinggi'] = '';
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
                            trProfessional += '<td>' + (item.specialization ? item.specialization.name : '') + '</td>';
                            trProfessional += '<td>' + (item.date ? item.date : '') + '</td>';
                            trProfessional += '</tr>';
                        });
                    }
                    $('#table-professional tbody').append(trProfessional);

                    $('#experienceForm input[name="experience_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.experience != null) {
                        $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.experience.date_appoint ? data.detail.experience.date_appoint : data_not_available);
                        originalVal['experience_appoint_date'] = data.detail.experience.date_appoint;
                        if(data.detail.experience.ref_position_level_code) { $('#experienceForm select[name="experience_position_level"]').val(data.detail.experience.ref_position_level_code).trigger('change'); }
                        else { selectionNull('experience_position_level', 'experienceForm'); }
                        originalVal['experience_position_level'] = $('#experienceForm select[name="experience_position_level"]').find(':selected').text();
                        if(data.detail.experience.ref_skim_code) { $('#experienceForm select[name="experience_skim"]').val(data.detail.experience.ref_skim_code).trigger('change'); }
                        else { selectionNull('experience_skim', 'experienceForm'); }
                        originalVal['experience_skim'] = $('#experienceForm select[name="experience_skim"]').find(':selected').text();
                        $('#experienceForm input[name="experience_start_date"]').val(data.detail.experience.date_start ? data.detail.experience.date_start : data_not_available);
                        originalVal['experience_start_date'] = data.detail.experience.date_start;
                        $('#experienceForm input[name="experience_verify_date"]').val(data.detail.experience.date_verify ? data.detail.experience.date_verify : data_not_available);
                        originalVal['experience_verify_date'] = data.detail.experience.date_verify;
                        if(data.detail.experience.ref_department_ministry_code) { $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.experience.ref_department_ministry_code).trigger('change'); }
                        else { selectionNull('experience_department_ministry', 'experienceForm'); }
                        originalVal['experience_department_ministry'] = $('#experienceForm select[name="experience_department_ministry"]').find(':selected').text();
                        if(data.detail.experience.state_department) { $('#experienceForm select[name="experience_department_state"]').val(data.detail.experience.state_department).trigger('change'); }
                        else { selectionNull('experience_department_state', 'experienceForm'); }
                        originalVal['experience_department_state'] = $('#experienceForm select[name="experience_department_state"]').find(':selected').text();
                    }else{
                        $('#experienceForm input[name="experience_appoint_date"]').val(data_not_available);
                        originalVal['experience_appoint_date'] = '';
                        selectionNull('experience_position_level', 'experienceForm');
                        originalVal['experience_position_level'] = '';
                        selectionNull('experience_skim', 'experienceForm');
                        originalVal['experience_skim'] = '';
                        $('#experienceForm input[name="experience_start_date"]').val(data_not_available);
                        originalVal['experience_start_date'] = '';
                        $('#experienceForm input[name="experience_verify_date"]').val(data_not_available);
                        originalVal['experience_verify_date'] = '';
                        selectionNull('experience_department_ministry', 'experienceForm');
                        originalVal['experience_department_ministry'] = '';
                        selectionNull('experience_department_state', 'experienceForm');
                        originalVal['experience_department_state'] = '';
                    }

                    $('#pslForm input[name="psl_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-psl tbody').empty();
                    reloadPsl();

                    $('#tenteraPolisForm input[name="tentera_polis_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.army_police != null){
                        if(data.detail.army_police.type_service) {
                            $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').val(data.detail.army_police.type_service).trigger('change');
                        }
                        else {
                            selectionNull('jenis_perkhidmatan_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['jenis_perkhidmatan_tentera_polis'] = $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').find(':selected').text();
                        if(data.detail.army_police.ref_rank_code) {
                            $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').val(data.detail.army_police.ref_rank_code).trigger('change');
                        }
                        else {
                            selectionNull('pangkat_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['pangkat_tentera_polis'] = $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').find(':selected').text();
                        if(data.detail.army_police.type_army_police) {
                            $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').val(data.detail.army_police.type_army_police).trigger('change');
                        }
                        else {
                            selectionNull('jenis_bekas_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['jenis_bekas_tentera_polis'] = $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').find(':selected').text();
                    } else {
                        selectionNull('jenis_perkhidmatan_tentera_polis', 'tenteraPolisForm');
                        originalVal['jenis_perkhidmatan_tentera_polis'] = '';
                        selectionNull('pangkat_tentera_polis', 'tenteraPolisForm');
                        originalVal['pangkat_tentera_polis'] = '';
                        selectionNull('jenis_bekas_tentera_polis', 'tenteraPolisForm');
                        originalVal['jenis_bekas_tentera_polis'] = '';
                    }

                    $('#bahasaForm input[name="bahasa_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-language tbody').empty();
                    reloadBahasa();

                    $('#bakatForm input[name="bakat_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-talent tbody').empty();
                    reloadBakat();

                    $('#penaltyForm input[name="penalty_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-penalty tbody').empty();
                    reloadPenalty();

                },
                error: function(data) {

                    $('#update_personal').attr("style", "display:none");
                    $('#update_alamat').attr("style", "display:none");
                    $('#update_tempat_lahir').attr("style", "display:none");
                    $('#update_pmr').attr("style", "display:none");
                    $('#update_pengajian_tinggi').attr("style", "display:none");
                    $('#update_experience').attr("style", "display:none");
                    $('#update_tentera_polis').attr("style", "display:none");
                    $('#update_penalty').attr("style", "display:none");
                    $('#update_lesen_memandu').attr("style", "display:none");
                    $('#update_oku').attr("style", "display:none");

                    $("#button_action_personal").attr("style", "display:none");
                    $("#button_action_alamat").attr("style", "display:none");
                    $("#button_action_tempat_lahir").attr("style", "display:none");
                    $("#button_action_pmr").attr("style", "display:none");
                    $("#button_action_pengajian_tinggi").attr("style", "display:none");
                    $("#button_action_experience").attr("style", "display:none");
                    $("#button_action_tentera_polis").attr("style", "display:none");
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

                    $('#license_type').val('');
                    $('#license_expiry_date').val('');
                    $('#license_blacklist_status').val('').trigger('change');
                    $('#license_blacklist_details').val('');

                    $('#oku_registration_no').val('');
                    $('#oku_status').val('');
                    $('#oku_category').val('');
                    $('#oku_sub').val('');

                    $('#table-skim tbody').empty();

                    $('#pmrForm select[name="subjek_pmr"]').attr('disabled', true);
                    $('#pmrForm select[name="subjek_pmr"]').val('').trigger('change');
                    $('#pmrForm select[name="gred_pmr"]').attr('disabled', true);
                    $('#pmrForm select[name="gred_pmr"]').val('').trigger('change');
                    $('#pmrForm input[name="tahun_pmr"]').attr('disabled', true);
                    $('#pmrForm input[name="tahun_pmr"]').val('');
                    $('#pmrForm input[name="pmr_no_pengenalan"]').val('');

                    $('#table-pmr tbody').empty();

                    $('#table-spm tbody').empty();

                    $('#table-spmv tbody').empty();

                    $('#table-svm tbody').empty();

                    $('#table-stpm tbody').empty();

                    $('#table-stam tbody').empty();

                    $('#table-matriculation tbody').empty();

                    $('#table-skm tbody').empty();

                    $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="peringkat_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val('');
                    $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val('');
                    $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val('');
                    $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val('');
                    $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val('').trigger('change');
                    $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').attr('disabled', true);
                    $('#pengajianTinggiForm input[name="pengajian_tinggi_no_pengenalan"]').val('');

                    $('#table-professional tbody').empty();

                    $('#experienceForm input[name="experience_appoint_date"]').val('');
                    $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_position_level"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_skim"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_skim"]').attr('disabled', true);
                    $('#experienceForm input[name="experience_start_date"]').val('');
                    $('#experienceForm input[name="experience_start_date"]').attr('disabled', true);
                    $('#experienceForm input[name="experience_verify_date"]').val('');
                    $('#experienceForm input[name="experience_verify_date"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_department_ministry"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_department_ministry"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_department_state"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_department_state"]').attr('disabled', true);
                    $('#experienceForm input[name="experience_no_pengenalan"]').val('');

                    $('#table-psl tbody').empty();

                    $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').val('').trigger('change');
                    $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').attr('disabled', true);
                    $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').val('').trigger('change');
                    $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').attr('disabled', true);
                    $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').val('').trigger('change');
                    $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').attr('disabled', true);
                    $('#tenteraPolisForm input[name="tentera_polis_no_pengenalan"]').val('');

                    $('#table-language tbody').empty();

                    $('#table-talent tbody').empty();

                    $('#penaltyForm select[name="penalty"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_duration"]').attr('disabled', true);
                    $('#penaltyForm select[name="penalty_type"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_start"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('disabled', true);
                    $('#penaltyForm input[name="penalty_end"]').attr('readonly', false);
                    $('#penaltyForm input[name="penalty_no_pengenalan"]').val('');

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

    function getSuggestions(inputValue) {
        if(inputValue.length > 0){
            $.ajax({
        url: '{{ route("get_suggestions") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            input_value: inputValue
        },
        success: function(data) {
            displaySuggestions(data)
        },
        error: function(error) {
            console.error('Error fetching suggestions:', error);
        }
    });
        }else{
            $('.suggestions-container').hide();
        }

}

function displaySuggestions(suggestions) {
    var container = $('.suggestions-container');
    container.empty();
    if (suggestions.length > 0) {
        suggestions.forEach(function(suggestion) {
            container.append('<div class="suggestion" data-value="'+ suggestion.no_ic +'">' + suggestion.full_name + '</div>');
        });
        container.show();
    } else {
        container.append('<div class="suggestion"> Tiada Carian </div>');
        container.show();
    }
}

$(document).on('click', '.suggestion', function() {
    var suggestionValue = $(this).data('value');
    var suggestionText = $(this).text();
    $('#selected_ic').val(suggestionValue);
    $('#search_ic').val(suggestionText);
    $('.suggestions-container').hide();
});
</script>
@endsection
