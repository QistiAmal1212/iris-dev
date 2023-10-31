<div class="card" id="update_penalty" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPenalty()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<div class="row mt-2 mb-2">

    <form
    id="penaltyForm"
    action="{{ route('penalty.store') }}"
    method="POST"
    data-refreshFunctionName="reloadTimeline"
    data-refreshFunctionNameIfSuccess="reloadPenalty"
    data-reloadPage="false">
    @csrf
    <input type="hidden" name="penalty_no_pengenalan" id="penalty_no_pengenalan" value="">
    <input type="hidden" name="id_penalty" id="id_penalty" value="">
   <!--  <div class="row">
        <div class="col sm-12 col-md-12 col-lg-12 mb-1">
            <label class="form-label fw-bolder">Tindakan Tatatertib</label>
            <select class="form-select select2" name="penalty" id="penalty" disabled>
                <option value=""></option>
                @foreach($penalties as $penalty)
                <option value="{{ $penalty->kod }}">{{ $penalty->diskripsi }}</option>
                @endforeach
            </select>
        </div>
    </div> -->

    <div class="row">
     <!--    <div class="col sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label fw-bolder">Tempoh Hukuman</label>
            <div class="input-group">
                <input type="number" id ="penalty_duration" name="penalty_duration" class="form-control" disabled oninput="calculatePenalty()">
                <select class="form-control" name="penalty_type" id="penalty_type" disabled onchange="calculatePenalty()">
                    <option value="" hidden></option>
                    <option value="Tahun">Tahun</option>
                    <option value="Bulan">Bulan</option>
                    <option value="Hari">Hari</option>
                </select>
            </div>
        </div>

        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label fw-bolder">Tarikh Mula Hukuman</label>
            <input type="text" class="form-control flatpickr" name="penalty_start" id="penalty_start" disabled onchange="calculatePenalty()">
        </div>

        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label fw-bolder">Tarikh Akhir Hukuman</label>
            <input type="text" class="form-control" name="penalty_end" id="penalty_end" disabled>
        </div> -->

    </div>

    <div id="button_action_penalty" style="display:none">
        <button type="button" id="btnAddPenalty" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <a class="me-3" type="button" id="reset" href="#">
                <span class="text-danger"> Set Semula </span>
            </a>
            <button type="button" class="btn btn-success float-right" id="btnSavePenalty" onclick="$('#btnAddPenalty').trigger('click');">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
    </form>

    <hr>

    <div id="div_table_penalty">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered table-hovered" id="table-penalty">
                <thead>
                    <tr>
                        <th>Bil.</th>
                        <th>Tindakan Tatatertib</th>
                        <th>Tempoh Hukuman</th>
                        <th>Tarikh Mula Hukuman</th>
                        <th>Tarikh Akhir Hukuman</th>
                        <!-- <th>Kemaskini</th> -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    function editPenalty() {
        $('#penaltyForm select[name="penalty"]').attr('disabled', false);
        $('#penaltyForm input[name="penalty_duration"]').attr('disabled', false);
        $('#penaltyForm select[name="penalty_type"]').attr('disabled', false);
        $('#penaltyForm input[name="penalty_start"]').attr('disabled', false);
        $('#penaltyForm input[name="penalty_end"]').attr('disabled', false);
        $('#penaltyForm input[name="penalty_end"]').attr('readonly', true);

        $("#button_action_penalty").attr("style", "display:block");
    }

    function calculatePenalty() {
        var penalty_duration = $('#penalty_duration').val();
        var penalty_type = $('#penalty_type').val();
        var penalty_start = $('#penalty_start').val();

        var calculatePenaltyUrl = "{{ route('penalty.calculate') }}"
        if(penalty_duration != '' && penalty_type != '' && penalty_start != '')
        {
            $.ajax({
                url: calculatePenaltyUrl,
                method: 'POST',
                async: true,
                data : {
                    duration : penalty_duration,
                    type : penalty_type,
                    start : penalty_start,
                },
                success: function(data) {
                    $('#penaltyForm input[name="penalty_end"]').val(data.detail);
                },
                error: function(data) {
                    //
                }
            });
        }
    }

    function reloadPenalty() {
        var no_pengenalan = $('#penalty_no_pengenalan').val();
        $('#penaltyForm input[name="penalty_no_pengenalan"]').val(no_pengenalan);

        var reloadPenaltyUrl = "{{ route('penalty.list', ':replaceThis') }}"
        reloadPenaltyUrl = reloadPenaltyUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPenaltyUrl,
            method: 'GET',
            async: true,
            success: function(data) {

                $('#penaltyForm select[name="penalty"]').val('').trigger('change');
                $('#penaltyForm input[name="penalty_duration"]').val('');
                $('#penaltyForm select[name="penalty_type"]').val('');
                $('#penaltyForm input[name="penalty_start"]').val('');
                $('#penaltyForm input[name="penalty_end"]').val('');
                $('#penaltyForm select[name="penalty"]').attr('disabled', true);
                $('#penaltyForm input[name="penalty_duration"]').attr('disabled', true);
                $('#penaltyForm select[name="penalty_type"]').attr('disabled', true);
                $('#penaltyForm input[name="penalty_start"]').attr('disabled', true);
                $('#penaltyForm input[name="penalty_end"]').attr('disabled', true);
                $('#penaltyForm input[name="penalty_end"]').attr('readonly', true);
                $('#penaltyForm').attr('action', "{{ route('penalty.store')  }}");
                $('#btnSavePenalty').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_penalty").attr("style", "display:none");

                $('#table-penalty tbody').empty();

                var trPenalty = '';
                var bilPenalty = 0;
                $.each(data.detail, function (i, item) {
                    bilPenalty += 1;
                    trPenalty += '<tr>';
                    trPenalty += '<td align="center">' + bilPenalty + '</td>'
                    trPenalty += '<td>' + item.penalty.diskripsi + '</td>';
                    trPenalty += '<td>' + item.tempoh + ' ' + item.jenis + '</td>';
                    trPenalty += '<td>' + item.tarikh_mula + '</td>';
                    trPenalty += '<td>' + item.tarikh_tamat + '</td>';
                    // trPenalty += '<td align="center"><i class="fas fa-pencil text-primary editPenalty-btn" data-id="' + item.id + ' "></i>';
                    // trPenalty += '&nbsp;&nbsp;';
                    // trPenalty += '<i class="fas fa-trash text-danger deletePenalty-btn" data-id="' + item.id + '"></i></td>';
                    trPenalty += '</tr>';
                });
                $('#table-penalty tbody').append(trPenalty);

                if($('#table-penalty tbody').is(':empty')){
                    var trPenalty = '<tr><td align="center" colspan="6">Tiada Maklumat</td></tr>';
                    $('#table-penalty tbody').append(trPenalty);
                    $('#tm_tata').removeAttr('hidden');
                }

                $(document).on('click', '.editPenalty-btn', function() {
                        $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                        $('#penaltyForm').attr('action', "{{ route('penalty.update') }}");
                        var row = $(this).closest('tr');
                        var id = $(this).data('id');
                        editPenalty();

                        $('#penaltyForm input[name="id_penalty"]').val(id);
                        var subjectName = $(row).find('td:nth-child(2)').text();
                        $('#penaltyForm select[name="penalty"] option').filter(function() {
                            return $(this).text() === subjectName;
                        }).prop('selected', true).trigger('change');
                        var durationAndType = $(row).find('td:nth-child(3)').text().split(' ');
                        var duration = durationAndType[0];
                        var type = durationAndType[1];
                        $('#penaltyForm input[name="penalty_duration"]').val(duration).text();
                        $('#penaltyForm select[name="penalty_type"]').val(type).trigger('change');
                        $('#penaltyForm input[name="penalty_start"]').val($(row).find('td:nth-child(4)').text());
                        $('#penaltyForm input[name="penalty_end"]').val($(row).find('td:nth-child(5)').text());
                });

                $(document).on('click', '.deletePenalty-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('penalty.delete', ':replaceThis') }}", reloadPenalty )
                    }
                    })

                });
            },
            error: function(data) {
                //
            }
        });
    }

</script>
