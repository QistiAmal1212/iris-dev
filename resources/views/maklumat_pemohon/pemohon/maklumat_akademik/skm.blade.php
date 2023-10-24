<div class="accordion" id="accordion_skm">
    {{-- Sijil Kemahiran (SKM) --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_skm_info">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#skm_info" aria-expanded="true" aria-controls="skm_info">
                Sijil Kemahiran (SKM)
            </button>
        </h2>
        <div id="skm_info" class="accordion-collapse collapse show" aria-labelledby="heading_skm_info" data-bs-parent="#accordion_skm">
            <div class="accordion-body">
                <div id="update_skm" style="display:none">
                    <div class="d-flex justify-content-end align-items-center my-1 ">
                        <a class="me-3 text-danger" type="button" onclick="editSkm()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form id="skmForm" action="{{ route('skm.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadSkm" data-reloadPage="false">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="skm_no_pengenalan" id="skm_no_pengenalan" value="">
                        <input type="hidden" name="id_skm" id="id_skm" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Nama Sijil</label>
                            <select class="select2 form-control" value="" id="nama_skm" name="nama_skm" disabled>
                                <option value=""></option>
                                @foreach($skmkod as $skm)
                                <option value="{{ $skm->kod }}">{{ $skm->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_skm" name="tahun_skm" disabled>
                        </div>

                        <div id="button_action_skm" style="display:none">
                            <button type="button" id="btnEditSkm" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger me-1" onclick="reloadSkm()">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-success float-right" id="btnSaveSkm" onclick="$('#btnEditSkm').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive mt-1 mb-1">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-skm">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>Kelulusan</th>
                                <th>Tahun</th>
                                <th>Kemaskini</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Sijil Kemahiran (SKM) HISTORY --}}
    <div class="accordion-item">
        <!-- <h2 class="accordion-header" id="heading_history_skm">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_skm" aria-expanded="false" aria-controls="history_skm">
                Jejak Audit [Sijil Kemahiran (SKM)]
            </button>
        </h2> -->
        <div id="history_skm" class="accordion-collapse collapse" aria-labelledby="heading_history_skm" data-bs-parent="#accordion_skm">
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
    function editSkm() {
        $('#skmForm select[name="nama_skm"]').attr('disabled', false);
        $('#skmForm input[name="tahun_skm"]').attr('disabled', false);

        $("#button_action_skm").attr("style", "display:block");
    }
    function reloadSkm() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadSkmUrl = "{{ route('skm.list', ':replaceThis') }}"
        reloadSkmUrl = reloadSkmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSkmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#skmForm select[name="nama_skm"]').val('').trigger('change');
                $('#skmForm input[name="tahun_skm"]').val('');
                $('#skmForm select[name="nama_skm"]').attr('disabled', true);
                $('#skmForm input[name="tahun_skm"]').attr('disabled', true);
                $('#skmForm').attr('action', "{{ route('skm.store')  }}");
                $('#btnSaveSkm').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_skm").attr("style", "display:none");

                $('#table-skm tbody').empty();
                var trSkm = '';
                var bilSkm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.qualification != null) {
                        bilSkm += 1;
                        trSkm += '<tr>';
                        trSkm += '<td align="center">' + bilSkm + '</td>';
                        trSkm += '<td>' + (item.qualification ? item.qualification.diskripsi : "Tiada Maklumat")  + '</td>';
                        trSkm += '<td align="center">' + item.tahun_lulus + '</td>';
                        trSkm += '<td align="center"><i class="fas fa-pencil text-primary editSkm-btn" data-id="' + item.id + ' " data-form="skm"></i>';
                        trSkm += '&nbsp;&nbsp;';
                        trSkm += '<i class="fas fa-trash text-danger deleteSkm-btn" data-id="' + item.id + '"></i></td>';
                        trSkm += '</tr>';
                    }
                });
                $('#table-skm tbody').append(trSkm);

                if($('#table-skm tbody').is(':empty')){
                    var trSkm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    $('#table-skm tbody').append(trSkm);

                    var tmSkmElement = $("#tm_skm");
                    tmSkmElement.removeAttr("hidden");
                }else{
                    var tmSkmElement = $("#tm_skm");
                    tmSkmElement.attr("hidden", true);
                }

                $(document).on('click', '.editSkm-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#skmForm').attr('action', "{{ route('skm.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#skmForm input[name="id_skm"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#skmForm select[name="nama_skm"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#skmForm input[name="tahun_skm"]').val($(row).find('td:nth-child(3)').text());
                });

                $(document).on('click', '.deleteSkm-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('skm.delete', ':replaceThis') }}", reloadSkm )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
