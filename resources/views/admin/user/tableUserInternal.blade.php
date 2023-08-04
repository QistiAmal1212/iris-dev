<div class="table-responsive" style="width:100%">
    <table class="table header_uppercase table-bordered" id="internalUser">
        <thead>
            <tr>
                <th class="font-weight-bold text-center" width="1%"> ID </th>
                <th class="font-weight-bold text-center"> NAME </th>
                <th class="font-weight-bold text-center"> EMAIL </th>
                <th class="font-weight-bold text-center"> ACTION </th>
            </tr>
        </thead>
    </table>
</div>

@push('js')
    <script>
        $(function() {
            var table = $('#internalUser').DataTable({
                orderCellsTop: true,
                colReorder: false,
                pageLength: 10,
                processing: true,
                serverSide: false, //enable if data is large (more than 50,000)
                ajax: {
                    url: "{{ fullUrl() }}",
                    cache: false,
                },
                columns: [{
                        data: "id",
                        name: "id",
                        render: function(data, type, row) {
                            return $("<div/>").html(data).text();
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
                        data: "email",
                        name: "email",
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
