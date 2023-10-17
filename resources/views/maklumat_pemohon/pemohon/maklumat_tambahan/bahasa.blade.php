<div class="card" id="update_bahasa" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editBahasa()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="bahasaForm"
action="{{ route('bahasa.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadBahasa"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="bahasa_no_pengenalan" id="bahasa_no_pengenalan" value="">
    <input type="hidden" name="id_bahasa" id="id_bahasa" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Bahasa</label>
        <select class="select2 form-control" value="" id="nama_bahasa" name="nama_bahasa" disabled>
            <option value=""></option>
            @foreach($Bahasa as $bahasa)
            <option value="{{ $bahasa->kod }}">{{ $bahasa->diskripsi }}</option>
            @endforeach
        </select>
    </div>
    <div class="col sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Penguasaan</label>
        <select class="select2 form-control" value="" id="penguasaan_bahasa" name="penguasaan_bahasa" disabled>
            <option value=""></option>
            @foreach($kategoriPenguasaan as $penguasaan)
            <option value="{{ $penguasaan->kod }}">{{ $penguasaan->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div id="button_action_bahasa" style="display:none">
        <button type="button" id="btnEditBahasa" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-danger float-right" onclick="reloadBahasa()">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success float-right" id="btnSaveBahasa" onclick="$('#btnEditBahasa').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</div>
</form>
<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-language">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Bahasa</th>
                <th>Penguasaan Bahasa</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
                    trLanguage += '<td>' + item.language.diskripsi + '</td>';
                    trLanguage += '<td>' + item.kategori.diskripsi + '</td>';
                    trLanguage += '<td align="center"><i class="fas fa-pencil text-primary editBahasa-btn" data-id="' + item.id + ' " data-form="bahasa"></i>';
                    trLanguage += '&nbsp;&nbsp;';
                    trLanguage += '<i class="fas fa-trash text-danger deleteBahasa-btn" data-id="' + item.id + '"></i></td>';
                    trLanguage += '</tr>';
                });
                $('#table-language tbody').append(trLanguage);

                if($('#table-language tbody').is(':empty')){
                    var trLanguage = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-language tbody').append(trLanguage);

                    var tmBahasaElement = $("#tm_bahasa");
                    tmBahasaElement.removeAttr("hidden");
                }else{
                    var tmBakatElement = $("#tm_bahasa");
                    tmBakatElement.attr("hidden", true);
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
