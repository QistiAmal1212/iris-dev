<div class="card" id="update_bakat" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editBakat()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="bakatForm"
action="{{ route('bakat.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadBakat"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="bakat_no_pengenalan" id="bakat_no_pengenalan" value="">
    <input type="hidden" name="id_bakat" id="id_bakat" value="">
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Bakat</label>
        <select class="select2 form-control" value="" id="nama_bakat" name="nama_bakat" disabled>
            <option value=""></option>
            @foreach($talentkod as $bakat)
            <option value="{{ $bakat->code }}">{{ $bakat->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="button_action_bakat" style="display:none">
        <button type="button" id="btnEditBakat" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditBakat').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>
</div>
<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-talent">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Bakat</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    function editBakat() {
        $('#bakatForm select[name="nama_bakat"]').attr('disabled', false);

        $("#button_action_bakat").attr("style", "display:block");
    }
    function reloadBakat() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#bakatForm input[name="bakat_no_pengenalan"]').val(no_pengenalan);

        var reloadBakatUrl = "{{ route('bakat.list', ':replaceThis') }}"
        reloadBakatUrl = reloadBakatUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadBakatUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#bakatForm select[name="nama_bakat"]').val('').trigger('change');
                $('#bakatForm select[name="nama_bakat"]').attr('disabled', true);
                $('#bakatForm').attr('action', "{{ route('bakat.store')  }}");
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_bakat").attr("style", "display:block");

                $('#table-talent tbody').empty();
                var trBakat = '';
                var bilBakat = 0;
                $.each(data.detail, function(i, item) {
                    bilBakat += 1;
                    trBakat += '<tr>';
                    trBakat += '<td align="center">' + bilBakat + '</td>'
                    trBakat += '<td>' + item.talent.name + '</td>';
                    trBakat += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                    trBakat += '&nbsp;&nbsp;';
                    trBakat += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                    trBakat += '</tr>';
                });
                $('#table-talent tbody').append(trBakat);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#bakatForm').attr('action', "{{ route('bakat.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#bakatForm input[name="id_bakat"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#bakatForm select[name="nama_bakat"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
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
                        bakatDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function bakatDelete(id){
        var reloadBakatUrl = "{{ route('bakat.delete', ':replaceThis') }}"
        reloadBakatUrl = reloadBakatUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadBakatUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reloadBakat();
            }
        });
    }
</script>
