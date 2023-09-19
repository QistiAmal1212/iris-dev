<div class="card" id="update_psl" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPsl()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="pslForm"
action="{{ route('psl.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPsl"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="psl_no_pengenalan" id="psl_no_pengenalan" value="">
    <input type="hidden" name="id_psl" id="id_psl" value="">

    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Jenis Peperiksaan</label>
        <select class="select2 form-control" value="" id="jenis_peperiksaan" name="jenis_peperiksaan" disabled>
            <option value=""></option>
            @foreach($jenisPeperiksaan as $peperiksaan)
            <option value="{{ $peperiksaan->code }}">{{ $peperiksaan->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Tarikh Peperiksaan</label>
        <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="tarikh_peperiksaan" id="tarikh_peperiksaan" disabled />
    </div>

    <div id="button_action_psl" style="display:none">
        <button type="button" id="btnEditPsl" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditPsl').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>
</div>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-psl">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Jenis Peperiksaan</th>
                <th>Tarikh Peperiksaan</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>

    function editPsl() {
        $('#pslForm select[name="jenis_peperiksaan"]').attr('disabled', false);
        $('#pslForm input[name="tarikh_peperiksaan"]').attr('disabled', false);

        $("#button_action_psl").attr("style", "display:block");
    }
    function reloadPsl() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#pslForm input[name="psl_no_pengenalan"]').val(no_pengenalan);

        var reloadPslUrl = "{{ route('psl.list', ':replaceThis') }}"
        reloadPslUrl = reloadPslUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPslUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pslForm select[name="jenis_peperiksaan"]').val('').trigger('change');
                $('#pslForm input[name="tarikh_peperiksaan"]').val('');
                $('#pslForm select[name="jenis_peperiksaan"]').attr('disabled', true);
                $('#pslForm input[name="tarikh_peperiksaan"]').attr('disabled', true);
                $('#pslForm').attr('action', "{{ route('psl.store')  }}");
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_psl").attr("style", "display:none");

                $('#table-psl tbody').empty();
                var trPsl = '';
                var bilPsl = 0;
                $.each(data.detail, function(i, item) {
                        bilPsl += 1;
                        trPsl += '<tr>';
                        trPsl += '<td align="center">' + bilPsl + '</td>'
                        trPsl += '<td>' + item.qualification.name + '</td>';
                        trPsl += '<td>' + (item.exam_date ? item.exam_date : '') + '</td>';
                        trPsl += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                        trPsl += '&nbsp;&nbsp;';
                        trPsl += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                        trPsl += '</tr>';

                });
                $('#table-psl tbody').append(trPsl);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#pslForm').attr('action', "{{ route('psl.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#pslForm input[name="id_psl"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#pslForm select[name="jenis_peperiksaan"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#pslForm input[name="tarikh_peperiksaan"]').val($(row).find('td:nth-child(3)').text());
                });


                $(document).on('click', '.delete-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        pslDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function pslDelete(id){
        var reloadPslUrl = "{{ route('psl.delete', ':replaceThis') }}"
        reloadPslUrl = reloadPslUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadPslUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reloadPsl();
            }
        });
    }
</script>
