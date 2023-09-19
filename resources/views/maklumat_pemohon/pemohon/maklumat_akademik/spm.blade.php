<div class="row mt-2 mb-2">
    <div class="card" id="update_spm" style="display:none">
        <div class="d-flex justify-content-end align-items-center my-1 ">
            <a class="me-3 text-danger" type="button" onclick="editSpm()">
                <i class="fa-regular fa-pen-to-square"></i>
                Kemaskini
            </a>
        </div>
    </div>
    <form
    id="spmForm"
    action="{{ route('spm.store') }}"
    method="POST"
    data-refreshFunctionName="reloadTimeline"
    data-refreshFunctionNameIfSuccess="reloadSpm"
    data-reloadPage="false">
    @csrf
    <h6>
        <span class="badge badge-light-primary fw-bolder">Sijil Pelajaran Malaysia (SPM)</span>
    </h6>
    <input type="hidden" name="spm_no_pengenalan" id="spm_no_pengenalan" value="">
    <input type="hidden" name="id_spm" id="id_spm" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Mata Pelajaran</label>
        <select class="select2 form-control" value="" id="subjek_spm" name="subjek_spm" disabled>
            <option value=""></option>
            @foreach($subjekSpm as $subjek)
            <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="gred_spm" name="gred_spm" disabled>
            <option value=""></option>
            @foreach($gredSpm as $gred)
            <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" id="tahun_spm" name="tahun_spm" disabled>
    </div>

    <div id="button_action_spm" style="display:none">
        <button type="button" id="btnEditSpm" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditSpm').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>

    </form>

    <div class="table-responsive mb-1 mt-1">
        <table class="table header_uppercase table-bordered table-hovered" id="table-spm">
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


    <hr>

    <div class="card" id="update_spmv" style="display:none">
        <div class="d-flex justify-content-end align-items-center my-1 ">
            <a class="me-3 text-danger" type="button" onclick="editSpmv()">
                <i class="fa-regular fa-pen-to-square"></i>
                Kemaskini
            </a>
        </div>
    </div>
    <form
    id="spmvForm"
    action="{{ route('spmv.store') }}"
    method="POST"
    data-refreshFunctionName="reloadTimeline"
    data-refreshFunctionNameIfSuccess="reloadSpmv"
    data-reloadPage="false">
    @csrf

    <h6>
        <span class="badge badge-light-primary fw-bolder">Sijil Pelajaran Malaysia Vokasinal (SPMV)</span>
    </h6>
    <input type="hidden" name="spmv_no_pengenalan" id="spmv_no_pengenalan" value="">
    <input type="hidden" name="id_spmv" id="id_spmv" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Mata Pelajaran</label>
        <select class="select2 form-control" value="" id="subjek_spmv" name="subjek_spmv" disabled>
            <option value=""></option>
            @foreach($subjekSpmv as $subjek)
            <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="gred_spmv" name="gred_spmv" disabled>
            <option value=""></option>
            @foreach($gredSpmv as $gred)
            <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" id="tahun_spmv" name="tahun_spmv" disabled>
    </div>

    <div id="button_action_spmv" style="display:none">
        <button type="button" id="btnEditSpmv" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditSpmv').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>

    </form>

    <div class="table-responsive mb-1 mt-1">
        <table class="table header_uppercase table-bordered table-hovered" id="table-spmv">
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

    <hr>

    <div class="card" id="update_svm" style="display:none">
        <div class="d-flex justify-content-end align-items-center my-1 ">
            <a class="me-3 text-danger" type="button" onclick="editSvm()">
                <i class="fa-regular fa-pen-to-square"></i>
                Kemaskini
            </a>
        </div>
    </div>
    <form
    id="svmForm"
    action="{{ route('svm.store') }}"
    method="POST"
    data-refreshFunctionName="reloadTimeline"
    data-refreshFunctionNameIfSuccess="reloadSvm"
    data-reloadPage="false">
    @csrf
    <h6>
        <span class="badge badge-light-primary fw-bolder">Sijil Vokasinal Malaysia (SVM)</span>
    </h6>
    <input type="hidden" name="svm_no_pengenalan" id="svm_no_pengenalan" value="">
    <input type="hidden" name="id_svm" id="id_svm" value="">
    <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
        <label class="form-label">Mata Pelajaran</label>
        <select class="select2 form-control" value="" id="subjek_svm" name="subjek_svm" disabled>
            <option value=""></option>
            @foreach($subjekSvm as $subjek)
            <option value="{{ $subjek->code }}">{{ $subjek->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Gred</label>
        <select class="select2 form-control" value="" id="gred_svm" name="gred_svm" disabled>
            <option value=""></option>
            @foreach($gredSvm as $gred)
            <option value="{{ $gred->gred }}">{{ $gred->gred }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="form-label">Tahun</label>
        <input type="text" class="form-control" value="" id="tahun_svm" name="tahun_svm" disabled>
    </div>

    <div id="button_action_svm" style="display:none">
        <button type="button" id="btnEditSvm" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditSvm').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>

    </form>

    <div class="table-responsive mb-1 mt-1">
        <table class="table header_uppercase table-bordered table-hovered" id="table-svm">
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
</div>

<script>
    function editSpm() {
        $('#spmForm select[name="subjek_spm"]').attr('disabled', false);
        $('#spmForm select[name="gred_spm"]').attr('disabled', false);
        $('#spmForm input[name="tahun_spm"]').attr('disabled', false);

        $("#button_action_spm").attr("style", "display:block");
    }
    function reloadSpm() {
        var no_pengenalan = $('#spm_no_pengenalan').val();
        $('#spmForm input[name="spm_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmUrl = "{{ route('spm.list', ':replaceThis') }}"
        reloadSpmUrl = reloadSpmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#spmForm select[name="subjek_spm"]').val('').trigger('change');
                $('#spmForm select[name="gred_spm"]').val('').trigger('change');
                $('#spmForm input[name="tahun_spm"]').val('');
                $('#spmForm select[name="subjek_spm"]').attr('disabled', true);
                $('#spmForm select[name="gred_spm"]').attr('disabled', true);
                $('#spmForm input[name="tahun_spm"]').attr('disabled', true);

                $("#button_action_spm").attr("style", "display:none");


                $('#table-spm tbody').empty();
                var trSpm = '';
                var bilSpm = 0;
                $.each(data.detail, function(i, item) {
                    console.log(data.detail)
                    if (item.subject != null) {
                        bilSpm += 1;
                        trSpm += '<tr>';
                        trSpm += '<td align="center">' + bilSpm + '</td>';
                        trSpm += '<td>' + item.subject.name + '</td>';
                        trSpm += '<td align="center">' + item.grade + '</td>';
                        trSpm += '<td align="center">' + item.year + '</td>';
                        trSpm += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                        trSpm += '&nbsp;&nbsp;';
                        trSpm += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                        trSpm += '</tr>';
                    }
                });
                $('#table-spm tbody').append(trSpm);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#spmForm').attr('action', "{{ route('spm.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#spmForm input[name="id_spm"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#spmForm select[name="subjek_spm"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#spmForm select[name="gred_spm"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#spmForm input[name="tahun_spm"]').val($(row).find('td:nth-child(4)').text());
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
                        spmDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function spmDelete(id){
        var reloadSpmUrl = "{{ route('spm.delete', ':replaceThis') }}"
        reloadSpmUrl = reloadSpmUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadSpmUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reloadSpm();
            }
        });

    }

    function editSpmv() {
        $('#spmvForm select[name="subjek_spmv"]').attr('disabled', false);
        $('#spmvForm select[name="gred_spmv"]').attr('disabled', false);
        $('#spmvForm input[name="tahun_spmv"]').attr('disabled', false);

        $("#button_action_spmv").attr("style", "display:block");
    }
    function reloadSpmv() {
        var no_pengenalan = $('#spmv_no_pengenalan').val();
        $('#spmvForm input[name="spmv_no_pengenalan"]').val(no_pengenalan);

        var reloadSpmvUrl = "{{ route('spmv.list', ':replaceThis') }}"
        reloadSpmvUrl = reloadSpmvUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSpmvUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                console.log(data)
                $('#spmvForm select[name="subjek_spmv"]').val('').trigger('change');
                $('#spmvForm select[name="gred_spmv"]').val('').trigger('change');
                $('#spmvForm input[name="tahun_spmv"]').val('');
                $('#spmvForm select[name="subjek_spmv"]').attr('disabled', true);
                $('#spmvForm select[name="gred_spmv"]').attr('disabled', true);
                $('#spmvForm input[name="tahun_spmv"]').attr('disabled', true);

                $("#button_action_spmv").attr("style", "display:none");


                $('#table-spmv tbody').empty();
                var trSpmv = '';
                var bilSpmv = 0;
                $.each(data.detail, function(i, item) {
                    console.log(data.detail)
                    if (item.subject != null) {
                        bilSpmv += 1;
                        trSpmv += '<tr>';
                        trSpmv += '<td align="center">' + bilSpmv + '</td>';
                        trSpmv += '<td>' + item.subject.name + '</td>';
                        trSpmv += '<td align="center">' + item.grade + '</td>';
                        trSpmv += '<td align="center">' + item.year + '</td>';
                        trSpmv += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                        trSpmv += '&nbsp;&nbsp;';
                        trSpmv += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                        trSpmv += '</tr>';
                    }
                });
                $('#table-spmv tbody').append(trSpmv);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#spmvForm').attr('action', "{{ route('spmv.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#spmvForm input[name="id_spmv"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#spmvForm select[name="subjek_spmv"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#spmvForm select[name="gred_spmv"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#spmvForm input[name="tahun_spmv"]').val($(row).find('td:nth-child(4)').text());
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
                        spmvDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function spmvDelete(id){
        var reloadSpmvUrl = "{{ route('spmv.delete', ':replaceThis') }}"
        reloadSpmvUrl = reloadSpmvUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadSpmvUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reloadSpmv();
            }
        });
    }

    function editSvm() {
        $('#svmForm select[name="subjek_svm"]').attr('disabled', false);
        $('#svmForm select[name="gred_svm"]').attr('disabled', false);
        $('#svmForm input[name="tahun_svm"]').attr('disabled', false);

        $("#button_action_svm").attr("style", "display:block");
    }

    function reloadSvm() {
        var no_pengenalan = $('#svm_no_pengenalan').val();
        $('#svmForm input[name="svm_no_pengenalan"]').val(no_pengenalan);

        var reloadSvmUrl = "{{ route('svm.list', ':replaceThis') }}"
        reloadSvmUrl = reloadSvmUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadSvmUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                console.log(data)
                $('#svmForm select[name="subjek_svm"]').val('').trigger('change');
                $('#svmForm select[name="gred_svm"]').val('').trigger('change');
                $('#svmForm input[name="tahun_svm"]').val('');
                $('#svmForm select[name="subjek_svm"]').attr('disabled', true);
                $('#svmForm select[name="gred_svm"]').attr('disabled', true);
                $('#svmForm input[name="tahun_svm"]').attr('disabled', true);

                $("#button_action_svm").attr("style", "display:none");


                $('#table-svm tbody').empty();
                var trSvm = '';
                var bilSvm = 0;
                $.each(data.detail, function(i, item) {
                    console.log(data.detail)
                    if (item.subject != null) {
                        bilSvm += 1;
                        trSvm += '<tr>';
                        trSvm += '<td align="center">' + bilSvm + '</td>';
                        trSvm += '<td>' + item.subject.name + '</td>';
                        trSvm += '<td align="center">' + item.grade + '</td>';
                        trSvm += '<td align="center">' + item.year + '</td>';
                        trSvm += '<td align="center"><i class="fas fa-pencil text-primary edit-btn" data-id="' + item.id + ' "></i>';
                        trSvm += '&nbsp;&nbsp;';
                        trSvm += '<i class="fas fa-trash text-danger delete-btn" data-id="' + item.id + '"></i></td>';
                        trSvm += '</tr>';
                    }
                });
                $('#table-svm tbody').append(trSvm);

                $(document).on('click', '.edit-btn', function() {
                $('.btn.btn-success.float-right').html('<i class="fa fa-save"></i> Simpan');
                    $('#svmForm').attr('action', "{{ route('svm.update') }}");
                    var row = $(this).closest('tr');
                    var id = $(this).data('id');

                    $('#svmForm input[name="id_svm"]').val(id);
                    var subjectName = $(row).find('td:nth-child(2)').text();
                    $('#svmForm select[name="subjek_svm"] option').filter(function() {
                        return $(this).text() === subjectName;
                    }).prop('selected', true).trigger('change');
                    $('#svmForm select[name="gred_svm"]').val($(row).find('td:nth-child(3)').text()).trigger('change');
                    $('#svmForm input[name="tahun_svm"]').val($(row).find('td:nth-child(4)').text());
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
                        svmDelete(id);
                    }
                    })

                });
            },
            error: function(data) {
            }
        });
    }

    function svmDelete(id){
        var reloadSvmUrl = "{{ route('svm.delete', ':replaceThis') }}"
        reloadSvmUrl = reloadSvmUrl.replace(':replaceThis', id);
        $.ajax({
            url: reloadSvmUrl,
            type: 'POST',
            async: true,
            success: function(data){
                reloadSvm();
            }
        });

    }
</script>
