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
        <label class="form-label"></label>
        <select class="select2 form-control" value="" id="nama_skm" name="nama_skm" disabled>
            <option value=""></option>
            @foreach($skmkod as $skm)
            <option value="{{ $skm->kod }}">{{ $skm->diskripsi }}</option>
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
          <!--   <button type="button" class="btntahun_skm btn-success float-right" id="btnSaveSkm" onclick="$('#btnEditSkm').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button> -->
             <button type="button" class="btn btn-success float-right" id="btnSaveSkm" onclick="confirmSubmitskm('btnEditSkm', {
                nama_skm: $('#nama_skm').find(':selected').text(),
                tahun_skm: $('#tahun_skm').val()
            },{
                subjek_pmr: 'Nama Sijil',
                tahun_pmr: 'Tahun'
            }
        );">
            <i class="fa fa-save"></i> Tambah
        </button>
        </div>
    </div>
<input type="hidden" name="tukar_log_skm"  id="tukar_log_skm">
</form>
<input type="hidden" name="editbutton_skm" value=0 id="editbutton_skm">

<textarea id="currentvalues_skm" style="display:none;"></textarea>
</div>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="table-skm">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Nama Sijil</th>
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
        var editbuttoncount = $('#editbutton_skm').val();
    
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton_skm').val(1)
            var check_data = {
                nama_skm: $('#nama_skm').find(':selected').text(),
                tahun_skm: $('#tahun_skm').val()
            };
            $('#currentvalues_skm').val(JSON.stringify(check_data));
        } else {
            checkkemaskiniskm();
        }
    }
    function checkkemaskiniskm() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues_skm').val());
   
        if (checkValue.nama_skm != $('#nama_skm').find(':selected').text()) {
            datachanged = true;
        }

        if (checkValue.tahun_skm != $('#tahun_skm').val()) {
            datachanged = true;
        }
        
        if (!datachanged) {
            $('#editbutton_skm').val(0);
            disbalefieldsskm();
        }
    }
    function disbalefieldsskm() {
        $('#skmForm select[name="nama_skm"]').attr('disabled', true);
        $('#skmForm input[name="tahun_skm"]').attr('disabled', true);

        $("#button_action_skm").attr("style", "display:none");
    }
    function confirmSubmitskm(btnName, newValues, columnHead) {
        var originalVal = JSON.parse($('#currentvalues_skm').val());

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
            $('#tukar_log_skm').val(htmlContent);
            $('#btnEditSkm').trigger('click')
        }
        $('#editbutton_skm').val(0);
        reloadSkm();
        disbalefieldsskm();
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
                $('#btnSaveSkm').html('<i class="fa fa-save"></i> Tambah');

                $("#button_action_skm").attr("style", "display:none");

                $('#table-skm tbody').empty();
                var trSkm = '';
                var bilSkm = 0;
                $.each(data.detail, function(i, item) {
                    if (item.qualification != null) {
                        bilSkm += 1;
                        trSkm += '<tr>';
                        trSkm += '<td align="center">' + bilSkm + '</td>';
                        trSkm += '<td>' + (item.qualification ? item.qualification.diskripsi : "Tiada Maklumat")  + '</td>';
                        trSkm += '<td align="center">' + item.tahun_lulus + '</td>';
                        trSkm += '<td align="center"><a><i class="fas fa-pencil text-primary editSkm-btn" data-id="' + item.id + ' " data-form="skm"></a></i>';
                        trSkm += '&nbsp;&nbsp;';
                        trSkm += '<a><i class="fas fa-trash text-danger deleteSkm-btn" data-id="' + item.id + '"></i></a></td>';
                        trSkm += '</tr>';
                    }
                });
                $('#table-skm tbody').append(trSkm);

                if($('#table-skm tbody').is(':empty')){
                    var trSkm = '<tr><td align="center" colspan="4">*Tiada Rekod*</td></tr>';
                    $('#table-skm tbody').append(trSkm);

                    var tmSkmElement = $("#tm_skm");
                    tmSkmElement.removeAttr("hidden");
                }else{
                    var tmSkmElement = $("#tm_skm");
                    tmSkmElement.attr("hidden", true);
                }

                $(document).on('click', '.editSkm-btn', function() {
                    $('#editbutton_skm').val(0);
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
                    editSkm();
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
