<div class="">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="jejak-personal-tab" data-bs-toggle="tab" href="#jejak-personal" aria-controls="jejak-personal" role="tab" aria-selected="true">
                Peribadi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-alamat-tab" data-bs-toggle="tab" href="#jejak-alamat" aria-controls="jejak-alamat" role="tab" aria-selected="true">
                Alamat
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-tempatLahir-tab" data-bs-toggle="tab" href="#jejak-tempatLahir" aria-controls="jejak-tempatLahir" role="tab" aria-selected="true">
                Tempat Lahir
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-lesen-tab" data-bs-toggle="tab" href="#jejak-lesen" aria-controls="jejak-lesen" role="tab" aria-selected="true">
                Lesen Memandu
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-oku-tab" data-bs-toggle="tab" href="#jejak-oku" aria-controls="jejak-oku" role="tab" aria-selected="true">
                Kurang Upaya (OKU)
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="jejak-personal" role="tabpanel" aria-labelledby="jejak-personal-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_peribadi.peribadi')
        </div>
        <div class="tab-pane fade" id="jejak-alamat" role="tabpanel" aria-labelledby="jejak-alamat-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_peribadi.alamat')
        </div>
        <div class="tab-pane fade" id="jejak-tempatLahir" role="tabpanel" aria-labelledby="jejak-tempatLahir-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_peribadi.tempat_lahir')
        </div>
        <div class="tab-pane fade" id="jejak-lesen" role="tabpanel" aria-labelledby="jejak-lesen-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_peribadi.lesen_memandu')
        </div>
        <div class="tab-pane fade" id="jejak-oku" role="tabpanel" aria-labelledby="jejak-oku-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_peribadi.kurang_upaya')
        </div>
    </div>
</div>
