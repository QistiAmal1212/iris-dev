<div class="table-responsive" style="width:100%">
    <table class="table header_uppercase table-bordered" id="externalUser">
        <thead>
            <tr>
                <th class="font-weight-bold text-center" width="1%"> NO. </th>
                <th class="font-weight-bold text-center"> NAME </th>
                <th class="font-weight-bold text-center"> USERNAME </th>
                <th class="font-weight-bold text-center"> EMAIL </th>
                <th class="font-weight-bold text-center"> ROLE </th>
                <th class="font-weight-bold text-center"> ACTION </th>
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
                        orderable: true,
                        searchable: true
                    },

                ],
            });

        });
    </script>
@endpush
