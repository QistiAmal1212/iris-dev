<form
id="pmrForm"
action="{{ route('pmr.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPmr"
data-reloadPage="false">
@csrf
<div class="row mt-2 mb-2">
    <input type="hidden" name="pmr_no_pengenalan" id="pmr_no_pengenalan" value="">
    <input type="hidden" name="pmr_id" id="pmr_id" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Mata Pelajaran</label>
        <select class="select2 form-control" value="" id="subjek_pmr" name="subjek_pmr">
            <option value=""></option>
            @foreach($subjekPmr as $subjek)
            <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="gred_pmr" name="gred_pmr">
            <option value=""></option>
            @foreach($gredPmr as $gred)
            <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" id="tahun_pmr" name="tahun_pmr">
    </div>

    <div id="button_action_pmr" style="display:block">
        <button type="button" id="btnEditPmr" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditPmr').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>
</div>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-pmr">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Mata Pelajaran</th>
                <th>Gred</th>
                <th>Tahun</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    function reloadPmr() {
        var no_pengenalan = $('#pmr_no_pengenalan').val();

        var reloadPmrUrl = "{{ route('pmr.list', ':replaceThis') }}"
        reloadPmrUrl = reloadPmrUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPmrUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#pmrForm select[name="subjek_pmr"]').val('').trigger('change');
                $('#pmrForm select[name="gred_pmr"]').val('').trigger('change');
                $('#pmrForm input[name="tahun_pmr"]').val('');

                $('#table-pmr tbody').empty();
                var trPmr = '';
                var bilPmr = 0;
                $.each(data.detail, function(i, item) {
                    if (item.subject != null) {
                        bilPmr += 1;
                        trPmr += '<tr>';
                        trPmr += '<td align="center">' + bilPmr + '</td>';
                        trPmr += '<td>' + item.subject.name + '</td>';
                        trPmr += '<td align="center">' + item.grade + '</td>';
                        trPmr += '<td align="center">' + item.year + '</td>';
                        trPmr += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                        trPmr += '&nbsp;&nbsp;';
                        trPmr += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                        trPmr += '</tr>';
                    }
                });
                $('#table-pmr tbody').append(trPmr);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#pmrForm').attr('action', "{{ route('pmr.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#pmrForm input[name="id_pmr"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#pmrForm select[name="subjek_pmr"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#pmrForm select[name="gred_pmr"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#pmrForm input[name="tahun_pmr"]').val($(row).find('td:nth-child(4)').text());
                });
                $('#pmrForm input[name="pmr_no_pengenalan"]').val(data.detail.no_pengenalan);

                $(document).on('click', '.delete-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        pmrDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function pmrDelete(id){
        var reloadPmrUrl = "{{ route('pmr.delete', ':replaceThis') }}"
        reloadPmrUrl = reloadPmrUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadPmrUrl,
            type: 'POST',
        });
        reloadPmr()
    }
</script>
