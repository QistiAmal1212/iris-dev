<div class="row mt-2 mb-2">
    
    <form id="penaltyForm"
    action="{{ route('penalty.store') }}"
    method="POST"
    data-refreshFunctionURL="{{ route('penalty.list') }}"
    data-refreshFunctionDivId="div_table_penalty" data-reloadPage="false">
    @csrf
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
            <input type="date" class="form-control" name="penalty_start" id="penalty_start" disabled onchange="calculatePenalty()">
        </div>

        <div class="col sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label fw-bolder">Tarikh Akhir Hukuman</label>
            <input type="date" class="form-control" name="penalty_end" id="penalty_end" disabled>
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
            <table class="table header_uppercase table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>Bil.</th>
                        <th>Tindakan Tatatertib</th>
                        <th>Tempoh Hukuman</th>
                        <th>Tarikh Mula Hukuman</th>
                        <th>Tarikh Akhir Hukuman</th>
                        <th>Kemaskini Terkini</th>
                    </tr>
                </thead>

                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach($dummyPenalty as $penalty)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $penalty->penalty->name }}</td>
                        <td>{{ $penalty->duration." ".$penalty->type }}</td>
                        <td>{{ $penalty->date_start }}</td>
                        <td>{{ $penalty->date_end }}</td>
                        <td>{{ $penalty->updated_at }}</td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="update_penalty" onclick="editPenalty()">
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
        $('#penaltyForm select[name="penalty"]').attr('required', true);
        $('#penaltyForm input[name="penalty_duration"]').attr('required', true);
        $('#penaltyForm select[name="penalty_type"]').attr('required', true);
        $('#penaltyForm input[name="penalty_start"]').attr('required', true);

        var button_action_penalty = document.getElementById('button_action_penalty').style.display = 'block';
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

            var date_end = y + '-' + mm + '-' + dd;
            var penalty_end = $('#penalty_end').val(date_end);
        }
    }

</script>