<form id="form-search" role="form" autocomplete="off" method="post" action="" novalidate>
<div class="row">
    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Nama </label>
        <input type="text" class="form-control" name="name">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> No Kad Pengenalan </label>
        <input type="text" class="form-control" name="no_ic">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Peranan </label>
        <select class="select2 form-select" id="role" name="role">
            <option value=""></option>
            @foreach ($internalUsers as $internalUser)
            <option value={{ $internalUser->id }}>{{ $internalUser->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-12 mb-1">
        <label class="form-label"> Kementerian </label>
        <select class="select2 form-select" id="department_ministry" name="department_ministry" >
            <option value=""></option>
            @foreach($departmentMinistry as $department)
            <option value="{{ $department->code }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-6 col-12 mb-1">
        <label class="form-label"> Jawatan </label>
        <select class="select2 form-select" id="skim" name="skim" >
            <option value=""></option>
            @foreach($skim as $scheme)
            <option value="{{ $scheme->code }}">{{ $scheme->name }}</option>
            @endforeach
        </select>
    </div>

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
    <table class="table header_uppercase table-bordered" id="internalUser">
        <thead>
            <tr>
                <th class="text-center fw-bolder" width="1%"> No. </th>
                <th class="text-center fw-bolder"> Nama Pengguna </th>
                <th class="text-center fw-bolder"> No. Kad Pengenalan </th>
                <th class="text-center fw-bolder"> Emel </th>
                <th class="text-center fw-bolder"> Kementerian </th>
                <th class="text-center fw-bolder"> Jawatan </th>
                <th class="text-center fw-bolder"> Peranan </th>
                <th class="text-center fw-bolder"> Tindakan </th>
            </tr>
        </thead>
    </table>
</div>

@push('js')
    <script>
        var table = $('#internalUser').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 20,
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

            table = $('#internalUser').DataTable().destroy();

            table = $('#internalUser').DataTable({
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

    </script>
@endpush
