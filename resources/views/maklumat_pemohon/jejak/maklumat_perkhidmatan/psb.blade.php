<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#perkhidmatan-info" role="tab" id="perkhidmatan-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    A
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        PSB/PSL
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#perkhidmatan-hakiki-info" role="tab" id="perkhidmatan-hakiki-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    B
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Perkhidmatan Sekarang (Hakiki)
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#tempat-bertugas-info" role="tab" id="tempat-bertugas-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    C
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Tempat Bertugas <br> Terkini
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- PSB/PSL --}}
        <div id="perkhidmatan-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-info-trigger">
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

        {{-- Perkhidmatan Sekarang (Hakiki) --}}
        <div id="perkhidmatan-hakiki-info" class="content parent-tab" role="tabpanel" aria-labelledby="perkhidmatan-hakiki-info-trigger">
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

        {{-- Tempat Bertugas Terkini --}}
        <div id="tempat-bertugas-info" class="content parent-tab" role="tabpanel" aria-labelledby="tempat-bertugas-info-trigger">
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
