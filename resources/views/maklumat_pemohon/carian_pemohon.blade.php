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
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered" id="table-carian">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th>No Kad Pengenalan Baru</th>
                            {{-- <th>No Kad Pengenalan Lama</th> --}}
                            <th width="55%">Nama Penuh</th>
                            <th width="15%">Lihat Maklumat</th>
                        </tr>
                    </thead>
                </table>
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
    function selectSearch(btnValue){
        $('#pilihan_carian').val(btnValue);

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

    function carianPemohon() {
        search_nama = $('#search_ic').val();

        if(search_nama == ''){
            Swal.fire('Gagal', 'Sila isikan nama', 'error');
        } else if (search_nama.length < 3){
            Swal.fire('Gagal', 'Sila isikan sekurang-kurangnya 3 huruf', 'error');
        } else {
            url = "{{ route('list-carian') }}";

            var tableList;

            tableList = $('#table-carian').DataTable().destroy();

            tableList = $('#table-carian').DataTable({
                orderCellsTop: true,
                colReorder: false,
                pageLength: 10,
                processing: true,
                serverSide: true, //enable if data is large (more than 50,000)
                ajax: {
                    url: url,
                    cache: false,
                    data : {
                        search_nama : search_nama
                    }
                },
                columns: [
                    {
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        className : "text-center",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "no_kp_baru",
                        name: "no_kp_baru",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "nama_penuh",
                        name: "nama_penuh",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
                        }
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: false,
                        searchable: false
                    },
                ],
                searching: false,
                lengthChange: false,
                language : {
                    emptyTable : "Tiada data tersedia",
                    info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
                    infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
                    infoFiltered : "(Ditapis dari _MAX_ entri)",
                    search : "Cari:",
                    zeroRecords : "Tiada rekod yang ditemui",
                    paginate : {
                        first : "Pertama",
                        last : "Terakhir",
                        next : "Seterusnya",
                        previous : "Sebelumnya"
                    },
                    lengthMenu : "Lihat _MENU_ entri",
                }
            });
        }
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

                    $('#candidate_name').html(data.detail.nama_penuh);
                    $('#candidate_ic').html(data.detail.no_kp_baru);
                    $('#candidate_no_pengenalan').val(data.detail.no_pengenalan);

                    var timelineUrl = "{{ route('timeline.list', ':replaceThis') }}"
                    timelineUrl = timelineUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#candidate_timeline').load(timelineUrl)

                    $('#personalForm select[name="gender"]').attr('disabled', true);
                    if(data.detail.kod_ruj_jantina) { $('#personalForm select[name="gender"]').val(data.detail.kod_ruj_jantina).trigger('change'); }
                    else { selectionNull('gender', 'personalForm');}
                    originalVal['gender'] = $('#personalForm select[name="gender"]').find(':selected').text();
                    $('#personalForm select[name="religion"]').attr('disabled', true);
                    if(data.detail.kod_ruj_agama) { $('#personalForm select[name="religion"]').val(data.detail.kod_ruj_agama).trigger('change'); }
                    else { selectionNull('religion', 'personalForm'); }
                    originalVal['religion'] = $('#personalForm select[name="religion"]').find(':selected').text();
                    $('#personalForm select[name="race"]').attr('disabled', true);
                    if(data.detail.kod_ruj_keturunan) { $('#personalForm select[name="race"]').val(data.detail.kod_ruj_keturunan).trigger('change'); }
                    else { selectionNull('race', 'personalForm'); }
                    originalVal['race'] = $('#personalForm select[name="race"]').find(':selected').text();

                    $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                    $('#personalForm input[name="date_of_birth"]').val(data.detail.tarikh_lahir ? data.detail.tarikh_lahir : data_not_available);
                    originalVal['date_of_birth'] = data.detail.tarikh_lahir;

                    $('#personalForm select[name="marital_status"]').attr('disabled', true);
                    if(data.detail.kod_ruj_status_kahwin) { $('#personalForm select[name="marital_status"]').val(data.detail.kod_ruj_status_kahwin).trigger('change'); }
                    else { selectionNull('marital_status', 'personalForm'); }
                    originalVal['marital_status'] = $('#personalForm select[name="marital_status"]').find(':selected').text();

                    $('#personalForm input[name="phone_number"]').attr('disabled', true);
                     $('#personalForm input[name="phone_number"]').val(data.detail.no_tel ? data.detail.no_tel : data_not_available);
                    originalVal['phone_number'] = data.detail.no_tel;

                    $('#personalForm input[name="email"]').attr('disabled', true);
                    $('#personalForm input[name="email"]').val(data.detail.emel ? data.detail.emel : data_not_available);
                    originalVal['email'] = data.detail.emel;

                    $('#personalForm input[name="personal_no_pengenalan"]').val(data.detail.no_pengenalan);

                    $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_1"]').val(data.detail.alamat_1_tetap ? data.detail.alamat_1_tetap : data_not_available);
                    // data.detail.permanent_address_1 ? '' : $('#alamatForm input[name="permanent_address_1"]').css('color', 'maroon');
                    originalVal['permanent_address_1'] = data.detail.alamat_1_tetap;
                    $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_2"]').val(data.detail.alamat_2_tetap ? data.detail.alamat_2_tetap : data_not_available);
                    originalVal['permanent_address_2'] = data.detail.alamat_2_tetap;
                    $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_address_3"]').val(data.detail.alamat_3_tetap ? data.detail.alamat_3_tetap : data_not_available);
                    originalVal['permanent_address_3'] = data.detail.alamat_3_tetap;
                    $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_poscode"]').val(data.detail.poskod_tetap ? data.detail.poskod_tetap : data_not_available);
                    originalVal['permanent_poscode'] = data.detail.poskod_tetap;
                    $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                    $('#alamatForm input[name="permanent_city"]').val(data.detail.bandar_tetap ? data.detail.bandar_tetap : data_not_available);
                    originalVal['permanent_city'] = data.detail.bandar_tetap;
                    $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                    if(data.detail.tempat_tinggal_tetap) { $('#alamatForm select[name="permanent_state"]').val(data.detail.tempat_tinggal_tetap).trigger('change'); }
                    else { selectionNull('permanent_state', 'alamatForm'); }
                    originalVal['permanent_state'] = $('#alamatForm select[name="permanent_state"]').find(':selected').text();
                    $('#alamatForm input[name="address_1"]').attr('disabled', true);
                    $('#alamatForm input[name="address_1"]').val(data.detail.alamat_1 ? data.detail.alamat_1 : data_not_available);
                    originalVal['address_1'] = data.detail.alamat_1;
                    $('#alamatForm input[name="address_2"]').attr('disabled', true);
                    $('#alamatForm input[name="address_2"]').val(data.detail.alamat_2 ? data.detail.alamat_2 : data_not_available);
                    originalVal['address_2'] = data.detail.alamat_2;
                    $('#alamatForm input[name="address_3"]').attr('disabled', true);
                    $('#alamatForm input[name="address_3"]').val(data.detail.alamat_3 ? data.detail.alamat_3 : data_not_available);
                    originalVal['address_3'] = data.detail.alamat_3;
                    $('#alamatForm input[name="poscode"]').attr('disabled', true);
                    $('#alamatForm input[name="poscode"]').val(data.detail.poskod ? data.detail.poskod : data_not_available);
                    originalVal['poscode'] = data.detail.poskod;
                    $('#alamatForm input[name="city"]').attr('disabled', true);
                    $('#alamatForm input[name="city"]').val(data.detail.bandar ? data.detail.bandar : data_not_available);
                    originalVal['city'] = data.detail.bandar;
                    $('#alamatForm select[name="state"]').attr('disabled', true);
                    if(data.detail.tempat_tinggal) { $('#alamatForm select[name="state"]').val(data.detail.tempat_tinggal).trigger('change'); }
                    else { selectionNull('state', 'alamatForm'); }
                    originalVal['state'] = $('#alamatForm select[name="state"]').find(':selected').text();
                    $('#alamatForm input[name="alamat_no_pengenalan"]').val(data.detail.no_pengenalan);

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
                            trSkim += '<td>' + item.kod_ruj_skim + '</td>'
                            trSkim += '<td>' + item.skim.name + '</td>';
                            trSkim += '<td>' + (item.tarikh_daftar ? item.tarikh_daftar : '') + '</td>';
                            trSkim += '<td>' + (item.tarikh_luput ? item.tarikh_luput : '') + '</td>';
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
                        $('#pengajianTinggiForm input[name="tahun_pengajian_tinggi"]').val(data.detail.higher_education.tahun_lulus ? data.detail.higher_education.tahun_lulus : data_not_available);
                        originalVal['tahun_pengajian_tinggi'] = data.detail.higher_education.tahun_lulus;
                        if(data.detail.higher_education.kod_ruj_kelayakan) { $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').val(data.detail.higher_education.kod_ruj_kelayakan).trigger('change'); }
                        else { selectionNull('kelayakan_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['kelayakan_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="kelayakan_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="cgpa_pengajian_tinggi"]').val(data.detail.higher_education.cgpa ? data.detail.higher_education.cgpa : data_not_available);
                        originalVal['cgpa_pengajian_tinggi'] = data.detail.higher_education.cgpa;
                        if(data.detail.higher_education.kod_ruj_institusi) { $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').val(data.detail.higher_education.kod_ruj_institusi).trigger('change'); }
                        else { selectionNull('institusi_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['institusi_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="institusi_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="nama_sijil_pengajian_tinggi"]').val(data.detail.higher_education.nama_sijil ? data.detail.higher_education.nama_sijil : data_not_available);
                        originalVal['kod_ruj_pengkhususan'] = data.detail.higher_education.nama_sijil;
                        if(data.detail.higher_education.kod_ruj_pengkhususan) { $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').val(data.detail.higher_education.kod_ruj_pengkhususan).trigger('change'); }
                        else { selectionNull('pengkhususan_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['pengkhususan_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="pengkhususan_pengajian_tinggi"]').find(':selected').text();
                        if(data.detail.higher_education.ins_fln) { $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').val(data.detail.higher_education.ins_fln).trigger('change'); }
                        else { selectionNull('fln_pengajian_tinggi', 'pengajianTinggiForm'); }
                        originalVal['fln_pengajian_tinggi'] = $('#pengajianTinggiForm select[name="fln_pengajian_tinggi"]').find(':selected').text();
                        $('#pengajianTinggiForm input[name="tarikh_senat_pengajian_tinggi"]').val(data.detail.higher_education.tarikh_senat ? data.detail.higher_education.tarikh_senat : data_not_available);
                        originalVal['tarikh_senat_pengajian_tinggi'] = data.detail.higher_education.tarikh_senat;
                        if(data.detail.higher_education.biasiswa != null) { $('#pengajianTinggiForm select[name="biasiswa_pengajian_tinggi"]').val((data.detail.higher_education.biasiswa == true) ? 1 : 0).trigger('change'); }
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
                            trProfessional += '<td>' + (item.no_ahli ? item.no_ahli : '') + '</td>';
                            trProfessional += '<td>' + (item.qualification ? item.qualification.name : '') + '</td>';
                            trProfessional += '<td>' + (item.tarikh ? item.tarikh : '') + '</td>';
                            trProfessional += '</tr>';
                        });
                    }
                    $('#table-professional tbody').append(trProfessional);

                    $('#experienceForm input[name="experience_no_pengenalan"]').val(data.detail.no_pengenalan);
                    if(data.detail.experience != null) {
                        $('#experienceForm input[name="experience_appoint_date"]').val(data.detail.experience.tarikh_lantik ? data.detail.experience.tarikh_lantik : data_not_available);
                        originalVal['experience_appoint_date'] = data.detail.experience.tarikh_lantik;
                        if(data.detail.experience.taraf_jawatan) { $('#experienceForm select[name="experience_position_level"]').val(data.detail.experience.taraf_jawatan).trigger('change'); }
                        else { selectionNull('experience_position_level', 'experienceForm'); }
                        originalVal['experience_position_level'] = $('#experienceForm select[name="experience_position_level"]').find(':selected').text();
                        if(data.detail.experience.kod_ruj_skim) { $('#experienceForm select[name="experience_skim"]').val(data.detail.experience.kod_ruj_skim).trigger('change'); }
                        else { selectionNull('experience_skim', 'experienceForm'); }
                        originalVal['experience_skim'] = $('#experienceForm select[name="experience_skim"]').find(':selected').text();
                        $('#experienceForm input[name="experience_start_date"]').val(data.detail.experience.tarikh_mula ? data.detail.experience.tarikh_mula : data_not_available);
                        originalVal['experience_start_date'] = data.detail.experience.tarikh_mula;
                        $('#experienceForm input[name="experience_verify_date"]').val(data.detail.experience.tarikh_disahkan ? data.detail.experience.tarikh_disahkan : data_not_available);
                        originalVal['experience_verify_date'] = data.detail.experience.tarikh_disahkan;
                        if(data.detail.experience.ruj_kem_jabatan) { $('#experienceForm select[name="experience_department_ministry"]').val(data.detail.experience.ruj_kem_jabatan).trigger('change'); }
                        else { selectionNull('experience_department_ministry', 'experienceForm'); }
                        originalVal['experience_department_ministry'] = $('#experienceForm select[name="experience_department_ministry"]').find(':selected').text();
                        if(data.detail.experience.negeri_jabatan) { $('#experienceForm select[name="experience_department_state"]').val(data.detail.experience.negeri_jabatan).trigger('change'); }
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
</script>
@endsection
