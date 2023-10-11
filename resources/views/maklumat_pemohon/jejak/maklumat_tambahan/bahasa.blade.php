<div class="accordion" id="accordion_kebolehan_bahasa">
    {{-- Kebolehan Bahasa --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_bahasa">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#kebolehan_bahasa" aria-expanded="true" aria-controls="kebolehan_bahasa">
                Kebolehan Bahasa
            </button>
        </h2>
        <div id="kebolehan_bahasa" class="accordion-collapse collapse show" aria-labelledby="heading_bahasa" data-bs-parent="#accordion_kebolehan_bahasa">
            <div class="accordion-body">

                <div class="d-flex justify-content-end align-items-center mb-1" id="update_bahasa" style="display:none">
                    <a class="me-3 text-danger" type="button" onclick="editBahasa()">
                        <i class="fa-regular fa-pen-to-square"></i>
                        Kemaskini
                    </a>
                </div>

                <form id="bahasaForm" action="{{ route('bahasa.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadBahasa" data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="bahasa_no_pengenalan" id="bahasa_no_pengenalan" value="">
                        <input type="hidden" name="id_bahasa" id="id_bahasa" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Bahasa</label>
                            <select class="select2 form-control" value="" id="nama_bahasa" name="nama_bahasa" disabled>
                                <option value="" hidden>Bahasa</option>
                                    @foreach($Bahasa as $bahasa)
                                        <option value="{{ $bahasa->kod }}">{{ $bahasa->nama }}</option>
                                    @endforeach
                            </select>
                        </div>
                        
                        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Penguasaan</label>
                            <select class="select2 form-control" value="" id="penguasaan_bahasa" name="penguasaan_bahasa" disabled>
                                <option value="" hidden>Penguasaan</option>
                                    @foreach($kategoriPenguasaan as $penguasaan)
                                        <option value="{{ $penguasaan->kod }}">{{ $penguasaan->nama }}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div id="button_action_bahasa" style="display:none">
                            <button type="button" id="btnEditBahasa" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadBahasa()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveBahasa" onclick="$('#btnEditBahasa').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-language">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Bahasa</th>
                                <th>Penguasaan Bahasa</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Kebolehan Bahasa HISTORY --}}
    <div class="accordion-item">
       <!--  <h2 class="accordion-header" id="heading_history_bahasa">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_bahasa" aria-expanded="false" aria-controls="history_bahasa">
                Jejak Audit [Kebolehan Bahasa]
            </button>
        </h2> -->
        <div id="history_bahasa" class="accordion-collapse collapse" aria-labelledby="heading_history_bahasa" data-bs-parent="#accordion_kebolehan_bahasa">
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
    function editBahasa() {
        $('#bahasaForm select[name="nama_bahasa"]').attr('disabled', false);
        $('#bahasaForm select[name="penguasaan_bahasa"]').attr('disabled', false);

        $("#button_action_bahasa").attr("style", "display:block");
    }
    function reloadBahasa() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#bahasaForm input[name="bahasa_no_pengenalan"]').val(no_pengenalan);

        var reloadBahasaUrl = "{{ route('bahasa.list', ':replaceThis') }}"
        reloadBahasaUrl = reloadBahasaUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadBahasaUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#bahasaForm select[name="nama_bahasa"]').val('').trigger('change');
                $('#bahasaForm select[name="penguasaan_bahasa"]').val('').trigger('change');
                $('#bahasaForm select[name="nama_bahasa"]').attr('disabled', true);
                $('#bahasaForm select[name="penguasaan_bahasa"]').attr('disabled', true);
                $('#bahasaForm').attr('action', "{{ route('bahasa.store')  }}");
                $('#btnSaveBahasa').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_bahasa").attr("style", "display:none");

                $('#table-language tbody').empty();
                var trLanguage = '';
                var bilLanguage = 0;
                $.each(data.detail, function(i, item) {
                    bilLanguage += 1;
                    trLanguage += '<tr>';
                    trLanguage += '<td align="center">' + bilLanguage + '</td>'
                    trLanguage += '<td>' + item.language.nama + '</td>';
                    trLanguage += '<td>' + item.kategori.nama + '</td>';
                    trLanguage += '<td align="center"><i class="fas fa-pencil text-primary editBahasa-btn" data-id="' + item.id + ' " data-form="bahasa"></i>';
                    trLanguage += '&nbsp;&nbsp;';
                    trLanguage += '<i class="fas fa-trash text-danger deleteBahasa-btn" data-id="' + item.id + '"></i></td>';
                    trLanguage += '</tr>';
                });
                $('#table-language tbody').append(trLanguage);

                if($('#table-language tbody').is(':empty')){
                    var trLanguage = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-language tbody').append(trLanguage);
                }

                $(document).on('click', '.editBahasa-btn', function() {
                        $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                        $('#bahasaForm').attr('action', "{{ route('bahasa.update') }}");
                        var row = $(this).closest('tr');
                        var id = $(this).data('id');

                        $('#bahasaForm input[name="id_bahasa"]').val(id);
                        var BahasaName = $(row).find('td:nth-child(2)').text();
                        $('#bahasaForm select[name="nama_bahasa"] option').filter(function() {
                            return $(this).text() === BahasaName;
                        }).prop('selected', true).trigger('change');
                        var levelName = $(row).find('td:nth-child(3)').text();
                        $('#bahasaForm select[name="penguasaan_bahasa"] option').filter(function() {
                            return $(this).text() === levelName;
                        }).prop('selected', true).trigger('change');
                });


                $(document).on('click', '.deleteBahasa-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('bahasa.delete', ':replaceThis') }}", reloadBahasa )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
