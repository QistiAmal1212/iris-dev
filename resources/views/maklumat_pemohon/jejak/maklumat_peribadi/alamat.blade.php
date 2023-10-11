<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#alamat-tetap-info" role="tab" id="alamat-tetap-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    A
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Alamat Tetap
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#alamat-surat-info" role="tab" id="alamat-surat-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    B
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Alamat Surat Menyurat
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- ALAMAT TETAP --}}
        <div id="alamat-tetap-info" class="content parent-tab" role="tabpanel" aria-labelledby="alamat-tetap-info-trigger">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                    <label class="form-label">Tarikh Mula</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                    <label class="form-label">Tarikh Akhir</label>
                    <input type="text" class="form-control">
                </div>

                <div class="d-flex justify-content-end align-items-center">
                    <a class="me-3" type="button" id="reset" href="#">
                        <span class="text-danger"> Set Semula </span>
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </div>

            <div class="table-responsive mb-1 mt-1">
                <table class="table header_uppercase table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Maklumat</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- ALAMAT SURAT MENYURAT --}}
        <div id="alamat-surat-info" class="content parent-tab" role="tabpanel" aria-labelledby="alamat-surat-info-trigger">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                    <label class="form-label">Tarikh Mula</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                    <label class="form-label">Tarikh Akhir</label>
                    <input type="text" class="form-control">
                </div>

                <div class="d-flex justify-content-end align-items-center">
                    <a class="me-3" type="button" id="reset" href="#">
                        <span class="text-danger"> Set Semula </span>
                    </a>
                    <button type="submit" class="btn btn-success float-right">
                        <i class="fa fa-search"></i> Cari
                    </button>
                </div>
            </div>

            <div class="table-responsive mb-1 mt-1">
                <table class="table header_uppercase table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Maklumat</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
