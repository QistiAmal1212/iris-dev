<div class="">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="jejak-tentera-tab" data-bs-toggle="tab" href="#jejak-tentera" aria-controls="jejak-tentera" role="tab" aria-selected="true">
                Maklumat Bekas Tentera
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-bahasa-tab" data-bs-toggle="tab" href="#jejak-bahasa" aria-controls="jejak-bahasa" role="tab" aria-selected="true">
                Kebolehan Bahasa
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-bakat-tab" data-bs-toggle="tab" href="#jejak-bakat" aria-controls="jejak-bakat" role="tab" aria-selected="true">
                Bakat
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="jejak-tentera" role="tabpanel" aria-labelledby="jejak-tentera-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_tambahan.bekas_tentera')
        </div>
        <div class="tab-pane fade" id="jejak-bahasa" role="tabpanel" aria-labelledby="jejak-bahasa-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_tambahan.bahasa')
        </div>
        <div class="tab-pane fade" id="jejak-bakat" role="tabpanel" aria-labelledby="jejak-bakat-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_tambahan.bakat')
        </div>
    </div>
</div>
