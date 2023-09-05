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
                    $('#candidate_name').html(data.detail.full_name);
                    $('#candidate_ic').html(data.detail.no_ic);
                    $('#candidate_no_pengenalan').val(data.detail.no_pengenalan);
                    
                    var timelineUrl = "{{ route('timeline.list', ':replaceThis') }}"
                    timelineUrl = timelineUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#candidate_timeline').load(timelineUrl)

                    $('#gender').val(data.detail.ref_gender_code).trigger('change');
                    $('#religion').val(data.detail.ref_religion_code).trigger('change');
                    $('#race').val(data.detail.ref_race_code).trigger('change');
                    $('#date_of_birth').val(data.detail.date_of_birth);
                    $('#marital_status').val(data.detail.ref_marital_status_code).trigger('change');
                    $('#phone_number').val(data.detail.phone_number);
                    $('#email').val(data.detail.email);
                    $('#permanent_address_1').val(data.detail.permanent_address_1);
                    $('#permanent_address_2').val(data.detail.permanent_address_2);
                    $('#permanent_address_3').val(data.detail.permanent_address_3);
                    $('#permanent_poscode').val(data.detail.permanent_poscode);
                    $('#permanent_city').val(data.detail.permanent_city);
                    $('#permanent_state').val(data.detail.permanent_ref_state_code).trigger('change');
                    $('#address_1').val(data.detail.address_1);
                    $('#address_2').val(data.detail.address_2);
                    $('#address_3').val(data.detail.address_3);
                    $('#poscode').val(data.detail.poscode);
                    $('#city').val(data.detail.city);
                    $('#state').val(data.detail.ref_state_code).trigger('change');
                    $('#place_of_birth').val(data.detail.place_of_birth).trigger('change');
                    $('#father_place_of_birth').val(data.detail.father_place_of_birth).trigger('change');
                    $('#mother_place_of_birth').val(data.detail.mother_place_of_birth).trigger('change');
                    $('#poscode').val(data.detail.poscode);
                    $('#city').val(data.detail.city);
                    if(data.detail.license != null) {
                        $('#license_type').val(data.detail.license.type);
                        $('#license_expiry_date').val(data.detail.license.expiry_date);
                        $('#license_blacklist_status').val(data.detail.license.is_blacklist).trigger('change');
                        $('#license_blacklist_details').val(data.detail.license.blacklist_details);
                    }
                    if(data.detail.oku != null) {
                        $('#oku_registration_no').val(data.detail.oku.no_registration);
                        $('#oku_status').val(data.detail.oku.status);
                        $('#oku_category').val(data.detail.oku.category);
                        $('#oku_sub').val(data.detail.oku.sub);
                    }

                    $('#personal_no_pengenalan').val(data.detail.no_pengenalan);

                    $('#table-skim tbody').empty();
                    var trSkim = '';
                    var bilSkim = 0;
                    $.each(data.detail.skim, function (i, item) {
                        bilSkim += 1;
                        trSkim += '<tr><td align="center">' + bilSkim + '</td><td>' + item.ref_skim_code + '</td><td>' + item.skim.name + '</td><td>' + item.register_date + '</td><td>' + item.expiry_date + '</td><td>' + item.interview_centre.name + '</td></tr>';
                    });
                    $('#table-skim tbody').append(trSkim);

                    $('#table-form3 tbody').empty();
                    var trForm3 = '';
                    var bilForm3 = 0;
                    $.each(data.detail.resultForm3, function (i, item) {
                        if(item.subject != null) {
                            bilForm3 += 1;
                            trForm3 += '<tr><td align="center">' + bilForm3 + '</td><td>' + item.subject.code + '</td><td>' + item.subject.name + '</td><td>' + item.grade + '</td></tr>';
                        }
                    });
                    $('#table-form3 tbody').append(trForm3);

                    $('#table-form5 tbody').empty();
                    var trForm5 = '';
                    var bilForm5 = 0;
                    $.each(data.detail.resultForm5, function (i, item) {
                        if(item.subject != null) {
                            bilForm5 += 1;
                            trForm5 += '<tr><td align="center">' + bilForm5 + '</td><td>' + item.subject.code + '</td><td>' + item.subject.name + '</td><td>' + item.grade + '</td></tr>';
                        }
                    });
                    $('#table-form5 tbody').append(trForm5);

                    $('#table-form6 tbody').empty();
                    var trForm6 = '';
                    var bilForm6 = 0;
                    $.each(data.detail.resultForm6, function (i, item) {
                        if(item.subject != null) {
                            bilForm6 += 1;
                            trForm6 += '<tr><td align="center">' + bilForm6 + '</td><td>' + item.subject.code + '</td><td>' + item.subject.name + '</td><td>' + item.grade + '</td></tr>';
                        }
                    });
                    $('#table-form6 tbody').append(trForm6);

                    $('#table-matriculation tbody').empty();
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
                    $('#table-matriculation tbody').append(trMatriculation);

                    $('#table-skm tbody').empty();
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
                    $('#table-skm tbody').append(trSkm);

                    $('#table-penalty tbody').empty();
                    var trPenalty = '';
                    var bilPenalty = 0;
                    $.each(data.detail.penalty, function (i, item) {
                        bilPenalty += 1;
                        trPenalty += '<tr>';
                        trPenalty += '<td align="center">' + bilPenalty + '</td>'
                        trPenalty += '<td>' + item.penalty.name + '</td>';
                        trPenalty += '<td>' + item.duration + ' ' + item.type + '</td>';
                        trPenalty += '<td>' + item.date_start + '</td>';
                        trPenalty += '<td>' + item.date_end + '</td>';
                        trPenalty += '</tr>';
                    });
                    $('#table-penalty tbody').append(trPenalty);

                    var penaltyUrl = "{{ route('penalty.list', ':replaceThis') }}"
                    penaltyUrl = penaltyUrl.replace(':replaceThis', data.detail.no_pengenalan);
                    $('#penaltyForm').attr('data-refreshfunctionurl', penaltyUrl);
                    $('#penalty_no_pengenalan').val(data.detail.no_pengenalan);

                },
                error: function(data) {
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