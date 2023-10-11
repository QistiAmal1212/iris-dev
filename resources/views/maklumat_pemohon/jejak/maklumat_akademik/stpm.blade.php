<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-stpm-info" role="tab" id="academic-stpm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    STPM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Tinggi Persekolahan Malaysia
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-stam-info" role="tab" id="academic-stam-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    STAM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Tinggi Agama Malaysia
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-matrik-info" role="tab" id="academic-matrik-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    KM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Matrikulasi
                    </span>
                </span>
            </button>
        </div>
    </div>

    <div class="bs-stepper-content">
        {{-- STPM --}}
        <div id="academic-stpm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-stpm-info-trigger">
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
                            <th>Kod</th>
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- STAM --}}
        <div id="academic-stam-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-stam-info-trigger">
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
                            <th>Kod</th>
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Tarikh</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        {{-- MATRIK --}}
        <div id="academic-matrik-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-matrik-info-trigger">
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
                            <th>Kod</th>
                            <th>Mata Pelajaran</th>
                            <th>Gred</th>
                            <th>Tahun</th>
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
