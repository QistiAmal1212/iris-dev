<div class="accordion" id="accordion_birth_place">
    {{-- Tempat Lahir --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_birth_place">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#birth_place_info" aria-expanded="true" aria-controls="birth_place_info">
                Tempat Lahir
            </button>
        </h2>
        <div id="birth_place_info" class="accordion-collapse collapse show" aria-labelledby="heading_birth_place" data-bs-parent="#accordion_birth_place">
            <div class="accordion-body">

                <div class="d-flex justify-content-end align-items-center mb-1" id="update_tempat_lahir" style="display:none">
                    <a class="me-3 text-danger" type="button" onclick="editTempatLahir()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>

                <form id="tempatLahirForm" action="{{ route('tempat-lahir.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadTempatLahir" data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="tempat_lahir_no_pengenalan" id="tempat_lahir_no_pengenalan" value="">

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tempat Lahir</label>
                            <select class="select2 form-control" name="place_of_birth" id="place_of_birth" disabled>
                                <option value="" hidden>Tempat Lahir</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tempat Lahir Ayah</label>
                            <select class="select2 form-control" name="father_place_of_birth" id="father_place_of_birth" disabled>
                                <option value="" hidden>Tempat Lahir Ayah</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tempat Lahir Ibu</label>
                            <select class="select2 form-control" name="mother_place_of_birth" id="mother_place_of_birth" disabled>
                                <option value="" hidden>Tempat Lahir Ibu</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->kod }}">{{ $state->nama }}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="button_action_tempat_lahir" style="display:none">
                        <button type="button" id="btnEditTempatLahir" hidden onclick="generalFormSubmit(this);"></button>
                        <div class="d-flex justify-content-end align-items-center my-1">
                            <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditTempatLahir', {
                                place_of_birth: $('#place_of_birth').find(':selected').text(),
                                father_place_of_birth: $('#father_place_of_birth').find(':selected').text(),
                                mother_place_of_birth: $('#mother_place_of_birth').find(':selected').text(),
                            },{
                                place_of_birth: 'Tempat Lahir',
                                father_place_of_birth: 'Tempat Lahir Ayah',
                                mother_place_of_birth: 'Tempat Lahir Ibu',
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

    {{-- Tempat Lahir HISTORY --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_history_birth_place">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_birth_place" aria-expanded="false" aria-controls="history_birth_place">
                Jejak Audit [Tempat Lahir]
            </button>
        </h2>
        <div id="history_birth_place" class="accordion-collapse collapse" aria-labelledby="heading_history_birth_place" data-bs-parent="#accordion_birth_place">
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
    function editTempatLahir() {
        $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', false);
        $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', false);
        $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', false);

        $("#button_action_tempat_lahir").attr("style", "display:block");
    }

    function reloadTempatLahir() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadTempatLahirUrl = "{{ route('tempat-lahir.details', ':replaceThis') }}"
        reloadTempatLahirUrl = reloadTempatLahirUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadTempatLahirUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#tempatLahirForm select[name="place_of_birth"]').val(data.detail.tempat_lahir).trigger('change');
                $('#tempatLahirForm select[name="place_of_birth"]').attr('disabled', true);
                $('#tempatLahirForm select[name="father_place_of_birth"]').val(data.detail.tempat_lahir_bapa).trigger('change');
                $('#tempatLahirForm select[name="father_place_of_birth"]').attr('disabled', true);
                $('#tempatLahirForm select[name="mother_place_of_birth"]').val(data.detail.tempat_lahir_ibu).trigger('change');
                $('#tempatLahirForm select[name="mother_place_of_birth"]').attr('disabled', true);

                $("#button_action_tempat_lahir").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
