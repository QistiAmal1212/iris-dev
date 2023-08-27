<div class="modal fade text-start" id="viewUsersModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Kemaskini Kumpulan Pengguna</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <center>
                    <table width="100%">
                        <tr>
                            <td width="30%">Nama Peranan</td>
                            <td id="td_name"></td>
                        </tr>
                        <tr>
                            <td>Nama Paparan</td>
                            <td id="td_display_name"></td>
                        </tr>
                        <tr>
                            <td>Penerangan</td>
                            <td id="td_description"></td>
                        </tr>
                        <tr>
                            <td>Jenis Peranan</td>
                            <td id="td_is_internal"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Bilangan Pengguna</td>
                            <td id="td_count"></td>
                        </tr>
                    </table>
                    </center>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered" id="table-list-users">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" onclick="closeModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>