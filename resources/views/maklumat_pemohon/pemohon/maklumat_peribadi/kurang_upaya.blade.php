<div class="accordion" id="accordion_oku_info">
    {{-- Kurang Upaya (OKU) --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_oku_info">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#oku_info" aria-expanded="true" aria-controls="oku_info">
                Kurang Upaya (OKU)
            </button>
        </h2>
        <div id="oku_info" class="accordion-collapse collapse show" aria-labelledby="heading_oku_info" data-bs-parent="#accordion_oku_info">
            <div class="accordion-body">


                <div class="d-flex justify-content-end align-items-center mb-1" id="update_oku" style="display:none">
                    <a class="me-3 text-danger" type="button" onclick="editOKU()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>

                <form id="okuForm" action="{{ route('oku.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadOKU" data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="oku_no_pengenalan" id="oku_no_pengenalan" value="">

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">No. Pendaftaran OKU</label>
                            <input type="text" class="form-control" value="" name="oku_registration_no" id="oku_registration_no" oninput="checkInput('oku_registration_no', 'oku_registration_noAlert')" disabled>
                            <div id="oku_registration_noAlert" style="color: red; font-size: smaller;"></div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Status OKU</label>
                            <input type="text" class="form-control" value="" name="oku_status" id="oku_status" oninput="checkInput('oku_status', 'oku_statusAlert')" disabled>
                            <div id="oku_statusAlert" style="color: red; font-size: smaller;"></div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Kategori OKU</label>
                            <select class="select2 form-control" name="oku_category" id="oku_category" disabled>
                                <option value="" hidden>Kategori OKU</option>
                                    @foreach($kategoriOKU as $kategori)
                                        <option value="{{ $kategori->kod }}">{{ $kategori->nama }}</option>
                                    @endforeach
                            </select>
                            <div id="oku_categoryAlert" style="color: red; font-size: smaller;"></div>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Sub- Kategori OKU</label>
                            <input type="text" class="form-control" value="" name="oku_sub" id="oku_sub" oninput="checkInput('oku_sub', 'oku_subAlert')" disabled>
                            <div id="oku_subAlert" style="color: red; font-size: smaller;"></div>
                        </div>
                    </div>

                    <div id="button_action_oku" style="display:none">
                        <button type="button" id="btnEditOKU" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditOKU', {
                                oku_registration_no: $('#oku_registration_no').val(),
                                oku_status: $('#oku_status').val(),
                                oku_category: $('#oku_category').find(':selected').text(),
                                oku_sub: $('#oku_sub').val(),
                            },{
                                oku_registration_no: 'No. Pendaftaran OKU',
                                oku_status: 'Status OKU',
                                oku_category: 'Kategori OKU',
                                oku_sub: 'Sub-Kategori OKU',
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

    {{-- Kurang Upaya (OKU) HISTORY --}}
    <div class="accordion-item">
        <!-- <h2 class="accordion-header" id="heading_history_oku">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_oku" aria-expanded="false" aria-controls="history_oku">
                Jejak Audit [Kurang Upaya (OKU)]
            </button>
        </h2> -->
        <div id="history_oku" class="accordion-collapse collapse" aria-labelledby="heading_history_oku" data-bs-parent="#accordion_oku_info">
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
    function editOKU() {
        $('#okuForm input[name="oku_registration_no"]').attr('disabled', false);
        $('#okuForm input[name="oku_status"]').attr('disabled', false);
        $('#okuForm select[name="oku_category"]').attr('disabled', false);
        $('#okuForm input[name="oku_sub"]').attr('disabled', false);

        $("#button_action_oku").attr("style", "display:block");
    }

    function reloadOKU() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadOKUUrl = "{{ route('oku.details', ':replaceThis') }}"
        reloadOKUUrl = reloadOKUUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadOKUUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#okuForm input[name="oku_registration_no"]').val(data.detail.oku.no_daftar_jkm);
                $('#okuForm input[name="oku_registration_no"]').attr('disabled', true);
                $('#okuForm input[name="oku_status"]').val(data.detail.oku.status_oku);
                $('#okuForm input[name="oku_status"]').attr('disabled', true);
                $('#okuForm select[name="oku_category"]').val(data.detail.oku.kategori_oku);
                $('#okuForm select[name="oku_category"]').attr('disabled', true);
                $('#okuForm input[name="oku_sub"]').val(data.detail.oku.sub_oku);
                $('#okuForm input[name="oku_sub"]').attr('disabled', true);

                $("#button_action_oku").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
