<style>
  .hidden-td {
    position: absolute;
    left: -9999px;
  }
</style>
<div class="card" id="update_pmr" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" onclick="editPmr()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form
id="pmrForm"
action="{{ route('pmr.store') }}"
method="POST"
data-refreshFunctionName="reloadTimeline"
data-refreshFunctionNameIfSuccess="reloadPmr"
data-reloadPage="false">
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
        <!-- <select class="select2 form-control" value="" id="mpel_kod_pmr" name="mpel_kod_pmr" disabled onchange="changeMP('mpel_kod_pmr')">
            <option value=""></option>
            @foreach($subjekPmr as $subjek)
            <option value="{{ $subjek->diskripsi }}">{{ $subjek->kod }}</option>
            @endforeach
        </select> -->
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

    <div id="button_action_pmr" style="display:none">
        <button type="button" id="btnEditPmr" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-danger float-right" onclick="reloadPmr()">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success float-right" id="btnSavePmr" onclick="$('#btnEditPmr').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</div>
<input type="hidden" name="tukar_log_pmr"  id="tukar_log_pmr">
</form>
<input type="hidden" name="editbutton_pmr" value=0 id="editbutton_pmr">

<textarea id="currentvalues_pmr" style="display:none;"></textarea>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-pmr">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>MP Kod</th>
                <th>Mata Pelajaran</th>
                <th>Gred</th>
                <th>Kemaskini</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    
    function changeMP(event) {
        var value = $('#'+event).val();
        var text = $('#'+event).text();
        if (value == '') {
            return ;
        }
        $('#mpel_kod_pmr').val(value)
        // if ($('#subjek_pmr').val() != $('#mpel_kod_pmr').text()) {
        //     if (event == 'subjek_pmr') {
        //         $('#pmrForm select[name="mpel_kod_pmr"] option').filter(function() {
        //             return $(this).val() === value;
        //         }).prop('selected', true);
        //     } else {
        //         console.log('okok')
        //         $('#pmrForm select[name="subjek_pmr"] option').filter(function() {
        //           return $(this).text() == value;
        //         }).prop('selected', true);
        //     }
        // } else {
        //     return ;
        // }
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
                mpel_kod_pmr: $('#mpel_kod_pmr').val(),
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
   
        // if (checkValue.mpel_kod_pmr != $('#mpel_kod_pmr').val()) {
        //     datachanged = true;
        // }
    
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
                console.log(data.detail)
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

                        // $('#pmrForm select[name="mpel_kod_pmr"] option').filter(function() {
                        //     return $(this).text() === mpelkod;
                        // }).prop('selected', true).trigger('change');
                        // mpel_kod_pmr

                        $('#pmrForm select[name="gred_pmr"]').val($(row).find('td:nth-child(4)').text()).trigger('change');
                        $('#pmrForm input[name="tahun_pmr"]').val($(row).find('td:nth-child(5)').text());
                        $('#pmrForm input[name="mpel_kod_pmr"]').val($(row).find('td:nth-child(2)').text());
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
