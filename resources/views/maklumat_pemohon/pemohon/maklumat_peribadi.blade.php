<div class="">
    <ul class="nav nav-pills nav-pill-info nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="personal-tab" data-bs-toggle="tab" href="#personal" aria-controls="personal" role="tab" aria-selected="true">
                Peribadi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="alamat-tab" data-bs-toggle="tab" href="#alamat" aria-controls="alamat" role="tab" aria-selected="true">
                Alamat
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="tempatLahir-tab" data-bs-toggle="tab" href="#tempatLahir" aria-controls="tempatLahir" role="tab" aria-selected="true">
                Tempat Lahir
                <br><div class="badge badge-light-danger fw-bolder" id="tm_lahir" hidden>Tiada Maklumat</div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="lesen-tab" data-bs-toggle="tab" href="#lesen" aria-controls="lesen" role="tab" aria-selected="true">
                Lesen Memandu
                <br><div class="badge badge-light-danger fw-bolder" id="tm_lesen" hidden>Tiada Maklumat</div>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="oku-tab" data-bs-toggle="tab" href="#oku" aria-controls="oku" role="tab" aria-selected="true">
                Kurang Upaya (OKU)
                <br><div class="badge badge-light-danger fw-bolder" id="tm_oku" hidden>Tiada Maklumat</div>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_peribadi.peribadi')
        </div>
        <div class="tab-pane fade" id="alamat" role="tabpanel" aria-labelledby="alamat-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_peribadi.alamat')
        </div>
        <div class="tab-pane fade" id="tempatLahir" role="tabpanel" aria-labelledby="tempatLahir-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_peribadi.tempat_lahir')
        </div>
        <div class="tab-pane fade" id="lesen" role="tabpanel" aria-labelledby="lesen-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_peribadi.lesen_memandu')
        </div>
        <div class="tab-pane fade" id="oku" role="tabpanel" aria-labelledby="oku-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_peribadi.kurang_upaya')
        </div>
    </div>
</div>
