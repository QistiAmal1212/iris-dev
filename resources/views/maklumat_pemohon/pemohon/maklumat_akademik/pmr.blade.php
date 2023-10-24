<style>
  .hidden-td {
    position: absolute;
    left: -9999px;
  }
</style>
<div class="accordion" id="accordion_pmr">
    {{-- PT3/ PMR/ SRP --}}
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading_pmr_info">
            <button class="accordion-button fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#pmr_info" aria-expanded="true" aria-controls="pmr_info">
                PT3/ PMR/ SRP
            </button>
        </h2>
        <div id="pmr_info" class="accordion-collapse collapse show" aria-labelledby="heading_pmr_info" data-bs-parent="#accordion_pmr">
            <div class="accordion-body">
                <div id="update_pmr" style="display:none">
                    <div class="d-flex justify-content-end align-items-center mb-1">
                        <a class="me-3 text-danger" type="button" onclick="editPmr()">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Kemaskini
                        </a>
                    </div>
                </div>

                <form id="pmrForm" action="{{ route('pmr.store') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadPmr" data-reloadPage="false">
                    @csrf
                    <div class="row mt-2 mb-2">
                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_pmr" name="tahun_pmr" disabled>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <input type="hidden" name="pmr_no_pengenalan" id="pmr_no_pengenalan" value="">
                        <input type="hidden" name="id_pmr" id="id_pmr" value="">

                        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
                            <label class="form-label">Mata Pelajaran</label>
                            <select class="select2 form-control" value="" id="subjek_pmr" name="subjek_pmr" disabled onchange="changeMP('subjek_pmr')">
                                <option value=""></option>
                                @foreach($subjekPmr as $subjek)
                                <option value="{{ $subjek->kod }}">{{ $subjek->diskripsi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Mp Kod</label>
                            <input type="text" class="form-control" value="" id="mpel_kod_pmr" name="mpel_kod_pmr" disabled>
                        </div> 

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Gred</label>
                            <select class="select2 form-control" value="" id="gred_pmr" name="gred_pmr" disabled>
                                <option value=""></option>
                                @foreach($gredPmr as $gred)
                                <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                            <label class="form-label">Tahun</label>
                            <input type="text" class="form-control" value="" id="tahun_pmr" name="tahun_pmr" disabled>
                        </div>

                        <div id="button_action_pmr" style="display:none">
                            <button type="button" id="btnEditPmr" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-danger float-right" onclick="reloadPmr()">
                                    <i class="fa fa-refresh"></i>
                                </button>&nbsp;&nbsp;
                                <!-- <button type="button" class="btn btn-success float-right" id="btnSavePmr" onclick="$('#btnEditPmr').trigger('click');">
                                    <i class="fa fa-save"></i> Tambah
                                </button> -->
                                <button type="button" class="btn btn-success float-right" id="btnSavePmr" onclick="confirmSubmit2('btnEditPmr', {
                                    subjek_pmr: $('#subjek_pmr').find(':selected').text(),
                                    gred_pmr: $('#gred_pmr').find(':selected').text(),
                                    tahun_pmr: $('#tahun_pmr').val()
                                },{
                                    subjek_pmr: 'Matapelajaran',
                                    gred_pmr: 'Gred',
                                    tahun_pmr: 'Tahun'
                                }
                            );">
                                <i class="fa fa-save"></i> Tambah
                            </button>
                            </div>
                        </div>
                    </div>
                <input type="hidden" name="tukar_log_pmr"  id="tukar_log_pmr">
                </form>
                <input type="hidden" name="editbutton_pmr" value=0 id="editbutton_pmr">

                <textarea id="currentvalues_pmr" style="display:none;"></textarea>

                <div class="table-responsive mt-1 mb-1">
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
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- PT3/ PMR/ SRP HISTORY --}}
    <div class="accordion-item">
       <!--  <h2 class="accordion-header" id="heading_history_pmr">
            <button class="accordion-button collapsed fw-bolder text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#history_pmr" aria-expanded="false" aria-controls="history_pmr">
                Jejak Audit [PT3/ PMR/ SRP]
            </button>
        </h2> -->
        <div id="history_pmr" class="accordion-collapse collapse" aria-labelledby="heading_history_pmr" data-bs-parent="#accordion_pmr">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Mula</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">Tarikh Akhir</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <a class="me-3" type="button" id="reset" href="#">
                            <span class="text-danger"> Set Semula </span>
                        </a>
                        <button type="submit" class="btn btn-success float-right">
                            <i class="fa fa-search"></i> Cari
                        </button>
                    </div>
                </div>

                <div class="table-responsive mb-1 mt-1">
                    <table class="table header_uppercase table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kod</th>
                                <th>Mata Pelajaran</th>
                                <th>Gred</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Tarikh</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    function changeMP(event) {
        var value = $('#'+event).val();
        var text = $('#'+event).text();
        if (value == '') {
            return ;
        }
        $('#mpel_kod_pmr').val(value)
    }
    function confirmSubmit2(btnName, newValues, columnHead) {
        var originalVal = JSON.parse($('#currentvalues_pmr').val());

        var htmlContent = '<p>Perubahan:</p>';
        for (var key in originalVal) {
            if (originalVal.hasOwnProperty(key)) {
                if (newValues.hasOwnProperty(key) && newValues[key] !== originalVal[key]) {
                    if (originalVal[key] == null || originalVal[key] === '') {
                        if (newValues[key] !== 'Tiada Maklumat') {
                            if(newValues[key] !== null){
                                htmlContent += '<p>' + columnHead[key] + ':<br>';
                                htmlContent += 'Tiada Maklumat kepada ' + newValues[key] + '</p>';
                            }
                        }
                    } else {
                        htmlContent += '<p>' + columnHead[key] + ':<br>';
                        htmlContent += originalVal[key] + ' kepada ' + newValues[key] + '</p>';
                    }
                }
            }
        }
         if (htmlContent === '<p>Perubahan:</p>') {
            Swal.fire({
                title: 'Tiada Perubahan Dibuat',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        } else {
            $('#tukar_log_pmr').val(htmlContent);
            $('#btnEditPmr').trigger('click')
        }
        $('#editbutton_pmr').val(0);
        reloadPmr();
        disbalefieldspmr();
    }
    function editPmr() {
        $('#pmrForm select[name="subjek_pmr"]').attr('disabled', false);
        $('#pmrForm select[name="gred_pmr"]').attr('disabled', false);
        $('#pmrForm input[name="tahun_pmr"]').attr('disabled', false);
        // $('#pmrForm input[name="mpel_kod_pmr"]').attr('disabled', false);

        $("#button_action_pmr").attr("style", "display:block");

        var editbuttoncount = $('#editbutton_pmr').val();
    
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_pmr').val(1)
            var check_data = {
                subjek_pmr: $('#subjek_pmr').find(':selected').text(),
                gred_pmr: $('#gred_pmr').find(':selected').text(),
                tahun_pmr: $('#tahun_pmr').val()
            };
            $('#currentvalues_pmr').val(JSON.stringify(check_data));
        } else {
            checkkemaskinipmr();
        }
    }
        function checkkemaskinipmr() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_pmr').val());
   
        if (checkValue.subjek_pmr != $('#subjek_pmr').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.gred_pmr != $('#gred_pmr').find(':selected').text()) {
            datachanged = true;
        }

        if (checkValue.tahun_pmr != $('#tahun_pmr').val()) {
            datachanged = true;
        }
        
        if (!datachanged) {
            $('#editbutton_pmr').val(0);
            disbalefieldspmr();
        }
    }
    function disbalefieldspmr() {
        $('#pmrForm select[name="subjek_pmr"]').attr('disabled', true);
        $('#pmrForm select[name="gred_pmr"]').attr('disabled', true);
        $('#pmrForm input[name="tahun_pmr"]').attr('disabled', true);
        $('#pmrForm input[name="mpel_kod_pmr"]').attr('disabled', true);
        $("#button_action_pmr").attr("style", "display:none");

    }
    function reloadPmr() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();
        $('#pmrForm input[name="pmr_no_pengenalan"]').val(no_pengenalan);

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
                $('#pmrForm input[name="mpel_kod_pmr"]').val('');
                $('#pmrForm select[name="subjek_pmr"]').attr('disabled', true);
                $('#pmrForm input[name="mpel_kod_pmr"]').attr('disabled', true);
                $('#pmrForm select[name="gred_pmr"]').attr('disabled', true);
                $('#pmrForm input[name="tahun_pmr"]').attr('disabled', true);
                $('#pmrForm').attr('action', "{{ route('pmr.store')  }}");
                $('#btnSavePmr').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_pmr").attr("style", "display:none");

                $('#table-pmr tbody').empty();
                var trPmr = '';
                var bilPmr = 0;
                $.each(data.detail, function(j, item2) {
                        trPmr += '<tr>';
                        trPmr += '<td align="left" colspan="5"><b> Tahun : ' + j + '</b></td>';
                        trPmr += '</tr>';
                    $.each(item2, function(i, item) {
                        if (item.subject_form3 != null) {
                            bilPmr += 1;
                            trPmr += '<tr>';
                            trPmr += '<td align="center">' + bilPmr + '</td>';
                            trPmr += '<td align="center">' + item.mpel_kod + '</td>';
                            trPmr += '<td>' + item.subject_form3.diskripsi + '</td>';
                            trPmr += '<td align="center">' + item.gred + '</td>';
                            trPmr += '<td align="center" style="display:none;">' + item.tahun + '</td>';
                            trPmr += '<td align="center"><a><i class="fas fa-pencil text-primary editPmr-btn" data-id="' + item.id + ' "></i></a>';
                            trPmr += '&nbsp;&nbsp;';
                            trPmr += '<a><i class="fas fa-trash text-danger deletePmr-btn" data-id="' + item.id + '" ></i></a></td>';
                            trPmr += '</tr>';
                        }
                    });
                });
                $('#table-pmr tbody').append(trPmr);

                if($('#table-pmr tbody').is(':empty')){
                    var trPmr = '<tr><td align="center" colspan="5">*Tiada Rekod*</td></tr>';
                    $('#table-pmr tbody').append(trPmr);

                    var tmPmrElement = $("#tm_pmr");
                    tmPmrElement.removeAttr("hidden");
                }else{
                    var tmPmrElement = $("#tm_pmr");
                    tmPmrElement.attr("hidden", true);
                }

                $(document).on('click', '.editPmr-btn', function() {
                        $('#editbutton_pmr').val(0);
                        $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                        $('#pmrForm').attr('action', "{{ route('pmr.update') }}");
                        var row = $(this).closest('tr');
                        var id = $(this).data('id');
                        $('#pmrForm input[name="id_pmr"]').val(id);
                        var subjectName = $(row).find('td:nth-child(3)').text();
                        var mpelkod = $(row).find('td:nth-child(2)').text();
                        $('#pmrForm select[name="subjek_pmr"] option').filter(function() {
                            return $(this).text() === subjectName;
                        }).prop('selected', true).trigger('change');

                        $('#pmrForm select[name="gred_pmr"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                        $('#pmrForm input[name="tahun_pmr"]').val($(row).find('td:nth-child(5)').text());
                        $('#pmrForm input[name="mpel_kod_pmr"]').val($(row).find('td:nth-child(2)').text());
                        editPmr();
                });

                $(document).on('click', '.deletePmr-btn', function() {
                    var id = $(this).data('id');
                    Swal.fire({
                    title: 'Adakah anda ingin hapuskan maklumat ini?',
                    showCancelButton: true,
                    confirmButtonText: 'Sahkan',
                    cancelButtonText: 'Batal',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        deleteItem(id, "{{ route('pmr.delete', ':replaceThis') }}", reloadPmr )
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }
</script>
