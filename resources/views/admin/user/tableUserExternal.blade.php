<div class="row">
    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Nama </label>
        <input type="text" class="form-control">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> No Kad Pengenalan </label>
        <input type="text" class="form-control">
    </div>

    <div class="col-sm-4 col-12 mb-1">
        <label class="form-label"> Peranan </label>
        <select class="select2 form-select" id="carianPeranan" name="roles[]" multiple>
            @foreach ($externalUsers as $externalUser)
                <option value={{$externalUser->id}}>{{$externalUser->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3" type="button" id="reset" href="#">
            <span class="text-danger"> Set Semula </span>
        </a>
        <button type="submit" class="btn btn-success float-right">
            <i class="fa fa-search"></i> Cari
        </button>
    </div>
</div>

<hr>

<div class="table-responsive" style="width:100%">
    <table class="table header_uppercase table-bordered" id="externalUser">
        <thead>
            <tr>
                <th class="text-center fw-bolder" width="1%"> No. </th>
                <th class="text-center fw-bolder"> Nama Pengguna </th>
                <th class="text-center fw-bolder"> No. Kad Pengenalan </th>
                <th class="text-center fw-bolder"> Emel </th>
                <th class="text-center fw-bolder"> Peranan </th>
                <th class="text-center fw-bolder"> Tindakan </th>
            </tr>
        </thead>
    </table>
</div>

@push('js')
    <script>
        $(function() {
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
            });

        });
    </script>
@endpush
