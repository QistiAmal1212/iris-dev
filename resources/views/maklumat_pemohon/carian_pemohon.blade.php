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
    /* .suggestions-container {
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
    } */

</style>
<section id="faq-search-filter">
    <div class="card faq-search" style="background-image: url('{{asset('images/banner/banner.png')}}')">
        <div class="card-body text-center">
            <h2 class="text-primary">Carian Maklumat Pemohon</h2>
            <p class="card-text mb-2">Isikan no. kad pengenalan calon dan tekan butang Cari</p>

            <div>
                <button id="btn-selectkp" class="btn btn-primary waves-effect" type="button" onclick="selectSearch('carian_kp')" >Carian Menggunakan No. Kad Pengenalan</button>
                <button id="btn-selectname" class="btn btn-secondary waves-effect" type="button" onclick="selectSearch('carian_nama')" >Carian Menggunakan Nama</button>
            </div><br>


            <div class="faq-search-input">
                <div class="input-group input-group-merge">
                    <div class="input-group-text" id="search-icon">
                        <i data-feather="search"></i>
                    </div>

                    {{-- Search form --}}
                        <input type="text" class="form-control" id="search_ic" maxlength="12" placeholder=" No. Kad Pegenalan Calon"/>
                        <input type="text" class="form-control" id="pilihan_carian" value="carian_kp" hidden/>
                        <button class="btn btn-primary waves-effect" id="button_cari" type="button" onclick="searchCandidate()" >Cari</button>
                        <button class="btn btn-primary waves-effect" id="btn_carian" type="button" onclick="carianPemohon()" hidden>Cari</button>

                        <div class="suggestions-container"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<hr>

<div id="divCarian" style="display:none">
    <div class="card">
        <div class="card-header">
            Carian Pemohon
            <a data-bs-toggle="collapse" href="#listPemohon"><i data-feather="chevron-down"></i></a>
        </div>
        <div class="card-body" id="listPemohon">
            <div class="table-responsive" id="append-data">

            </div>
        </div>
    </div>
</div>

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
                    <ul class="nav nav-tabs nav-justified" role="tablist">
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
    function selectSearch(btnValue){
        $('#pilihan_carian').val(btnValue);
        reset();
        $('#search_ic').val('');
        if(btnValue == 'carian_nama'){
            $('#btn-selectkp').removeClass('btn-primary').addClass('btn-secondary');
            $('#btn-selectname').removeClass('btn-secondary').addClass('btn-primary');
            $('#button_cari').attr('hidden', true);
            $('#btn_carian').attr('hidden', false);
            $('#search_ic').attr('placeholder', ' Nama Calon');
            $('#search_ic').attr('minlength', '3');
            $('#search_ic').removeAttr('maxlength');
            $("#divCarian").attr("style", "display:block");
        }else{
            // $('#table-carian').DataTable().destroy();
            // $("#table-carian > tbody").html("");
            $('#btn-selectname').removeClass('btn-primary').addClass('btn-secondary');
            $('#btn-selectkp').removeClass('btn-secondary').addClass('btn-primary');
            $('#button_cari').attr('hidden', false);
            $('#btn_carian').attr('hidden', true);
            $('#search_ic').attr('placeholder', ' No. Kad Pegenalan Calon');
            $('#search_ic').attr('maxlength', '12');
            $('#search_ic').removeAttr('minlength');
            $("#divCarian").attr("style", "display:none");
        }
    }

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
            for (var key in originalVal) {
                if (originalVal.hasOwnProperty(key)) {
                    if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
                        originalVal[key] = newValues[key];
                    }
                }
            }
        }
        })
    }

    function carianPemohon() {
        search_nama = $('#search_ic').val();

        if(search_nama == ''){
            Swal.fire('Gagal', 'Sila isikan nama', 'error');
        } else if (search_nama.length < 3){
            Swal.fire('Gagal', 'Sila isikan sekurang-kurangnya 3 huruf', 'error');
        } else {
            $.ajax({
                url: "{{ route('list-carian') }}",
                method: 'GET',
                async: true,
                data : {
                    search_nama : search_nama,
                },
                success: function(data) {
                    $('#append-data').empty();
                    $('#append-data').append(data);
                }
            });
        }
    }

    function updatePage(id, total_pages) {
        if (id == total_pages) {
            return false;
        }
        if (id == 0) {
            return false;
        }
        $.ajax({
            url: "{{ route('list-carian') }}",
            method: 'GET',
            async: true,
            data : {
                search_nama : search_nama,
                page: id,
                total_pages: total_pages
            },
            success: function(data) {
                $('#append-data').empty();
                $('#append-data').append(data);
            }
        });
    }

    searchCandidate = function(carian = null) {

        if(carian === null){
            search_ic = $('#search_ic').val();
        } else {
            search_ic = carian
        }

        if(search_ic == ''){
            Swal.fire('Gagal', 'Sila isikan no kad pengenalan', 'error');
        } else {
            $.ajax({
                url: "{{ route('get-candidate-details') }}",
                method: 'POST',
                async: true,
                data : {
                    no_ic : search_ic,
                },
                success: function(data) {
                    var container = $('.suggestions-container');
                    container.hide();
                    $('#update_personal').attr("style", "display:block");
                    $('#update_alamat_tetap').attr("style", "display:block");
                    $('#update_alamat_surat').attr("style", "display:block");
                    $('#update_tempat_lahir').attr("style", "display:block");
                    $('#update_pusat_temuduga').attr("style", "display:block");
                    $('#update_lesen_memandu').attr("style", "display:block");
                    $('#update_oku').attr("style", "display:block");
                    $('#update_pmr').attr("style", "display:block");
                    $('#update_spm1').attr("style", "display:block");
                    $('#update_spm2').attr("style", "display:block");
                    //$('#update_spmv').attr("style", "display:block");
                    $('#update_svm').attr("style", "display:block");
                    $('#update_stpm1').attr("style", "display:block");
                    $('#update_stpm2').attr("style", "display:block");
                    $('#update_stam1').attr("style", "display:block");
                    $('#update_stam2').attr("style", "display:block");
                    $('#update_skm').attr("style", "display:block");
                    $('#update_matrikulasi').attr("style", "display:block");
                    $('#update_diploma').attr("style", "display:block");
                    $('#update_degree').attr("style", "display:block");
                    $('#update_master').attr("style", "display:block");
                    $('#update_phd').attr("style", "display:block");
                    $('#update_experience').attr("style", "display:block");
                    $('#update_psl').attr("style", "display:block");
                    $('#update_tentera_polis').attr("style", "display:block");
                    $('#update_bahasa').attr("style", "display:block");
                    $('#update_bakat').attr("style", "display:block");
                    $('#update_penalty').attr("style", "display:block");

                    $('#candidate_name').html(data.detail.nama_penuh);
                    $('#candidate_ic').html(data.detail.no_kp_baru);
                    $('#candidate_no_pengenalan').val(data.detail.no_pengenalan);

                    var timelineUrl = "{{ route('timeline.list', ':replaceThis') }}"
                    timelineUrl = timelineUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#candidate_timeline').load(timelineUrl)

                    $('#personalForm select[name="gender"]').attr('disabled', true);
                    if(data.detail.jan_kod) { $('#personalForm select[name="gender"]').val(data.detail.jan_kod).trigger('change'); }
                    else { selectionNull('gender', 'personalForm');}
                    originalVal['gender'] = $('#personalForm select[name="gender"]').find(':selected').text();
                    $('#personalForm select[name="religion"]').attr('disabled', true);
                    if(data.detail.agama) { $('#personalForm select[name="religion"]').val(data.detail.agama).trigger('change'); }
                    else { selectionNull('religion', 'personalForm'); }
                    originalVal['religion'] = $('#personalForm select[name="religion"]').find(':selected').text();
                    $('#personalForm select[name="race"]').attr('disabled', true);
                    if(data.detail.ket_kod) { $('#personalForm select[name="race"]').val(data.detail.ket_kod).trigger('change'); }
                    else { selectionNull('race', 'personalForm'); }
                    originalVal['race'] = $('#personalForm select[name="race"]').find(':selected').text();

                    $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                    $('#personalForm input[name="date_of_birth"]').val(data.detail.tarikh_lahir ? data.detail.tarikh_lahir : data_not_available);
                    originalVal['date_of_birth'] = data.detail.tarikh_lahir;

                    $('#personalForm select[name="marital_status"]').attr('disabled', true);
                    if(data.detail.taraf_perkahwinan) { $('#personalForm select[name="marital_status"]').val(data.detail.taraf_perkahwinan).trigger('change'); }
                    else { selectionNull('marital_status', 'personalForm'); }
                    originalVal['marital_status'] = $('#personalForm select[name="marital_status"]').find(':selected').text();

                    $('#personalForm input[name="phone_number"]').attr('disabled', true);
                    $('#personalForm input[name="phone_number"]').val(data.detail.no_tel ? data.detail.no_tel : data_not_available);
                    originalVal['phone_number'] = data.detail.no_tel;

                    $('#personalForm input[name="email"]').attr('disabled', true);
                    $('#personalForm input[name="email"]').val(data.detail.e_mel ? data.detail.e_mel : data_not_available);
                    originalVal['email'] = data.detail.e_mel;

                    $('#personalForm input[name="personal_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#alamatTetapForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_1"]').val(data.detail.alamat_1_tetap ? data.detail.alamat_1_tetap : data_not_available);
                    originalVal['permanent_address_1'] = data.detail.alamat_1_tetap;
                    $('#alamatTetapForm input[name="permanent_address_2"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_2"]').val(data.detail.alamat_2_tetap ? data.detail.alamat_2_tetap : data_not_available);
                    originalVal['permanent_address_2'] = data.detail.alamat_2_tetap;
                    $('#alamatTetapForm input[name="permanent_address_3"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_3"]').val(data.detail.alamat_3_tetap ? data.detail.alamat_3_tetap : data_not_available);
                    originalVal['permanent_address_3'] = data.detail.alamat_3_tetap;
                    $('#alamatTetapForm input[name="permanent_poscode"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_poscode"]').val(data.detail.poskod_tetap ? data.detail.poskod_tetap : data_not_available);
                    originalVal['permanent_poscode'] = data.detail.poskod_tetap;
                    $('#alamatTetapForm input[name="permanent_city"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_city"]').val(data.detail.bandar_tetap ? data.detail.bandar_tetap : data_not_available);
                    originalVal['permanent_city'] = data.detail.bandar_tetap;
                    $('#alamatTetapForm select[name="permanent_state"]').attr('disabled', true);
                    if(data.detail.tempat_tinggal_tetap) { $('#alamatTetapForm select[name="permanent_state"]').val(data.detail.tempat_tinggal_tetap).trigger('change'); }
                    else { selectionNull('permanent_state', 'alamatTetapForm'); }
                    originalVal['permanent_state'] = $('#alamatTetapForm select[name="permanent_state"]').find(':selected').text();
                    $('#alamatTetapForm input[name="alamat_tetap_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#alamatSuratForm input[name="address_1"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_1"]').val(data.detail.alamat_1 ? data.detail.alamat_1 : data_not_available);
                    originalVal['address_1'] = data.detail.alamat_1;
                    $('#alamatSuratForm input[name="address_2"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_2"]').val(data.detail.alamat_2 ? data.detail.alamat_2 : data_not_available);
                    originalVal['address_2'] = data.detail.alamat_2;
                    $('#alamatSuratForm input[name="address_3"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_3"]').val(data.detail.alamat_3 ? data.detail.alamat_3 : data_not_available);
                    originalVal['address_3'] = data.detail.alamat_3;
                    $('#alamatSuratForm input[name="poscode"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="poscode"]').val(data.detail.poskod ? data.detail.poskod : data_not_available);
                    originalVal['poscode'] = data.detail.poskod;
                    $('#alamatSuratForm input[name="city"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="city"]').val(data.detail.bandar ? data.detail.bandar : data_not_available);
                    originalVal['city'] = data.detail.bandar;
                    $('#alamatSuratForm select[name="state"]').attr('disabled', true);
                    if(data.detail.tempat_tinggal) { $('#alamatSuratForm select[name="state"]').val(data.detail.tempat_tinggal).trigger('change'); }
                    else { selectionNull('state', 'alamatSuratForm'); }
                    originalVal['state'] = $('#alamatSuratForm select[name="state"]').find(':selected').text();
                    $('#alamatSuratForm input[name="alamat_surat_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.tempat_lahir) { $('#tempatLahirForm select[name="place_of_birth"]').val(data.detail.tempat_lahir).trigger('change'); }
                    else { selectionNull('place_of_birth', 'tempatLahirForm'); }
                    originalVal['place_of_birth'] = $('#tempatLahirForm select[name="place_of_birth"]').find(':selected').text();
                    if(data.detail.tempat_lahir_bapa) { $('#tempatLahirForm select[name="father_place_of_birth"]').val(data.detail.tempat_lahir_bapa).trigger('change'); }
                    else { selectionNull('father_place_of_birth', 'tempatLahirForm'); }
                    originalVal['father_place_of_birth'] = $('#tempatLahirForm select[name="father_place_of_birth"]').find(':selected').text();
                    if(data.detail.tempat_lahir_ibu) { $('#tempatLahirForm select[name="mother_place_of_birth"]').val(data.detail.tempat_lahir_ibu).trigger('change'); }
                    else { selectionNull('mother_place_of_birth', 'tempatLahirForm'); }
                    originalVal['mother_place_of_birth'] = $('#tempatLahirForm select[name="mother_place_of_birth"]').find(':selected').text();
                    $('#tempatLahirForm input[name="tempat_lahir_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.license != null) {
                        $('#lesenMemanduForm input[name="license_type"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_type"]').val(data.detail.license.jenis_lesen ? data.detail.license.jenis_lesen : data_not_available);
                        originalVal['license_type'] = data.detail.license.jenis_lesen;
                        $('#lesenMemanduForm input[name="license_expiry_date"]').attr('disabled', true);
                        $('#lesenMemanduForm input[name="license_expiry_date"]').val(data.detail.license.tempoh_tamat ? data.detail.license.tempoh_tamat : data_not_available);
                        originalVal['license_expiry_date'] = data.detail.license.tempoh_tamat;
                        $('#lesenMemanduForm select[name="license_blacklist_status"]').attr('disabled', true);
                        if(data.detail.license.status_senaraihitam) { $('#lesenMemanduForm select[name="license_blacklist_status"]').val(data.detail.license.status_senaraihitam).trigger('change'); }
                        else { selectionNull('license_blacklist_status', 'lesenMemanduForm'); }
                        originalVal['license_blacklist_status'] = $('#lesenMemanduForm select[name="license_blacklist_status"]').find(':selected').text();
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').attr('disabled', true);
                        $('#lesenMemanduForm textarea[name="license_blacklist_details"]').val(data.detail.license.msg_senaraihitam ? data.detail.license.msg_senaraihitam : data_not_available);
                        originalVal['license_blacklist_details'] = data.detail.license.msg_senaraihitam;
                        var tmLesenElement = $("#tm_lesen");
                        tmLesenElement.attr("hidden", true);
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
                        var tmLesenElement = $("#tm_lesen");
                        tmLesenElement.removeAttr("hidden");
                    }
                    $('#lesenMemanduForm input[name="lesen_memandu_no_pengenalan"]').val(data.detail.no_pengenalan);

                    if(data.detail.oku != null) {
                        $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
                        $('#okuForm input[name="oku_registration_no"]').val(data.detail.oku.no_daftar_jkm ? data.detail.oku.no_daftar_jkm : data_not_available);
                        originalVal['oku_registration_no'] = data.detail.oku.no_daftar_jkm;
                        $('#okuForm input[name="oku_status"]').attr('disabled', true);
                        $('#okuForm input[name="oku_status"]').val(data.detail.oku.status_oku ? data.detail.oku.status_oku : data_not_available);
                        originalVal['oku_status'] = data.detail.oku.status_oku;
                        // $('#okuForm input[name="oku_category"]').attr('disabled', true);
                        if(data.detail.oku.kategori_oku) { $('#okuForm select[name="oku_category"]').val(data.detail.oku.kategori_oku).trigger('change'); }
                        else { selectionNull('oku_category', 'okuForm'); }
                        originalVal['oku_category'] = $('#okuForm select[name="oku_category"]').find(':selected').text();
                        $('#okuForm input[name="oku_sub"]').attr('disabled', true);
                        $('#okuForm input[name="oku_sub"]').val(data.detail.oku.sub_oku ? data.detail.oku.sub_oku : data_not_available);
                        originalVal['oku_sub'] = data.detail.oku.sub_oku;
                        var tmOkuElement = $("#tm_oku");
                        tmOkuElement.attr("hidden", true);
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
                        var tmOkuElement = $("#tm_oku");
                        tmOkuElement.removeAttr("hidden");
                    }
                    $('#okuForm input[name="oku_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#pusatTemudugaForm input[name="pusat_temuduga_no_pengenalan"]').val(data.detail.no_pengenalan)
                    $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', true);

                    if(data.detail.pusat_temuduga) {
                        $('#pusatTemudugaForm select[name="pusat_temuduga"]').val(data.detail.pusat_temuduga).trigger('change');
                    } else {
                        selectionNull('pusat_temuduga', 'pusatTemudugaForm');
                    }
                    originalVal['pusat_temuduga'] = $('#pusatTemudugaForm select[name="pusat_temuduga"]').find(':selected').text();

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
                            trSkim += '<td>' + item.ski_kod + '</td>'
                            trSkim += '<td>' + item.skim.diskripsi + '</td>';
                            trSkim += '<td>' + (item.tarikhCipta ? item.tarikhCipta : '') + '</td>';
                            trSkim += '<td>' + (item.tarikh_daftar ? item.tarikh_daftar : '') + '</td>';
                            trSkim += '<td>' + (item.tarikh_luput ? item.tarikh_luput : '') + '</td>';
                            trSkim += '</tr>';
                        });
                    }

                    $('#table-skim tbody').append(trSkim);

                    $('#pmrForm input[name="pmr_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-pmr tbody').empty();
                    reloadPmr();

                    $('#spm1Form input[name="spm1_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-spm1 tbody').empty();
                    reloadSpm1();

                    $('#spm2Form input[name="spm2_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-spm2 tbody').empty();
                    reloadSpm2();

                    //$('#spmvForm input[name="spmv_no_pengenalan"]').val(data.detail.no_pengenalan);
                    //$('#table-spmv tbody').empty();
                    //reloadSpmv();

                    $('#svmForm input[name="svm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-svm tbody').empty();
                    reloadSvm();

                    $('#stpm1Form input[name="stpm1_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stpm1 tbody').empty();
                    reloadStpm1();

                    $('#stpm2Form input[name="stpm2_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stpm2 tbody').empty();
                    reloadStpm2();

                    $('#stam1Form input[name="stam1_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stam1 tbody').empty();
                    reloadStam1();

                    $('#stam2Form input[name="stam2_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-stam2 tbody').empty();
                    reloadStam2();

                    $('#matrikulasiForm input[name="matrikulasi_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-matrikulasi tbody').empty();
                    reloadMatrikulasi();

                    $('#skmForm input[name="skm_no_pengenalan"]').val(data.detail.no_pengenalan);
                    $('#table-skm tbody').empty();
                    reloadSkm();

                    $('#diplomaForm input[name="diploma_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.diploma != null) {
                        
                        $('#diplomaForm input[name="tahun_diploma"]').val(data.detail.diploma.tahun_lulus ? data.detail.diploma.tahun_lulus : data_not_available);
                        originalVal['tahun_diploma'] = data.detail.diploma.tahun_lulus;

                        if(data.detail.diploma.kel_kod) { 
                            $('#diplomaForm select[name="kelayakan_diploma"]').val(data.detail.diploma.kel_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('kelayakan_diploma', 'diplomaForm'); 
                        }
                        originalVal['kelayakan_diploma'] = $('#diplomaForm select[name="kelayakan_diploma"]').find(':selected').text();

                        $('#diplomaForm input[name="cgpa_diploma"]').val(data.detail.diploma.cgpa ? data.detail.diploma.cgpa : data_not_available);
                        originalVal['cgpa_diploma'] = data.detail.diploma.cgpa;

                        if(data.detail.diploma.ins_kod) { 
                            $('#diplomaForm select[name="institusi_diploma"]').val(data.detail.diploma.ins_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('institusi_diploma', 'diplomaForm'); 
                        }
                        originalVal['institusi_diploma'] = $('#diplomaForm select[name="institusi_diploma"]').find(':selected').text();
                        
                        $('#diplomaForm input[name="nama_sijil_diploma"]').val(data.detail.diploma.nama_sijil ? data.detail.diploma.nama_sijil : data_not_available);
                        originalVal['kod_ruj_pengkhususan'] = data.detail.diploma.nama_sijil;
                        
                        if(data.detail.diploma.pen_kod) { 
                            $('#diplomaForm select[name="pengkhususan_diploma"]').val(data.detail.diploma.pen_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('pengkhususan_diploma', 'diplomaForm'); 
                        }
                        originalVal['pengkhususan_diploma'] = $('#diplomaForm select[name="pengkhususan_diploma"]').find(':selected').text();
                        
                        if(data.detail.diploma.ins_fln) { 
                            $('#diplomaForm select[name="fln_diploma"]').val(data.detail.diploma.ins_fln).trigger('change'); 
                        }
                        else { 
                            selectionNull('fln_diploma', 'diplomaForm'); 
                        }
                        originalVal['fln_diploma'] = $('#diplomaForm select[name="fln_diploma"]').find(':selected').text();
                        
                        $('#diplomaForm input[name="tarikh_senat_diploma"]').val(data.detail.diploma.tarikh_senat ? data.detail.diploma.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_diploma'] = data.detail.diploma.tarikh_senat;
                        
                        if(data.detail.diploma.biasiswa != null) { 
                            $('#diplomaForm select[name="biasiswa_diploma"]').val((data.detail.diploma.biasiswa == true) ? 1 : 0).trigger('change'); 
                        }
                        else { 
                            selectionNull('biasiswa_diploma', 'diplomaForm'); 
                        }
                        originalVal['biasiswa_diploma'] = $('#diplomaForm select[name="biasiswa_diploma"]').find(':selected').text();
                    }else{
                        $('#diplomaForm input[name="tahun_diploma"]').val(data_not_available);
                        originalVal['tahun_diploma'] = '';
                        selectionNull('kelayakan_diploma', 'diplomaForm');
                        originalVal['kelayakan_diploma'] = '';
                        $('#diplomaForm input[name="cgpa_diploma"]').val(data_not_available);
                        originalVal['cgpa_diploma'] = '';
                        selectionNull('institusi_diploma', 'diplomaForm');
                        originalVal['institusi_diploma'] = '';
                        $('#diplomaForm input[name="nama_sijil_diploma"]').val(data_not_available);
                        originalVal['nama_sijil_diploma'] = '';
                        selectionNull('pengkhususan_diploma', 'diplomaForm');
                        originalVal['pengkhususan_diploma'] = '';
                        selectionNull('fln_diploma', 'diplomaForm');
                        originalVal['fln_diploma'] = '';
                        $('#diplomaForm input[name="tarikh_senat_diploma"]').val(data_not_available);
                        originalVal['tarikh_senat_diploma'] = '';
                        selectionNull('biasiswa_diploma', 'diplomaForm');
                        originalVal['biasiswa_diploma'] = '';
                    }

                    $('#degreeForm input[name="degree_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.degree != null) {
                        
                        $('#degreeForm input[name="tahun_degree"]').val(data.detail.degree.tahun_lulus ? data.detail.degree.tahun_lulus : data_not_available);
                        originalVal['tahun_degree'] = data.detail.degree.tahun_lulus;

                        if(data.detail.degree.kel_kod) { 
                            $('#degreeForm select[name="kelayakan_degree"]').val(data.detail.degree.kel_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('kelayakan_degree', 'degreeForm'); 
                        }
                        originalVal['kelayakan_degree'] = $('#degreeForm select[name="kelayakan_degree"]').find(':selected').text();

                        $('#degreeForm input[name="cgpa_degree"]').val(data.detail.degree.cgpa ? data.detail.degree.cgpa : data_not_available);
                        originalVal['cgpa_degree'] = data.detail.degree.cgpa;

                        if(data.detail.degree.ins_kod) { 
                            $('#degreeForm select[name="institusi_degree"]').val(data.detail.degree.ins_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('institusi_degree', 'degreeForm'); 
                        }
                        originalVal['institusi_degree'] = $('#degreeForm select[name="institusi_degree"]').find(':selected').text();
                        
                        $('#degreeForm input[name="nama_sijil_degree"]').val(data.detail.degree.nama_sijil ? data.detail.degree.nama_sijil : data_not_available);
                        originalVal['kod_ruj_pengkhususan'] = data.detail.degree.nama_sijil;
                        
                        if(data.detail.degree.pen_kod) { 
                            $('#degreeForm select[name="pengkhususan_degree"]').val(data.detail.degree.pen_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('pengkhususan_degree', 'degreeForm'); 
                        }
                        originalVal['pengkhususan_degree'] = $('#degreeForm select[name="pengkhususan_degree"]').find(':selected').text();
                        
                        if(data.detail.degree.ins_fln) { 
                            $('#degreeForm select[name="fln_degree"]').val(data.detail.degree.ins_fln).trigger('change'); 
                        }
                        else { 
                            selectionNull('fln_degree', 'degreeForm'); 
                        }
                        originalVal['fln_degree'] = $('#degreeForm select[name="fln_degree"]').find(':selected').text();
                        
                        $('#degreeForm input[name="tarikh_senat_degree"]').val(data.detail.degree.tarikh_senat ? data.detail.degree.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_degree'] = data.detail.degree.tarikh_senat;
                        
                        if(data.detail.degree.biasiswa != null) { 
                            $('#degreeForm select[name="biasiswa_degree"]').val((data.detail.degree.biasiswa == true) ? 1 : 0).trigger('change'); 
                        }
                        else { 
                            selectionNull('biasiswa_degree', 'degreeForm'); 
                        }
                        originalVal['biasiswa_degree'] = $('#degreeForm select[name="biasiswa_degree"]').find(':selected').text();
                    }else{
                        $('#degreeForm input[name="tahun_degree"]').val(data_not_available);
                        originalVal['tahun_degree'] = '';
                        selectionNull('kelayakan_degree', 'degreeForm');
                        originalVal['kelayakan_degree'] = '';
                        $('#degreeForm input[name="cgpa_degree"]').val(data_not_available);
                        originalVal['cgpa_degree'] = '';
                        selectionNull('institusi_degree', 'degreeForm');
                        originalVal['institusi_degree'] = '';
                        $('#degreeForm input[name="nama_sijil_degree"]').val(data_not_available);
                        originalVal['nama_sijil_degree'] = '';
                        selectionNull('pengkhususan_degree', 'degreeForm');
                        originalVal['pengkhususan_degree'] = '';
                        selectionNull('fln_degree', 'degreeForm');
                        originalVal['fln_degree'] = '';
                        $('#degreeForm input[name="tarikh_senat_degree"]').val(data_not_available);
                        originalVal['tarikh_senat_degree'] = '';
                        selectionNull('biasiswa_degree', 'degreeForm');
                        originalVal['biasiswa_degree'] = '';
                    }

                    $('#masterForm input[name="master_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.master != null) {
                        
                        $('#masterForm input[name="tahun_master"]').val(data.detail.master.tahun_lulus ? data.detail.master.tahun_lulus : data_not_available);
                        originalVal['tahun_master'] = data.detail.master.tahun_lulus;

                        if(data.detail.master.kel_kod) { 
                            $('#masterForm select[name="kelayakan_master"]').val(data.detail.master.kel_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('kelayakan_master', 'masterForm'); 
                        }
                        originalVal['kelayakan_master'] = $('#masterForm select[name="kelayakan_master"]').find(':selected').text();

                        $('#masterForm input[name="cgpa_master"]').val(data.detail.master.cgpa ? data.detail.master.cgpa : data_not_available);
                        originalVal['cgpa_master'] = data.detail.master.cgpa;

                        if(data.detail.master.ins_kod) { 
                            $('#masterForm select[name="institusi_master"]').val(data.detail.master.ins_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('institusi_master', 'masterForm'); 
                        }
                        originalVal['institusi_master'] = $('#masterForm select[name="institusi_master"]').find(':selected').text();
                        
                        $('#masterForm input[name="nama_sijil_master"]').val(data.detail.master.nama_sijil ? data.detail.master.nama_sijil : data_not_available);
                        originalVal['kod_ruj_pengkhususan'] = data.detail.master.nama_sijil;
                        
                        if(data.detail.master.pen_kod) { 
                            $('#masterForm select[name="pengkhususan_master"]').val(data.detail.master.pen_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('pengkhususan_master', 'masterForm'); 
                        }
                        originalVal['pengkhususan_master'] = $('#masterForm select[name="pengkhususan_master"]').find(':selected').text();
                        
                        if(data.detail.master.ins_fln) { 
                            $('#masterForm select[name="fln_master"]').val(data.detail.master.ins_fln).trigger('change'); 
                        }
                        else { 
                            selectionNull('fln_master', 'masterForm'); 
                        }
                        originalVal['fln_master'] = $('#masterForm select[name="fln_master"]').find(':selected').text();
                        
                        $('#masterForm input[name="tarikh_senat_master"]').val(data.detail.master.tarikh_senat ? data.detail.master.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_master'] = data.detail.master.tarikh_senat;
                        
                        if(data.detail.master.biasiswa != null) { 
                            $('#masterForm select[name="biasiswa_master"]').val((data.detail.master.biasiswa == true) ? 1 : 0).trigger('change'); 
                        }
                        else { 
                            selectionNull('biasiswa_master', 'masterForm'); 
                        }
                        originalVal['biasiswa_master'] = $('#masterForm select[name="biasiswa_master"]').find(':selected').text();
                    }else{
                        $('#masterForm input[name="tahun_master"]').val(data_not_available);
                        originalVal['tahun_master'] = '';
                        selectionNull('kelayakan_master', 'masterForm');
                        originalVal['kelayakan_master'] = '';
                        $('#masterForm input[name="cgpa_master"]').val(data_not_available);
                        originalVal['cgpa_master'] = '';
                        selectionNull('institusi_master', 'masterForm');
                        originalVal['institusi_master'] = '';
                        $('#masterForm input[name="nama_sijil_master"]').val(data_not_available);
                        originalVal['nama_sijil_master'] = '';
                        selectionNull('pengkhususan_master', 'masterForm');
                        originalVal['pengkhususan_master'] = '';
                        selectionNull('fln_master', 'masterForm');
                        originalVal['fln_master'] = '';
                        $('#masterForm input[name="tarikh_senat_master"]').val(data_not_available);
                        originalVal['tarikh_senat_master'] = '';
                        selectionNull('biasiswa_master', 'masterForm');
                        originalVal['biasiswa_master'] = '';
                    }

                    $('#phdForm input[name="phd_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.phd != null) {
                        
                        $('#phdForm input[name="tahun_phd"]').val(data.detail.phd.tahun_lulus ? data.detail.phd.tahun_lulus : data_not_available);
                        originalVal['tahun_phd'] = data.detail.phd.tahun_lulus;

                        if(data.detail.phd.kel_kod) { 
                            $('#phdForm select[name="kelayakan_phd"]').val(data.detail.phd.kel_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('kelayakan_phd', 'phdForm'); 
                        }
                        originalVal['kelayakan_phd'] = $('#phdForm select[name="kelayakan_phd"]').find(':selected').text();

                        $('#phdForm input[name="cgpa_phd"]').val(data.detail.phd.cgpa ? data.detail.phd.cgpa : data_not_available);
                        originalVal['cgpa_phd'] = data.detail.phd.cgpa;

                        if(data.detail.phd.ins_kod) { 
                            $('#phdForm select[name="institusi_phd"]').val(data.detail.phd.ins_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('institusi_phd', 'phdForm'); 
                        }
                        originalVal['institusi_phd'] = $('#phdForm select[name="institusi_phd"]').find(':selected').text();
                        
                        $('#phdForm input[name="nama_sijil_phd"]').val(data.detail.phd.nama_sijil ? data.detail.phd.nama_sijil : data_not_available);
                        originalVal['kod_ruj_pengkhususan'] = data.detail.phd.nama_sijil;
                        
                        if(data.detail.phd.pen_kod) { 
                            $('#phdForm select[name="pengkhususan_phd"]').val(data.detail.phd.pen_kod).trigger('change'); 
                        }
                        else { 
                            selectionNull('pengkhususan_phd', 'phdForm'); 
                        }
                        originalVal['pengkhususan_phd'] = $('#phdForm select[name="pengkhususan_phd"]').find(':selected').text();
                        
                        if(data.detail.phd.ins_fln) { 
                            $('#phdForm select[name="fln_phd"]').val(data.detail.phd.ins_fln).trigger('change'); 
                        }
                        else { 
                            selectionNull('fln_phd', 'phdForm'); 
                        }
                        originalVal['fln_phd'] = $('#phdForm select[name="fln_phd"]').find(':selected').text();
                        
                        $('#phdForm input[name="tarikh_senat_phd"]').val(data.detail.phd.tarikh_senat ? data.detail.phd.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_phd'] = data.detail.phd.tarikh_senat;
                        
                        if(data.detail.phd.biasiswa != null) { 
                            $('#phdForm select[name="biasiswa_phd"]').val((data.detail.phd.biasiswa == true) ? 1 : 0).trigger('change'); 
                        }
                        else { 
                            selectionNull('biasiswa_phd', 'phdForm'); 
                        }
                        originalVal['biasiswa_phd'] = $('#phdForm select[name="biasiswa_phd"]').find(':selected').text();
                    }else{
                        $('#phdForm input[name="tahun_phd"]').val(data_not_available);
                        originalVal['tahun_phd'] = '';
                        selectionNull('kelayakan_phd', 'phdForm');
                        originalVal['kelayakan_phd'] = '';
                        $('#phdForm input[name="cgpa_phd"]').val(data_not_available);
                        originalVal['cgpa_phd'] = '';
                        selectionNull('institusi_phd', 'phdForm');
                        originalVal['institusi_phd'] = '';
                        $('#phdForm input[name="nama_sijil_phd"]').val(data_not_available);
                        originalVal['nama_sijil_phd'] = '';
                        selectionNull('pengkhususan_phd', 'phdForm');
                        originalVal['pengkhususan_phd'] = '';
                        selectionNull('fln_phd', 'phdForm');
                        originalVal['fln_phd'] = '';
                        $('#phdForm input[name="tarikh_senat_phd"]').val(data_not_available);
                        originalVal['tarikh_senat_phd'] = '';
                        selectionNull('biasiswa_phd', 'phdForm');
                        originalVal['biasiswa_phd'] = '';
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
                            trProfessional += '<td>' + (item.no_ahli ? item.no_ahli : '') + '</td>';
                            trProfessional += '<td>' + (item.qualification ? item.qualification.diskripsi : '') + '</td>';
                            trProfessional += '<td>' + (item.tarikh ? item.tarikh : '') + '</td>';
                            trProfessional += '</tr>';
                        });
                    }
                    $('#table-professional tbody').append(trProfessional);

                    $('#experienceForm input[name="experience_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.experience != null) {
                        if(data.detail.experience.sektor_pekerjaan) { $('#experienceForm select[name="experience_job_sector"]').val(data.detail.experience.sektor_pekerjaan).trigger('change'); }
                        else { selectionNull('experience_job_sector', 'experienceForm'); }
                        originalVal['experience_job_sector'] = $('#experienceForm select[name="experience_job_sector"]').find(':selected').text();
                        $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.experience.tarikh_mula ? data.detail.experience.tarikh_mula : data_not_available);
                        originalVal['experience_appoint_date'] = data.detail.experience.tarikh_mula;
                        if(data.detail.experience.taraf_jawatan) { $('#experienceForm select[name="experience_position_level"]').val(data.detail.experience.taraf_jawatan).trigger('change'); }
                        else { selectionNull('experience_position_level', 'experienceForm'); }
                        originalVal['experience_position_level'] = $('#experienceForm select[name="experience_position_level"]').find(':selected').text();
                        if(data.detail.experience.kod_ruj_skim) { $('#experienceForm select[name="experience_skim"]').val(data.detail.experience.kod_ruj_skim).trigger('change'); }
                        else { selectionNull('experience_skim', 'experienceForm'); }
                        originalVal['experience_skim'] = $('#experienceForm select[name="experience_skim"]').find(':selected').text();
                        if(data.detail.experience.kump_pkhidmat) { $('#experienceForm select[name="experience_service_group"]').val(data.detail.experience.kump_pkhidmat).trigger('change'); }
                        else { selectionNull('experience_service_group', 'experienceForm'); }
                        originalVal['experience_service_group'] = $('#experienceForm select[name="experience_service_group"]').find(':selected').text();
                        if(data.detail.experience.kod_ruj_gred_gaji) { $('#experienceForm select[name="experience_position_grade"]').val(data.detail.experience.kod_ruj_gred_gaji).trigger('change'); }
                        else { selectionNull('experience_position_grade', 'experienceForm'); }
                        originalVal['experience_position_grade'] = $('#experienceForm select[name="experience_position_grade"]').find(':selected').text();
                        $('#experienceForm input[name="experience_start_date"]').val(data.detail.experience.tarikh_lantik ? data.detail.experience.tarikh_lantik : data_not_available);
                        originalVal['experience_start_date'] = data.detail.experience.tarikh_lantik;
                        $('#experienceForm input[name="experience_verify_date"]').val(data.detail.experience.tarikh_disahkan ? data.detail.experience.tarikh_disahkan : data_not_available);
                        originalVal['experience_verify_date'] = data.detail.experience.tarikh_disahkan;
                        if(data.detail.experience.ruj_kem_jabatan) { $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.experience.ruj_kem_jabatan).trigger('change'); }
                        else { selectionNull('experience_department_ministry', 'experienceForm'); }
                        originalVal['experience_department_ministry'] = $('#experienceForm select[name="experience_department_ministry"]').find(':selected').text();
                        if(data.detail.experience.negeri_jabatan) { $('#experienceForm select[name="experience_department_state"]').val(data.detail.experience.negeri_jabatan).trigger('change'); }
                        else { selectionNull('experience_department_state', 'experienceForm'); }
                        originalVal['experience_department_state'] = $('#experienceForm select[name="experience_department_state"]').find(':selected').text();
                    }else{
                        selectionNull('experience_job_sector', 'experienceForm');
                        originalVal['experience_job_sector'] = ''
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
                        if(data.detail.army_police.jenis_pkhidmat) {
                            $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').val(data.detail.army_police.jenis_pkhidmat).trigger('change');
                        }
                        else {
                            selectionNull('jenis_perkhidmatan_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['jenis_perkhidmatan_tentera_polis'] = $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').find(':selected').text();
                        if(data.detail.army_police.pangkat_tentera_polis) {
                            $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').val(data.detail.army_police.pangkat_tentera_polis).trigger('change');
                        }
                        else {
                            selectionNull('pangkat_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['pangkat_tentera_polis'] = $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').find(':selected').text();
                        if(data.detail.army_police.jenis_bekas_tentera) {
                            $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').val(data.detail.army_police.jenis_bekas_tentera).trigger('change');
                        }
                        else {
                            selectionNull('jenis_bekas_tentera_polis', 'tenteraPolisForm');
                        }
                        originalVal['jenis_bekas_tentera_polis'] = $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').find(':selected').text();

                        var tmTentPolisElement = $("#tm_tentera");
                        tmTentPolisElement.attr("hidden", true);
                    } else {
                        selectionNull('jenis_perkhidmatan_tentera_polis', 'tenteraPolisForm');
                        originalVal['jenis_perkhidmatan_tentera_polis'] = '';
                        selectionNull('pangkat_tentera_polis', 'tenteraPolisForm');
                        originalVal['pangkat_tentera_polis'] = '';
                        selectionNull('jenis_bekas_tentera_polis', 'tenteraPolisForm');
                        originalVal['jenis_bekas_tentera_polis'] = '';

                        var tmTentPolisElement = $("#tm_tentera");
                        tmTentPolisElement.removeAttr("hidden");
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

                    $('#candidate_name').html('');
                    $('#candidate_ic').html('');
                    $('#candidate_no_pengenalan').val('');
                    $('#candidate_timeline').html('');

                    $('#update_personal').attr("style", "display:none");
                    $('#update_alamat_tetap').attr("style", "display:none");
                    $('#update_alamat_surat').attr("style", "display:none");
                    $('#update_tempat_lahir').attr("style", "display:none");
                    $('#update_pusat_temuduga').attr("style", "display:none");
                    $('#update_lesen_memandu').attr("style", "display:none");
                    $('#update_oku').attr("style", "display:none");
                    $('#update_pmr').attr("style", "display:none");
                    $('#update_spm1').attr("style", "display:none");
                    $('#update_spm2').attr("style", "display:none");
                    $('#update_stpm1').attr("style", "display:none");
                    $('#update_stpm2').attr("style", "display:none");
                    $('#update_stam1').attr("style", "display:none");
                    $('#update_stam2').attr("style", "display:none");
                    $('#update_experience').attr("style", "display:none");
                    $('#update_tentera_polis').attr("style", "display:none");
                    $('#update_penalty').attr("style", "display:none");

                    $("#button_action_personal").attr("style", "display:none");
                    $("#button_action_alamat_tetap").attr("style", "display:none");
                    $("#button_action_alamat_surat").attr("style", "display:none");
                    $("#button_action_tempat_lahir").attr("style", "display:none");
                    $("#button_action_pusat_temuduga").attr("style", "display:none");
                    $("#button_action_pmr").attr("style", "display:none");
                    $("#button_action_spm1").attr("style", "display:none");
                    $("#button_action_spm2").attr("style", "display:none");
                    $("#button_action_stpm1").attr("style", "display:none");
                    $("#button_action_stpm2").attr("style", "display:none");
                    $("#button_action_stam1").attr("style", "display:none");
                    $("#button_action_stam2").attr("style", "display:none");
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

                    $('#alamatTetapForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_1"]').val('');
                    $('#alamatTetapForm input[name="permanent_address_2"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_2"]').val('');
                    $('#alamatTetapForm input[name="permanent_address_3"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_address_3"]').val('');
                    $('#alamatTetapForm input[name="permanent_poscode"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_poscode"]').val('');
                    $('#alamatTetapForm input[name="permanent_city"]').attr('disabled', true);
                    $('#alamatTetapForm input[name="permanent_city"]').val('');
                    $('#alamatTetapForm select[name="permanent_state"]').attr('disabled', true);
                    $('#alamatTetapForm select[name="permanent_state"]').val('').trigger('change');
                    $('#alamatTetapForm input[name="alamat_tetap_no_pengenalan"]').val('');

                    $('#alamatSuratForm input[name="address_1"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_1"]').val('');
                    $('#alamatSuratForm input[name="address_2"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_2"]').val('');
                    $('#alamatSuratForm input[name="address_3"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="address_3"]').val('');
                    $('#alamatSuratForm input[name="poscode"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="poscode"]').val('');
                    $('#alamatSuratForm input[name="city"]').attr('disabled', true);
                    $('#alamatSuratForm input[name="city"]').val('');
                    $('#alamatSuratForm select[name="state"]').attr('disabled', true);
                    $('#alamatSuratForm select[name="state"]').val('').trigger('change');
                    $('#alamatSuratForm input[name="alamat_surat_no_pengenalan"]').val('');

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

                    $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', true);
                    $('#pusatTemudugaForm select[name="pusat_temuduga"]').val('').trigger('change');

                    $('#table-skim tbody').empty();

                    $('#pmrForm select[name="subjek_pmr"]').attr('disabled', true);
                    $('#pmrForm select[name="subjek_pmr"]').val('').trigger('change');
                    $('#pmrForm select[name="gred_pmr"]').attr('disabled', true);
                    $('#pmrForm select[name="gred_pmr"]').val('').trigger('change');
                    $('#pmrForm input[name="tahun_pmr"]').attr('disabled', true);
                    $('#pmrForm input[name="tahun_pmr"]').val('');
                    $('#pmrForm input[name="pmr_no_pengenalan"]').val('');

                    $('#table-pmr tbody').empty();

                    $('#table-spm1 tbody').empty();

                    $('#table-spm2 tbody').empty();

                    //$('#table-spmv tbody').empty();

                    $('#table-svm tbody').empty();

                    $('#table-stpm1 tbody').empty();

                    $('#table-stpm2 tbody').empty();

                    $('#table-stam1 tbody').empty();

                    $('#table-stam2 tbody').empty();

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

                    $('#experienceForm select[name="experience_job_sector"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_job_sector"]').attr('disabled', true);
                    $('#experienceForm input[name="experience_appoint_date"]').val('');
                    $('#experienceForm input[name="experience_appoint_date"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_position_level"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_position_level"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_skim"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_skim"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_service_group"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_service_group"]').attr('disabled', true);
                    $('#experienceForm select[name="experience_position_grade"]').val('').trigger('change');
                    $('#experienceForm select[name="experience_position_grade"]').attr('disabled', true);
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

    function reset() {
        // $('#table-carian').DataTable().destroy();
        // $("#table-carian > tbody").html("");
        $('#append-data').empty();

        $('#candidate_name').html('');
        $('#candidate_ic').html('');
        $('#candidate_no_pengenalan').val('');
        $('#candidate_timeline').html('');

        $('#update_personal').attr("style", "display:none");
        $('#update_alamat_tetap').attr("style", "display:none");
        $('#update_alamat_surat').attr("style", "display:none");
        $('#update_tempat_lahir').attr("style", "display:none");
        $('#update_lesen_memandu').attr("style", "display:none");
        $('#update_oku').attr("style", "display:none");
        $('#update_pusat_temuduga').attr("style", "display:none");
        $('#update_pmr').attr("style", "display:none");
        $('#update_spm1').attr("style", "display:none");
        $('#update_spm2').attr("style", "display:none");
        $('#update_stpm1').attr("style", "display:none");
        $('#update_stpm2').attr("style", "display:none");
        $('#update_stam1').attr("style", "display:none");
        $('#update_stam2').attr("style", "display:none");
        $('#update_experience').attr("style", "display:none");
        $('#update_tentera_polis').attr("style", "display:none");
        $('#update_penalty').attr("style", "display:none");

        $("#button_action_personal").attr("style", "display:none");
        $("#button_action_alamat_tetap").attr("style", "display:none");
        $("#button_action_alamat_surat").attr("style", "display:none");
        $("#button_action_tempat_lahir").attr("style", "display:none");
        $("#button_action_pusat_temuduga").attr("style", "display:none");
        $("#button_action_pmr").attr("style", "display:none");
        $("#button_action_spm1").attr("style", "display:none");
        $("#button_action_spm2").attr("style", "display:none");
        $("#button_action_stpm1").attr("style", "display:none");
        $("#button_action_stpm2").attr("style", "display:none");
        $("#button_action_stam1").attr("style", "display:none");
        $("#button_action_stam2").attr("style", "display:none");
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

        $('#alamatTetapForm input[name="permanent_address_1"]').attr('disabled', true);
        $('#alamatTetapForm input[name="permanent_address_1"]').val('');
        $('#alamatTetapForm input[name="permanent_address_2"]').attr('disabled', true);
        $('#alamatTetapForm input[name="permanent_address_2"]').val('');
        $('#alamatTetapForm input[name="permanent_address_3"]').attr('disabled', true);
        $('#alamatTetapForm input[name="permanent_address_3"]').val('');
        $('#alamatTetapForm input[name="permanent_poscode"]').attr('disabled', true);
        $('#alamatTetapForm input[name="permanent_poscode"]').val('');
        $('#alamatTetapForm input[name="permanent_city"]').attr('disabled', true);
        $('#alamatTetapForm input[name="permanent_city"]').val('');
        $('#alamatTetapForm select[name="permanent_state"]').attr('disabled', true);
        $('#alamatTetapForm select[name="permanent_state"]').val('').trigger('change');
        $('#alamatTetapForm input[name="alamat_tetap_no_pengenalan"]').val('');

        $('#alamatSuratForm input[name="address_1"]').attr('disabled', true);
        $('#alamatSuratForm input[name="address_1"]').val('');
        $('#alamatSuratForm input[name="address_2"]').attr('disabled', true);
        $('#alamatSuratForm input[name="address_2"]').val('');
        $('#alamatSuratForm input[name="address_3"]').attr('disabled', true);
        $('#alamatSuratForm input[name="address_3"]').val('');
        $('#alamatSuratForm input[name="poscode"]').attr('disabled', true);
        $('#alamatSuratForm input[name="poscode"]').val('');
        $('#alamatSuratForm input[name="city"]').attr('disabled', true);
        $('#alamatSuratForm input[name="city"]').val('');
        $('#alamatSuratForm select[name="state"]').attr('disabled', true);
        $('#alamatSuratForm select[name="state"]').val('').trigger('change');
        $('#alamatSuratForm input[name="alamat_surat_no_pengenalan"]').val('');

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

        $('#pusatTemudugaForm select[name="pusat_temuduga"]').attr('disabled', true);
        $('#pusatTemudugaForm select[name="pusat_temuduga"]').val('').trigger('change');

        $('#table-skim tbody').empty();

        $('#pmrForm select[name="subjek_pmr"]').attr('disabled', true);
        $('#pmrForm select[name="subjek_pmr"]').val('').trigger('change');
        $('#pmrForm select[name="gred_pmr"]').attr('disabled', true);
        $('#pmrForm select[name="gred_pmr"]').val('').trigger('change');
        $('#pmrForm input[name="tahun_pmr"]').attr('disabled', true);
        $('#pmrForm input[name="tahun_pmr"]').val('');
        $('#pmrForm input[name="pmr_no_pengenalan"]').val('');

        $('#table-pmr tbody').empty();

        $('#table-spm1 tbody').empty();

        $('#table-spm2 tbody').empty();

        //$('#table-spmv tbody').empty();

        $('#table-svm tbody').empty();

        $('#table-stpm1 tbody').empty();

        $('#table-stpm2 tbody').empty();

        $('#table-stam1 tbody').empty();

        $('#table-stam2 tbody').empty();

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
    }
</script>
@endsection
