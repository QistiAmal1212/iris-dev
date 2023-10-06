<div class="accordion" id="accordion_tentera">
    {{-- Maklumat Bekas Tentera --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_tentera_info">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#tentera_info" aria-expanded="true" aria-controls="tentera_info">
                Maklumat Bekas Tentera
            </button>
        </h2>
        <div id="tentera_info" class="accordion-collapse collapse show" aria-labelledby="heading_tentera_info" data-bs-parent="#accordion_tentera">
            <div class="accordion-body">

                <div class="d-flex justify-content-end align-items-center mb-1" id="update_tentera_polis" style="display:none">
                    <a class="me-3 text-danger" type="button" onclick="editTenteraPolis()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>

                <form id="tenteraPolisForm" action="{{ route('tentera-polis.update') }}" method="POST" data-refreshFunctionNameIfSuccess="reloadTenteraPolis" data-reloadPage="false">
                    @csrf
                    <div class="row">

                        <input type="hidden" name="tentera_polis_no_pengenalan" id="tentera_polis_no_pengenalan" value="">

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Kategori</label>
                            <select class="select2 form-control" name="jenis_perkhidmatan_tentera_polis" id="jenis_perkhidmatan_tentera_polis" disabled>
                                <option value="" hidden>Kategori</option>
                                    @foreach($jenisPerkhidmatan as $perkhidmatan)
                                        <option value="{{ $perkhidmatan->id }}">{{ $perkhidmatan->name }}</option>
                                    @endforeach
                            <select>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Pangkat dalam Tentera</label>
                            <select class="select2 form-control" name="pangkat_tentera_polis" id="pangkat_tentera_polis" disabled>
                                <option value="" hidden>Pangkat dalam Tentera</option>
                                    @foreach($ranks as $rank)
                                        <option value="{{ $rank->code }}">{{ $rank->name }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                            <label class="form-label">Jenis Penamatan Perkhidmatan</label>
                            <select class="select2 form-control" name="jenis_bekas_tentera_polis" id="jenis_bekas_tentera_polis" disabled>
                                <option value="" hidden>Jenis Penamatan Perkhidmatan</option>
                                    @foreach($jenisBekasTenteraPolis as $bekas)
                                        <option value="{{ $bekas->code }}">{{ $bekas->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="button_action_tentera_polis" style="display:none">
                        <button type="button" id="btnEditTenteraPolis" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditTenteraPolis',
                            {
                                jenis_perkhidmatan_tentera_polis: $('#jenis_perkhidmatan_tentera_polis').find(':selected').text(),
                                pangkat_tentera_polis: $('#pangkat_tentera_polis').find(':selected').text(),
                                jenis_bekas_tentera_polis: $('#jenis_bekas_tentera_polis').find(':selected').text(),
                            },
                            {
                                jenis_perkhidmatan_tentera_polis: 'Kategori',
                                pangkat_tentera_polis: 'Pangkat',
                                jenis_bekas_tentera_polis: 'Jenis Penamatan Perkhidmatan',
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

    {{-- Maklumat Bekas Tentera HISTORY --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_history_tentera">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_tentera" aria-expanded="false" aria-controls="history_tentera">
                Jejak Audit [Maklumat Bekas Tentera]
            </button>
        </h2>
        <div id="history_tentera" class="accordion-collapse collapse" aria-labelledby="heading_history_tentera" data-bs-parent="#accordion_tentera">
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

<script>
    function editTenteraPolis() {
        $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').attr('disabled', false);
        $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').attr('disabled', false);
        $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').attr('disabled', false);

        $("#button_action_tentera_polis").attr("style", "display:block");
    }

    function reloadTenteraPolis() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadTenteraPolisUrl = "{{ route('tentera-polis.details', ':replaceThis') }}"
        reloadTenteraPolisUrl = reloadTenteraPolisUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadTenteraPolisUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').val(data.detail.jenis_pkhidmat).trigger('change');
                $('#tenteraPolisForm select[name="jenis_perkhidmatan_tentera_polis"]').attr('disabled', true);
                $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').val(data.detail.pangkat_tentera_polis).trigger('change');
                $('#tenteraPolisForm select[name="pangkat_tentera_polis"]').attr('disabled', true);
                $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').val(data.detail.jenis_bekas_tentera).trigger('change');
                $('#tenteraPolisForm select[name="jenis_bekas_tentera_polis"]').attr('disabled', true);
            },
            error: function(data) {
                //
            }
        });
    }
</script>
