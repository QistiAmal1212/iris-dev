<div class="">
    <ul class="nav nav-pills nav-pill-info nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="tentera-tab" data-bs-toggle="tab" href="#tentera" aria-controls="tentera" role="tab" aria-selected="true">
                Maklumat Bekas Tentera
                <br><div class="badge badge-light-danger fw-bolder" id="tm_tentera" hidden>Tiada Maklumat</div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="bahasa-tab" data-bs-toggle="tab" href="#bahasa" aria-controls="bahasa" role="tab" aria-selected="true">
                Kebolehan Bahasa
                <br><div class="badge badge-light-danger fw-bolder" id="tm_bahasa" hidden>Tiada Maklumat</div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="bakat-tab" data-bs-toggle="tab" href="#bakat" aria-controls="bakat" role="tab" aria-selected="true">
                Bakat
                <br><div class="badge badge-light-danger fw-bolder" id="tm_bakat" hidden>Tiada Maklumat</div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="pengalaman-tab" data-bs-toggle="tab" href="#pengalaman" aria-controls="pengalaman" role="tab" aria-selected="true">
                Pengalaman
                <br><div class="badge badge-light-danger fw-bolder" id="#" hidden>Tiada Maklumat</div>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tentera" role="tabpanel" aria-labelledby="tentera-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_tambahan.bekas_tentera')
        </div>
        <div class="tab-pane fade" id="bahasa" role="tabpanel" aria-labelledby="bahasa-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_tambahan.bahasa')
        </div>
        <div class="tab-pane fade" id="bakat" role="tabpanel" aria-labelledby="bakat-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_tambahan.bakat')
        </div>
        <div class="tab-pane fade" id="pengalaman" role="tabpanel" aria-labelledby="pengalaman-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_tambahan.pengalaman')
        </div>
    </div>
</div>
