<ul class="nav nav-pills nav-justified" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder active" id="peribadi-tab" data-bs-toggle="tab" href="#peribadi"
            aria-controls="peribadi" role="tab" aria-selected="true">
            Maklumat Peribadi
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="skim-tab" data-bs-toggle="tab" href="#skim"
            aria-controls="skim" role="tab" aria-selected="true">
            Maklumat Skim
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="akademik-tab" data-bs-toggle="tab" href="#akademik"
            aria-controls="akademik" role="tab" aria-selected="true">
            Maklumat Akademik
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="perkhidmatan-tab" data-bs-toggle="tab" href="#perkhidmatan"
            aria-controls="perkhidmatan" role="tab" aria-selected="true">
            Perkhidmatan Pegawai
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="tambahan-tab" data-bs-toggle="tab" href="#tambahan"
            aria-controls="tambahan" role="tab" aria-selected="true">
            Maklumat Tambahan
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="text-uppercase nav-link fw-bolder" id="tatatertib-tab" data-bs-toggle="tab" href="#tatatertib"
            aria-controls="tatatertib" role="tab" aria-selected="true">
            Tatatertib
        </a>
    </li>
</ul>

<div class="tab-content bukanKptContent">
    <div class="tab-pane fade show active" id="peribadi" role="tabpanel" aria-labelledby="peribadi-tab">
        @include('maklumat_pemohon.pemohon.maklumat_peribadi')
    </div>
    <div class="tab-pane fade" id="skim" role="tabpanel" aria-labelledby="skim-tab">
        @include('maklumat_pemohon.pemohon.maklumat_skim')
    </div>
    <div class="tab-pane fade" id="akademik" role="tabpanel" aria-labelledby="akademik-tab">
        @include('maklumat_pemohon.pemohon.maklumat_akademik')
    </div>
    <div class="tab-pane fade" id="perkhidmatan" role="tabpanel" aria-labelledby="perkhidmatan-tab">
        @include('maklumat_pemohon.pemohon.perkhidmatan')
    </div>
    <div class="tab-pane fade" id="tambahan" role="tabpanel" aria-labelledby="tambahan-tab">
        @include('maklumat_pemohon.pemohon.maklumat_tambahan')
    </div>
    <div class="tab-pane fade" id="tatatertib" role="tabpanel" aria-labelledby="tatatertib-tab">
        @include('maklumat_pemohon.pemohon.tatatertib')
    </div>
</div>
</div>