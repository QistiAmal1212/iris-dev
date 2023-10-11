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
                <th>Jawatan</th>
                <th>Pemerolehan</th>
                <th>Kod Skim</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <a data-bs-toggle="offcanvas" data-bs-target="#skim-detail" aria-controls="skim-detail" class="text-primary">
                        <i class="fa-solid fa-circle-info"></i>
                        Pegawai Antidadah Gred S41
                    </a>
                </td>
                <td>14 Rekod</td>
                <td>1184</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Screen Level 1 --}}
<div class="enable-backdrop">
    <div class="offcanvas offcanvas-end custom-wider-offcanvas" tabindex="-1" id="skim-detail" aria-labelledby="skim-detailLabel" style="width: 70%; !important">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Pegawai Antidadah Gred S41 []</h5> {{-- Nama Jawatan [Kod Pemerolehan] --}}
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="table-responsive">
                <table class="table header_uppercase table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Pemerolehan</th>
                            <th>Tarikh Tutup</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>SM20230099</td>
                            <td>19/07/2023</td>
                            <td>
                                <a data-bs-toggle="offcanvas" data-bs-target="#tapisan-detail" aria-controls="tapisan-detail" class="text-primary">
                                    <span class="badge rounded-pill badge-light-info me-1">
                                        eSMSM
                                    </span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Screen Level 2: Keterangan Tapisan --}}
<div class="enable-backdrop">
    <div class="offcanvas offcanvas-end custom-wider-offcanvas" tabindex="-1" id="tapisan-detail" aria-labelledby="tapisan-detailLabel" style="width: 60%; !important">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Pegawai Antidadah Gred S41 []</h5> {{-- Nama Jawatan [Kod Pemerolehan] --}}
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">

        </div>
    </div>
</div>

<script>
    // Function to open the off-canvas without closing others
    $("#skim-link").click(function (e) {
        e.preventDefault();
        var offCanvas = new bootstrap.Offcanvas(document.getElementById("skim-detail"));
        offCanvas.show();
    });
</script>
