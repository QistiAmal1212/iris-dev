<div class="modal fade" id="maklumat_calon" tabindex="-1" aria-labelledby="maklumat_calon" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Maklumat Status Calon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="text-uppercase nav-link fw-bolder active" id="status-permohonan-tab" data-bs-toggle="tab" href="#status-permohonan" aria-controls="status-permohonan" role="tab" aria-selected="true">
                                Senarai Status Permohonan Calon
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="text-uppercase nav-link fw-bolder" id="permohonan-semasa-tab" data-bs-toggle="tab" href="#permohonan-semasa" aria-controls="permohonan-semasa" role="tab" aria-selected="true">
                                Status Permohonan Jawatan Semasa
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="text-uppercase nav-link fw-bolder" id="permohonan-sebelum-tab" data-bs-toggle="tab" href="#permohonan-sebelum" aria-controls="permohonan-sebelum" role="tab" aria-selected="true">
                                Status Permohonan Jawatan Sebelum
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="status-permohonan" role="tabpanel" aria-labelledby="status-permohonan-tab">
                            @include('dashboard.maklumat_carian.status_permohonan')
                        </div>
                        <div class="tab-pane fade" id="permohonan-semasa" role="tabpanel" aria-labelledby="permohonan-semasa-tab">
                            @include('dashboard.maklumat_carian.jawatan_semasa')
                        </div>
                        <div class="tab-pane fade" id="permohonan-sebelum" role="tabpanel" aria-labelledby="permohonan-sebelum-tab">
                            @include('dashboard.maklumat_carian.jawatan_sebelum')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

