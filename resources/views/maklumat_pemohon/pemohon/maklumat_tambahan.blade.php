<div class="">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="tentera-tab" data-bs-toggle="tab" href="#tentera" aria-controls="tentera" role="tab" aria-selected="true">
                Maklumat Bekas Tentera
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="bahasa-tab" data-bs-toggle="tab" href="#bahasa" aria-controls="bahasa" role="tab" aria-selected="true">
                Kebolehan Bahasa
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="bakat-tab" data-bs-toggle="tab" href="#bakat" aria-controls="bakat" role="tab" aria-selected="true">
                Bakat
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
    </div>
</div>
