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
    <div class="row">
        <div class="col sm-12 col-md-12 col-lg-12 mb-1">
            <label class="form-label fw-bolder">Tindakan Tatatertib</label>
            <select class="form-select select2" name="penalty" id="penalty" disabled>
                <option value=""></option>
                @foreach($penalties as $penalty)
                <option value="{{ $penalty->code }}">{{ $penalty->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
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
        </div>

    </div>

    <div id="button_action_penalty" style="display:none">
        <button type="button" id="btnAddPenalty" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <a class="me-3" type="button" id="reset" href="#">
                <span class="text-danger"> Set Semula </span>
            </a>
            <button type="button" class="btn btn-success float-right" onclick="$('#btnAddPenalty').trigger('click');">
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
                        <th>Kemaskini</th>
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


        if(penalty_duration != '' && penalty_type != '' && penalty_start != '')
        {
            day = penalty_start.substr(0,2);
            month = penalty_start.substr(3,2);
            year = penalty_start.substr(6,4);

            var date = new Date(year, month, day);

            var dd = date.getDate();
            var mm = date.getMonth();
            var y = date.getFullYear();

            dd = parseInt(dd);
            mm = parseInt(mm);
            y = parseInt(y);
            penalty_duration = parseInt(penalty_duration);

            // if(penalty_type == 'year') {
            //     var dd = date.getDate();
            //     var mm = date.getMonth() + 1;
            //     var y = date.getFullYear() + penalty_duration;
            // } else if(penalty_type == 'month') {
            //     var dd = date.getDate();
            //     var mm = date.getMonth() + 1 + penalty_duration;
            //     var y = date.getFullYear();
            // } else {
            //     var dd = date.getDate() + penalty_duration;
            //     var mm = date.getMonth() + 1;
            //     var y = date.getFullYear();
            // }

            if(penalty_type == 'Tahun') {
                y = y + penalty_duration;
            } else if(penalty_type == 'Bulan') {
                mm = mm += penalty_duration
            } else {
                dd = dd += penalty_duration
            }

            dd = (dd < 10 ? '0' : '') + dd;
            mm = (mm < 10 ? '0' : '') + mm;

            //var date_end = y + '-' + mm + '-' + dd;
            var date_end = dd + '/' + mm + '/' + y;
            var penalty_end = $('#penalty_end').val(date_end);
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
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_penalty").attr("style", "display:none");

                $('#table-penalty tbody').empty();

                var trPenalty = '';
                var bilPenalty = 0;
                $.each(data.detail, function (i, item) {
                    bilPenalty += 1;
                    trPenalty += '<tr>';
                    trPenalty += '<td align="center">' + bilPenalty + '</td>'
                    trPenalty += '<td>' + item.penalty.name + '</td>';
                    trPenalty += '<td>' + item.tempoh + ' ' + item.jenis + '</td>';
                    trPenalty += '<td>' + item.tarikh_mula + '</td>';
                    trPenalty += '<td>' + item.tarikh_tamat + '</td>';
                    trPenalty += '<td align="center"><i class="fas fa-pencil text-primary editPenalty-btn" data-id="' + item.id + ' "></i>';
                    trPenalty += '&nbsp;&nbsp;';
                    trPenalty += '<i class="fas fa-trash text-danger deletePenalty-btn" data-id="' + item.id + '"></i></td>';
                    trPenalty += '</tr>';
                });
                $('#table-penalty tbody').append(trPenalty);

                if($('#table-penalty tbody').is(':empty')){
                    var trPenalty = '<tr><td align="center" colspan="6">*Tiada Rekod*</td></tr>';
                    $('#table-penalty tbody').append(trPenalty);
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
