
<form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
<div class="row">
    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Nama </label>
        <input type="text" class="form-control" name="name">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> No Kad Pengenalan </label>
        <input type="text" class="form-control" maxlength="12" name="no_ic">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Peranan </label>
        <select class="select2 form-control" id="role" name="role">
            <option value=""></option>
            @foreach ($externalUsers as $externalUser)
                <option value="{{ $externalUser->id }}">{{ $externalUser->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-12 mb-1">
        <label class="form-label"> Kementerian </label>
        <select class="select2 form-control" id="department_ministry" name="department_ministry" >
            <option value=""></option>
            @foreach($departmentMinistry as $department)
            <option value="{{ $department->kod }}">{{ $department->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-12 mb-1">
        <label class="form-label"> Jawatan </label>
        <select class="select2 form-control" id="skim" name="skim" >
            <option value=""></option>
            @foreach($skim as $scheme)
            <option value="{{ $scheme->kod }}">{{ $scheme->diskripsi }}</option>
            @endforeach
        </select>
    </div>

    <input type="text" name="is_active" id="is_active" hidden>
    <input type="text" name="is_blocked" id="is_blocked" hidden>

    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3" type="reset" id="reset" onclick="resetFilterForm()">
            <span class="text-danger"> Set Semula </span>
        </a>
        <button type="submit" class="btn btn-success float-right">
            <i class="fa fa-search"></i> Cari
        </button>
    </div>
</div>
</form>

<hr>

<div class="table-responsive" style="width:100%">
    <table class="table header_uppercase table-bordered" id="externalUser">
        <thead>
            <tr>
                <th class="text-center fw-bolder" width="1%"> No. </th>
                <th class="text-center fw-bolder"> Nama Pengguna </th>
                <th class="text-center fw-bolder"> No. Kad Pengenalan </th>
                <th class="text-center fw-bolder"> Emel </th>
                <th class="text-center fw-bolder"> Kementerian </th>
                <th class="text-center fw-bolder"> Jawatan </th>
                <th class="text-center fw-bolder"> Peranan </th>
                <th class="text-center fw-bolder"> Status </th>
                <th class="text-center fw-bolder"> Tindakan </th>
            </tr>
        </thead>
    </table>
</div>

@push('js')
<script>
    var table = $('#externalUser').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 10,
        processing: true,
        serverSide: true, //enable if data is large (more than 50,000)
        ajax: {
            url: "{{ fullUrl() }}",
            cache: false,
        },
        columns: [{
                defaultContent: '',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "name",
                name: "name",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "username",
                name: "username",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "email",
                name: "email",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "department_ministry",
                name: "department_ministry",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "skim",
                name: "skim",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "role",
                name: "role",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "status",
                name: "status",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        language : {
            emptyTable : "Tiada data tersedia",
            info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
            infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
            infoFiltered : "(Ditapis dari _MAX_ entri)",
            search : "Cari:",
            zeroRecords : "Tiada rekod yang ditemui",
            paginate : {
                first : "Pertama",
                last : "Terakhir",
                next : "Seterusnya",
                previous : "Sebelumnya"
            },
            lengthMenu : "Lihat _MENU_ entri",
        }
    });

    $('body').on('submit','#form-search',function(e){

        e.preventDefault();

        var form = $("#form-search");

        if(!form.valid()){
            return false;
        }
        var table;

        table = $('#externalUser').DataTable().destroy();

        table = $('#externalUser').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 10,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            deferRender: true,
            ajax: form.attr('action')+"?"+form.serialize(),
            columns: [{
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "name",
                    name: "name",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "username",
                    name: "username",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "email",
                    name: "email",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "department_ministry",
                    name: "department_ministry",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "skim",
                    name: "skim",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "role",
                    name: "role",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "status",
                    name: "status",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            language : {
                emptyTable : "Tiada data tersedia",
                info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
                infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
                infoFiltered : "(Ditapis dari _MAX_ entri)",
                search : "Cari:",
                zeroRecords : "Tiada rekod yang ditemui",
                paginate : {
                    first : "Pertama",
                    last : "Terakhir",
                    next : "Seterusnya",
                    previous : "Sebelumnya"
                },
                lengthMenu : "Lihat _MENU_ entri",
            }
        });
    });

    function resetFilterForm() {
        $('#form-search')[0].reset();
        $("#form-search").trigger("reset");
        $('#form-search select').val("").trigger("change");
    }

    function deleteExternalUser(userId){
        var url = "{{ route('user.delete', ':replaceThis') }}"
        url = url.replace(':replaceThis', userId);

        Swal.fire({
            title: 'Adakah anda ingin hapuskan pengguna ini?',
            showCancelButton: true,
            confirmButtonText: 'Sahkan',
            cancelButtonText: 'Batal',
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    async: true,
                    success: function(data){
                        table.draw();
                    },
                    failed:function(data){
                        console.log('data')
                    },
                })
            }
        })
    }

</script>
@endpush
