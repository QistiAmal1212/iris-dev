<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#alamat-tetap-info" role="tab" id="alamat-tetap-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    A
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Alamat Tetap
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#alamat-surat-info" role="tab" id="alamat-surat-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    B
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Alamat Surat Menyurat
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- ALAMAT TETAP --}}
        <div id="alamat-tetap-info" class="content parent-tab" role="tabpanel" aria-labelledby="alamat-tetap-info-trigger">
            <div class="accordion" id="accordion_stpm">
                {{-- ALAMAT TETAP --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_result_stpm">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#result_stpm" aria-expanded="true" aria-controls="result_stpm">
                            Alamat Tetap
                        </button>
                    </h2>
                    <div id="result_stpm" class="accordion-collapse collapse show" aria-labelledby="heading_result_stpm" data-bs-parent="#accordion_stpm">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end align-items-center mb-1" id="update_alamat" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editAlamat()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            <form id="alamatForm" action="{{ route('alamat.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadAlamat" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="alamat_no_pengenalan" id="alamat_no_pengenalan" value="">

                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" value="" name="permanent_address_1" id="permanent_address_1" oninput="checkInput('permanent_address_1', 'permanent_address_1Alert')" disabled>
                                        <div id="permanent_address_1Alert" style="color: red; font-size: smaller;"></div>

                                        <br>
                                        <input type="text" class="form-control" value="" name="permanent_address_2" id="permanent_address_2" oninput="checkInput('permanent_address_2', 'permanent_address_2Alert')" disabled>
                                        <div id="permanent_address_2Alert" style="color: red; font-size: smaller;"></div>

                                        <br>
                                        <input type="text" class="form-control" value="" name="permanent_address_3" id="permanent_address_3" oninput="checkInput('permanent_address_3', 'permanent_address_3Alert')" disabled>
                                        <div id="permanent_address_3Alert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Poskod</label>
                                        <input type="text" class="form-control" value="" name="permanent_poscode" id="permanent_poscode" maxlength="5" oninput="onlyNumberOnInputText(this); checkInput('permanent_poscode', 'permanent_poscodeAlert')" disabled>
                                        <div id="permanent_poscodeAlert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Bandar</label>
                                        <input type="text" class="form-control" value="" name="permanent_city" id="permanent_city" oninput="checkInput('permanent_city', 'permanent_cityAlert')" disabled>
                                        <div id="permanent_cityAlert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Negeri</label>
                                        <select class="select2 form-control" name="permanent_state" id="permanent_state" disabled>
                                            <option value="" hidden>Negeri</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div id="permanent_stateAlert" style="color: red; font-size: smaller;"></div>
                                    </div>
                                </div>
                                <div id="button_action_alamat" style="display:none">
                                    <button type="button" id="btnEditAlamat" hidden onclick="generalFormSubmit(this);"></button>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditAlamat', {
                                            permanent_address_1: $('#permanent_address_1').val(),
                                            permanent_address_2: $('#permanent_address_2').val(),
                                            permanent_address_3: $('#permanent_address_3').val(),
                                            permanent_poscode: $('#permanent_poscode').val(),
                                            permanent_city: $('#permanent_city').val(),
                                            permanent_state: $('#permanent_state').find(':selected').text(),
                                            // address_1: $('#address_1').val(),
                                            // address_2: $('#address_2').val(),
                                            // address_3: $('#address_3').val(),
                                            // poscode: $('#poscode').val(),
                                            // city: $('#city').val(),
                                            // state: $('#state').find(':selected').text(),
                                        },{
                                            permanent_address_1: 'Alamat Tetap(1)',
                                            permanent_address_2: 'Alamat Tetap(2)',
                                            permanent_address_3: 'Alamat Tetap(3)',
                                            permanent_poscode: 'Poskod Alamat Tetap',
                                            permanent_city: 'Bandar Alamat Tetap',
                                            permanent_state: 'Negeri Alamat Tetap',
                                            // address_1: 'Alamat Menyurat(1)',
                                            // address_2: 'Alamat Menyurat(2)',
                                            // address_3: 'Alamat Menyurat(3)',
                                            // poscode: 'Poskod Alamat Menyurat',
                                            // city: 'Bandar Alamat Menyurat',
                                            // state: 'Negeri Alamat Menyurat',
                                        }
                                        );">
                                            <i class="fa fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </div>
                            </form> {{-- TUTUP FORM SINI --}}
                        </div>
                    </div>
                </div>

                {{-- HISTORY ALAMAT TETAP --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_stpm">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_stpm" aria-expanded="false" aria-controls="history_stpm">
                            Jejak Audit [Alamat Tetap]
                        </button>
                    </h2>
                    <div id="history_stpm" class="accordion-collapse collapse" aria-labelledby="heading_history_stpm" data-bs-parent="#accordion_stpm">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Tarikh Mula</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Tarikh Akhir</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="d-flex justify-content-end align-items-center">
                                    <a class="me-3" type="button" id="reset" href="#">
                                        <span class="text-danger"> Set Semula </span>
                                    </a>
                                    <button type="submit" class="btn btn-success float-right">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive mb-1 mt-1">
                                <table class="table header_uppercase table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Maklumat</th>
                                            <th>Status</th>
                                            <th>Tarikh</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALAMAT SURAT MENYURAT --}}
        <div id="alamat-surat-info" class="content parent-tab" role="tabpanel" aria-labelledby="alamat-surat-info-trigger">
            <div class="accordion" id="accordion_stam">
                {{-- ALAMAT SURAT MENYURAT --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_result_stam">
                        <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#result_stam" aria-expanded="true" aria-controls="result_stam">
                            Alamat Surat Menyurat
                        </button>
                    </h2>
                    <div id="result_stam" class="accordion-collapse collapse show" aria-labelledby="heading_result_stam" data-bs-parent="#accordion_stam">
                        <div class="accordion-body">

                            {{-- Button kemaskini alamat surat menyurat --}}
                            <div class="d-flex justify-content-end align-items-center mb-1" id="" style="display:none">
                                <a class="me-3 text-danger" type="button" onclick="editAlamatTetap()">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Kemaskini
                                </a>
                            </div>

                            {{-- Form alamat surat menyurat --}}
                            <form id="alamatsuratForm" action="{{ route('alamat-surat.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadAlamatTetap" data-reloadPage="false">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" class="form-control" value="" name="address_1" id="address_1" oninput="checkInput('address_1', 'address_1Alert')" disabled>
                                        <div id="address_1Alert" style="color: red; font-size: smaller;"></div>

                                        <br>
                                        <input type="text" class="form-control" value="" name="address_2" id="address_2" oninput="checkInput('address_2', 'address_2Alert')" disabled>
                                        <div id="address_2Alert" style="color: red; font-size: smaller;"></div>

                                        <br>
                                        <input type="text" class="form-control" value="" name="address_3" id="address_3" oninput="checkInput('address_3', 'address_3Alert')" disabled>
                                        <div id="address_3Alert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Poskod</label>
                                        <input type="text" class="form-control" value="" name="poscode" id="poscode" maxlength="5" oninput="onlyNumberOnInputText(this); checkInput('poscode', 'poscodeAlert')"  disabled>
                                        <div id="poscodeAlert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Bandar</label>
                                        <input type="text" class="form-control" value="" name="city" id="city" oninput="checkInput('city', 'cityAlert')" disabled>
                                        <div id="cityAlert" style="color: red; font-size: smaller;"></div>
                                    </div>

                                    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                        <label class="form-label">Negeri</label>
                                        <select class="select2 form-control" name="state" id="state" disabled>
                                            <option value="" hidden>Negeri</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                                @endforeach
                                        </select>
                                        <div id="stateAlert" style="color: red; font-size: smaller;"></div>
                                    </div>
                                </div>
                                <div id="button_action_alamat_tetap" style="display:none">
                                    <button type="button" id="btnEditAlamatTetap" hidden onclick="generalFormSubmit(this);"></button>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditAlamatTetap', {
                                            // permanent_address_1: $('#permanent_address_1').val(),
                                            // permanent_address_2: $('#permanent_address_2').val(),
                                            // permanent_address_3: $('#permanent_address_3').val(),
                                            // permanent_poscode: $('#permanent_poscode').val(),
                                            // permanent_city: $('#permanent_city').val(),
                                            // permanent_state: $('#permanent_state').find(':selected').text(),
                                            address_1: $('#address_1').val(),
                                            address_2: $('#address_2').val(),
                                            address_3: $('#address_3').val(),
                                            poscode: $('#poscode').val(),
                                            city: $('#city').val(),
                                            state: $('#state').find(':selected').text(),
                                        },{
                                            // permanent_address_1: 'Alamat Tetap(1)',
                                            // permanent_address_2: 'Alamat Tetap(2)',
                                            // permanent_address_3: 'Alamat Tetap(3)',
                                            // permanent_poscode: 'Poskod Alamat Tetap',
                                            // permanent_city: 'Bandar Alamat Tetap',
                                            // permanent_state: 'Negeri Alamat Tetap',
                                            address_1: 'Alamat Menyurat(1)',
                                            address_2: 'Alamat Menyurat(2)',
                                            address_3: 'Alamat Menyurat(3)',
                                            poscode: 'Poskod Alamat Menyurat',
                                            city: 'Bandar Alamat Menyurat',
                                            state: 'Negeri Alamat Menyurat',
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

                {{-- HISTORY ALAMAT SURAT MENYURAT --}}
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_history_stam">
                        <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_stam" aria-expanded="false" aria-controls="history_stam">
                            Jejak Audit [Alamat Surat Menyurat]
                        </button>
                    </h2>
                    <div id="history_stam" class="accordion-collapse collapse" aria-labelledby="heading_history_stam" data-bs-parent="#accordion_stam">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Tarikh Mula</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Tarikh Akhir</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="d-flex justify-content-end align-items-center">
                                    <a class="me-3" type="button" id="reset" href="#">
                                        <span class="text-danger"> Set Semula </span>
                                    </a>
                                    <button type="submit" class="btn btn-success float-right">
                                        <i class="fa fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive mb-1 mt-1">
                                <table class="table header_uppercase table-bordered table-hovered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Maklumat</th>
                                            <th>Status</th>
                                            <th>Tarikh</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- IDK WHERE TO PASTE THIS --}}

<script>
    function editAlamat() {
        $('#alamatForm input[name="permanent_address_1"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_address_2"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_address_3"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_poscode"]').attr('disabled', false);
        $('#alamatForm input[name="permanent_city"]').attr('disabled', false);
        $('#alamatForm select[name="permanent_state"]').attr('disabled', false);
        // $('#alamatForm input[name="address_1"]').attr('disabled', false);
        // $('#alamatForm input[name="address_2"]').attr('disabled', false);
        // $('#alamatForm input[name="address_3"]').attr('disabled', false);
        // $('#alamatForm input[name="poscode"]').attr('disabled', false);
        // $('#alamatForm input[name="city"]').attr('disabled', false);
        // $('#alamatForm select[name="state"]').attr('disabled', false);

        $("#button_action_alamat").attr("style", "display:block");
    }

    function reloadAlamat() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadAlamatUrl = "{{ route('alamat.details', ':replaceThis') }}"
        reloadAlamatUrl = reloadAlamatUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadAlamatUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#alamatForm input[name="permanent_address_1"]').val(data.detail.alamat_1_tetap);
                $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_address_2"]').val(data.detail.alamat_2_tetap);
                $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_address_3"]').val(data.detail.alamat_3_tetap);
                $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_poscode"]').val(data.detail.poskod_tetap);
                $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                $('#alamatForm input[name="permanent_city"]').val(data.detail.bandar_tetap);
                $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                $('#alamatForm select[name="permanent_state"]').val(data.detail.tempat_tinggal_tetap).trigger('change');
                $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                // $('#alamatForm input[name="address_1"]').val(data.detail.alamat_1);
                // $('#alamatForm input[name="address_1"]').attr('disabled', true);
                // $('#alamatForm input[name="address_2"]').val(data.detail.alamat_2);
                // $('#alamatForm input[name="address_2"]').attr('disabled', true);
                // $('#alamatForm input[name="address_3"]').val(data.detail.alamat_3);
                // $('#alamatForm input[name="address_3"]').attr('disabled', true);
                // $('#alamatForm input[name="poscode"]').val(data.detail.poskod);
                // $('#alamatForm input[name="poscode"]').attr('disabled', true);
                // $('#alamatForm input[name="city"]').val(data.detail.bandar);
                // $('#alamatForm input[name="city"]').attr('disabled', true);
                // $('#alamatForm select[name="state"]').val(data.detail.tempat_tinggal).trigger('change');
                // $('#alamatForm select[name="state"]').attr('disabled', true);

                $("#button_action_alamat").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }

    function editAlamatTetap() {
        // $('#alamatForm input[name="permanent_address_1"]').attr('disabled', false);
        // $('#alamatForm input[name="permanent_address_2"]').attr('disabled', false);
        // $('#alamatForm input[name="permanent_address_3"]').attr('disabled', false);
        // $('#alamatForm input[name="permanent_poscode"]').attr('disabled', false);
        // $('#alamatForm input[name="permanent_city"]').attr('disabled', false);
        // $('#alamatForm select[name="permanent_state"]').attr('disabled', false);
        $('#alamatsuratForm input[name="address_1"]').attr('disabled', false);
        $('#alamatsuratForm input[name="address_2"]').attr('disabled', false);
        $('#alamatsuratForm input[name="address_3"]').attr('disabled', false);
        $('#alamatsuratForm input[name="poscode"]').attr('disabled', false);
        $('#alamatsuratForm input[name="city"]').attr('disabled', false);
        $('#alamatsuratForm select[name="state"]').attr('disabled', false);

        $("#button_action_alamat_tetap").attr("style", "display:block");
    }

    function reloadAlamatTetap() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadAlamatUrl = "{{ route('alamat-surat.details', ':replaceThis') }}"
        reloadAlamatUrl = reloadAlamatUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadAlamatUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                // $('#alamatForm input[name="permanent_address_1"]').val(data.detail.alamat_1_tetap);
                // $('#alamatForm input[name="permanent_address_1"]').attr('disabled', true);
                // $('#alamatForm input[name="permanent_address_2"]').val(data.detail.alamat_2_tetap);
                // $('#alamatForm input[name="permanent_address_2"]').attr('disabled', true);
                // $('#alamatForm input[name="permanent_address_3"]').val(data.detail.alamat_3_tetap);
                // $('#alamatForm input[name="permanent_address_3"]').attr('disabled', true);
                // $('#alamatForm input[name="permanent_poscode"]').val(data.detail.poskod_tetap);
                // $('#alamatForm input[name="permanent_poscode"]').attr('disabled', true);
                // $('#alamatForm input[name="permanent_city"]').val(data.detail.bandar_tetap);
                // $('#alamatForm input[name="permanent_city"]').attr('disabled', true);
                // $('#alamatForm select[name="permanent_state"]').val(data.detail.tempat_tinggal_tetap).trigger('change');
                // $('#alamatForm select[name="permanent_state"]').attr('disabled', true);
                $('#alamatsuratForm input[name="address_1"]').val(data.detail.alamat_1);
                $('#alamatsuratForm input[name="address_1"]').attr('disabled', true);
                $('#alamatsuratForm input[name="address_2"]').val(data.detail.alamat_2);
                $('#alamatsuratForm input[name="address_2"]').attr('disabled', true);
                $('#alamatsuratForm input[name="address_3"]').val(data.detail.alamat_3);
                $('#alamatsuratForm input[name="address_3"]').attr('disabled', true);
                $('#alamatsuratForm input[name="poscode"]').val(data.detail.poskod);
                $('#alamatsuratForm input[name="poscode"]').attr('disabled', true);
                $('#alamatsuratForm input[name="city"]').val(data.detail.bandar);
                $('#alamatsuratForm input[name="city"]').attr('disabled', true);
                $('#alamatsuratForm select[name="state"]').val(data.detail.tempat_tinggal).trigger('change');
                $('#alamatsuratForm select[name="state"]').attr('disabled', true);

                $("#button_action_alamat_tetap").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
