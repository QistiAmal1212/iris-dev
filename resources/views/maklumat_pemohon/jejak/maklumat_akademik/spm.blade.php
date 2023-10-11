<div class="bs-stepper vertical vertical-wizard">
    <div class="bs-stepper-header">
        <div class="step" data-target="#academic-spm-info" role="tab" id="academic-spm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Pelajaran Malaysia
                    </span>
                </span>
            </button>
        </div>

        <hr>

        <div class="step" data-target="#academic-spmv-info" role="tab" id="academic-spmv-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPMV
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Pelajaran Malaysia Vokasional
                    </span>

                    {{-- BADGE IF NO DATA STARTS HERE --}}
                    <span class="bs-stepper-subtitle">
                        <span class="badge badge-light-danger fw-bolder mt-1">Tiada Maklumat</span>
                    </span>
                    {{-- UNTIL HERE --}}
                </span>
            </button>
        </div>

        <hr>


        <div class="step" data-target="#academic-svm-info" role="tab" id="academic-svm-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SVM
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        Sijil Vokasional Malaysia
                    </span>
                </span>
            </button>
        </div>

        {{-- <hr>

        <div class="step" data-target="#academic-spmu-info" role="tab" id="academic-spmu-info-trigger">
            <button type="button" class="step-trigger">
                <span class="bs-stepper-box">
                    SPM(U)
                </span>
                <span class="bs-stepper-label">
                    <span class="bs-stepper-title text-wrap">
                        SPM Ulangan
                    </span>
                </span>
            </button>
        </div> --}}
    </div>

    <div class="bs-stepper-content">
        {{-- SPM --}}
        <div id="academic-spm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spm-info-trigger">
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

        {{-- SPMV --}}
        <div id="academic-spmv-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spmv-info-trigger">
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

        {{-- SVM --}}
        <div id="academic-svm-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-svm-info-trigger">
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

        {{-- <div id="academic-spmu-info" class="content parent-tab" role="tabpanel" aria-labelledby="academic-spmu-info-trigger">
        </div> --}}
    </div>
</div>
