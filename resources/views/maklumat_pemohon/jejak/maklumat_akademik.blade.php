<div class="">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="jejak-pmr-tab" data-bs-toggle="tab" href="#jejak-pmr" aria-controls="jejak-pmr" role="tab" aria-selected="true">
                PT3/ PMR/ SRP
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-spm-tab" data-bs-toggle="tab" href="#jejak-spm" aria-controls="jejak-spm" role="tab" aria-selected="true">
                SPM/ SPMV/ SVM/ SPM Ulangan
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-stpm-tab" data-bs-toggle="tab" href="#jejak-stpm" aria-controls="jejak-stpm" role="tab" aria-selected="true">
                STPM/ STAM/ Sijil Matrikulasi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-skm-tab" data-bs-toggle="tab" href="#jejak-skm" aria-controls="jejak-skm" role="tab" aria-selected="true">
                Sijil Kemahiran (SKM)
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-pengajianTinggi-tab" data-bs-toggle="tab" href="#jejak-pengajianTinggi" aria-controls="jejak-pengajianTinggi" role="tab" aria-selected="true">
                Pengajian Tinggi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="jejak-kelayakanProfesional-tab" data-bs-toggle="tab" href="#jejak-kelayakanProfesional" aria-controls="jejak-kelayakanProfesional" role="tab" aria-selected="true">
                Kelayakan Profesional/ Ikhtisas
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="jejak-pmr" role="tabpanel" aria-labelledby="jejak-pmr-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.pmr')
        </div>
        <div class="tab-pane fade" id="jejak-spm" role="tabpanel" aria-labelledby="jejak-spm-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.spm')
        </div>
        <div class="tab-pane fade" id="jejak-stpm" role="tabpanel" aria-labelledby="jejak-stpm-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.stpm')
        </div>
        <div class="tab-pane fade" id="jejak-skm" role="tabpanel" aria-labelledby="jejak-skm-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.skm')
        </div>
        <div class="tab-pane fade" id="jejak-pengajianTinggi" role="tabpanel" aria-labelledby="jejak-pengajianTinggi-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.pengajian_tinggi')
        </div>
        <div class="tab-pane fade" id="jejak-kelayakanProfesional" role="tabpanel" aria-labelledby="jejak-kelayakanProfesional-tab">
            <hr>
            @include('maklumat_pemohon.jejak.maklumat_akademik.kelayakan_profesional')
        </div>
    </div>
</div>
