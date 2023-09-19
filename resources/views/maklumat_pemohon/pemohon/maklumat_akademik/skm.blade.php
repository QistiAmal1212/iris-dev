<div class="card" id="update_skm" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editSkm()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="skmForm"
action="{{ route('skm.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadSkm"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="skm_no_pengenalan" id="skm_no_pengenalan" value="">
    <input type="hidden" name="id_skm" id="id_skm" value="">

    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="nama_skm" name="nama_skm" disabled>
            <option value=""></option>
            @foreach($skmkod as $skm)
            <option value="{{ $skm->code }}">{{ $skm->name }}</option>
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
            <button type="button" class="btn btn-danger float-right" onclick="reloadSkm()">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditSkm').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>
</div>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-skm">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Kelulusan</th>
                <th>Tahun</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
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
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_skm").attr("style", "display:none");

                $('#table-skm tbody').empty();
                var trSkm = '';
                var bilSkm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.qualification != null) {
                        bilSkm += 1;
                        trSkm += '<tr>';
                        trSkm += '<td align="center">' + bilSkm + '</td>';
                        trSkm += '<td>' + (item.qualification ? item.qualification.name : "Tiada Maklumat")  + '</td>';
                        trSkm += '<td align="center">' + item.year + '</td>';
                        trSkm += '<td align="center"><i class="fas fa-pencil text-primary editSkm-btn" data-id="' + item.id + ' " data-form="skm"></i>';
                        trSkm += '&nbsp;&nbsp;';
                        trSkm += '<i class="fas fa-trash text-danger deleteSkm-btn" data-id="' + item.id + '"></i></td>';
                        trSkm += '</tr>';
                    }
                });
                $('#table-skm tbody').append(trSkm);

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
