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
            <input type="text" class="form-control flatpickr" name="penalty_end" id="penalty_end" disabled>
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
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="update_penalty" hidden onclick="editPenalty()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
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
        //document.getElementById('button_action_penalty').style.display = 'block';
    }

    function calculatePenalty() {
        var penalty_duration = $('#penalty_duration').val();
        var penalty_type = $('#penalty_type').val();
        var penalty_start = $('#penalty_start').val();
        

        if(penalty_duration != '' && penalty_type != '' && penalty_start != '')
        {
            var date = new Date(penalty_start);

            var dd = date.getDate();
            var mm = date.getMonth() + 1;
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
        var no_pengenalan = $('#candidate_no_pengenalan').val();

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

                $('#table-penalty tbody').empty();
                    var trPenalty = '';
                    var bilPenalty = 0;
                    $.each(data.detail, function (i, item) {
                        bilPenalty += 1;
                        trPenalty += '<tr>';
                        trPenalty += '<td align="center">' + bilPenalty + '</td>'
                        trPenalty += '<td>' + item.penalty.name + '</td>';
                        trPenalty += '<td>' + item.duration + ' ' + item.type + '</td>';
                        trPenalty += '<td>' + item.date_start + '</td>';
                        trPenalty += '<td>' + item.date_end + '</td>';
                        trPenalty += '</tr>';
                    });
                    $('#table-penalty tbody').append(trPenalty);
            },
            error: function(data) {
                //
            }
        });
    }

</script>