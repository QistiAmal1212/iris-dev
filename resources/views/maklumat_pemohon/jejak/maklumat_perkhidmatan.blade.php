<div class="">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="jejak-maklumatPSB-tab" data-bs-toggle="tab" href="#jejak-maklumatPSB" aria-controls="jejak-maklumatPSB" role="tab" aria-selected="true">
                Maklumat PSB/PSL
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-peperiksaanPSL-tab" data-bs-toggle="tab" href="#jejak-peperiksaanPSL" aria-controls="jejak-peperiksaanPSL" role="tab" aria-selected="true">
                Peperiksaan PSL
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="jejak-maklumatPSB" role="tabpanel" aria-labelledby="jejak-maklumatPSB-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_perkhidmatan.psb')
        </div>
        <div class="tab-pane fade" id="jejak-peperiksaanPSL" role="tabpanel" aria-labelledby="jejak-peperiksaanPSL-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_perkhidmatan.peperiksaan')
        </div>
    </div>
</div>
