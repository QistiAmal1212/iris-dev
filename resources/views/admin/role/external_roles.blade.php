<div class="modal fade" id="external_list" tabindex="-1" aria-labelledby="external_list" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Senarai Peranan [Luaran]</h5>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered table-hovered text-center" id="database_table">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> ID Peranan </th>
                                <th> Nama Peranan </th>
                                <th> Penerangan </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($externalRoles as $key => $externalRole)
                                <tr>
                                    <td> {{ $key++ }} </td>
                                    <td> {{ $externalRole->id }} </td>
                                    <td> {{ $externalRole->name }} </td>
                                    <td> {{ $externalRole->description }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
