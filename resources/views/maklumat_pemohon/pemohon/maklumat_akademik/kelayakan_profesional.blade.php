<div id="update_profesional" style="display:none">
    <div class="d-flex justify-content-end align-items-center mb-1">
        <a class="me-3 text-danger" type="button" onclick="editProfesional()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>

<form
id="profesionalForm"
action="{{ route('profesional.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadProfesional"
data-reloadPage="false">
    @csrf
    <input type="hidden" value="" id="profesional_no_pengenalan" name="profesional_no_pengenalan">
    <input type="hidden" name="id_profesional" id="id_profesional" value="">
    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
            <label class="form-label">No. Ahli</label>
            <input type="text" class="form-control" value="" id="no_ahli_profesional" name="no_ahli_profesional" disabled>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
            <label class="form-label">Kelayakan Profesional / Ikhtisas</label>
            <select class="select2 form-control" id="kelulusan_profesional" name="kelulusan_profesional" disabled>
                <option value="">Kelayakan Profesional / Ikhtisas</option>
                @foreach($jenisPeperiksaan as $kelulusan)
                <option value="{{ $kelulusan->kod }}">{{ $kelulusan->diskripsi }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
            <label class="form-label">Tarikh Keahlian</label>
            <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" id="tarikh_keahlian_profesional" name="tarikh_keahlian_profesional" disabled>
        </div>

        <div id="button_action_profesional" style="display:none">
            <button type="button" id="btnEditProfesional" hidden onclick="generalFormSubmit(this);"></button>
            <div class="d-flex justify-content-end align-items-center my-1">
                <button type="button" class="btn btn-danger me-1" onclick="reloadProfesional()">
                    <i class="fa fa-refresh"></i>
                </button>
                <button type="button" class="btn btn-success float-right" id="btnSaveProfesional" onclick="$('#btnEditProfesional').trigger('click');">
                    <i class="fa fa-save"></i> Tambah
                </button>
            </div>
        </div>
    </div>
</form>

<div class="row mt-2 mb-2">
    <div class="table-responsive">
        <table class="table header_uppercase table-bordered table-hovered" id="table-profesional">
            <thead>
                <tr>
                    <th>Bil.</th>
                    <th>No. Ahli</th>
                    <th>Kelayakan Profesional / Ikhtisas</th>
                    <th>Tarikh Keahlian</th>
                    <th>Kemaskini</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
    function editProfesional() {
        $('#profesionalForm input[name="no_ahli_profesional"]').attr('disabled', false);
        $('#profesionalForm select[name="kelulusan_profesional"]').attr('disabled', false);
        $('#profesionalForm input[name="tarikh_keahlian_profesional"]').attr('disabled', false);

        $("#button_action_profesional").attr("style", "display:block");
    }

    function reloadProfesional() {
        var no_pengenalan = $('#profesional_no_pengenalan').val();
        $('#profesionalForm input[name="profesional_no_pengenalan"]').val(no_pengenalan);

        var reloadProfesionalUrl = "{{ route('profesional.list', ':replaceThis') }}"
        reloadProfesionalUrl = reloadProfesionalUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadProfesionalUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#profesionalForm input[name="no_ahli_profesional"]').val('');
                $('#profesionalForm select[name="kelulusan_profesional"]').val('').trigger('change');
                $('#profesionalForm input[name="tarikh_keahlian_profesional"]').val('');
                $('#profesionalForm input[name="no_ahli_profesional"]').attr('disabled', true);
                $('#profesionalForm select[name="kelulusan_profesional"]').attr('disabled', true);
                $('#profesionalForm input[name="tarikh_keahlian_profesional"]').attr('disabled', true);
                $('#profesionalForm').attr('action', "{{ route('profesional.store')  }}");
                $('#btnSaveProfesional').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_profesional").attr("style", "display:none");

                $('#table-profesional tbody').empty();
                var trProfessional = '';
                var bilProfessional = 0;
                if(data.detail != null){
                    $.each(data.detail, function(i, item) {
                        bilProfessional += 1;
                        trProfessional += '<tr>';
                        trProfessional += '<td align="center">' + bilProfessional + '</td>'
                        trProfessional += '<td>' + (item.no_ahli ? item.no_ahli : '') + '</td>';
                        trProfessional += '<td>' + (item.qualification ? item.qualification.diskripsi : '') + '</td>';
                        trProfessional += '<td>' + (item.tarikh ? item.tarikh : '') + '</td>';
                        trProfessional += '<td align="center"><i class="fas fa-pencil text-primary editProfesional-btn" data-id="' + item.id + ' "></i>';
                        trProfessional += '&nbsp;&nbsp;';
                        trProfessional += '<i class="fas fa-trash text-danger deleteProfesional-btn" data-id="' + item.id + '"></i></td>';
                        trProfessional += '</tr>';
                    });
                }
                $('#table-profesional tbody').append(trProfessional);

                if($('#table-profesional tbody').is(':empty')){
                    var trProfessional = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-profesional tbody').append(trProfessional);

                    var tmProfesionalElement = $("#tm_ikhtisas");
                    tmProfesionalElement.removeAttr("hidden");
                }else{
                    var tmProfesionalElement = $("#tm_ikhtisas");
                    tmProfesionalElement.attr("hidden", true);
                }

                $(document).on('click', '.editProfesional-btn', function() {
                    $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#profesionalForm').attr('action', "{{ route('profesional.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#profesionalForm input[name="id_profesional"]').val(id);
                    $('#profesionalForm input[name="no_ahli_profesional"]').val($(row).find('td:nth-child(2)').text());
                    var kelayakanName = $(row).find('td:nth-child(3)').text();
                    $('#profesionalForm select[name="kelulusan_profesional"] option').filter(function() {
                        return $(this).text() === kelayakanName;
                    }).prop('selected', true).trigger('change');
                    $('#profesionalForm input[name="tarikh_keahlian_profesional"]').val($(row).find('td:nth-child(4)').text());
                });


                $(document).on('click', '.deleteProfesional-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('profesional.delete', ':replaceThis') }}", reloadProfesional )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

</script>
