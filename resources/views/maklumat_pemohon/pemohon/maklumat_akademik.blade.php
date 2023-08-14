<div class="">
    <ul class="nav nav-pills nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder active" id="pmr-tab" data-bs-toggle="tab" href="#pmr" aria-controls="pmr" role="tab" aria-selected="true">
                PT3/ PMR/ SRP
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="spm-tab" data-bs-toggle="tab" href="#spm" aria-controls="spm" role="tab" aria-selected="true">
                SPM/ SPMV/ SVM/ SPM Ulangan
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="stpm-tab" data-bs-toggle="tab" href="#stpm" aria-controls="stpm" role="tab" aria-selected="true">
                STPM/ STAM/ Sijil Matrikulasi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="skm-tab" data-bs-toggle="tab" href="#skm" aria-controls="skm" role="tab" aria-selected="true">
                Sijil Kemahiran (SKM)
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="pengajianTinggi-tab" data-bs-toggle="tab" href="#pengajianTinggi" aria-controls="pengajianTinggi" role="tab" aria-selected="true">
                Pengajian Tinggi
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link fw-bolder" id="kelayakanProfesional-tab" data-bs-toggle="tab" href="#kelayakanProfesional" aria-controls="kelayakanProfesional" role="tab" aria-selected="true">
                Kelayakan Profesional/ Ikhtisas
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="pmr" role="tabpanel" aria-labelledby="pmr-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.pmr')
        </div>
        <div class="tab-pane fade" id="spm" role="tabpanel" aria-labelledby="spm-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.spm')
        </div>
        <div class="tab-pane fade" id="stpm" role="tabpanel" aria-labelledby="stpm-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.stpm')
        </div>
        <div class="tab-pane fade" id="skm" role="tabpanel" aria-labelledby="skm-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.skm')
        </div>
        <div class="tab-pane fade" id="pengajianTinggi" role="tabpanel" aria-labelledby="pengajianTinggi-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.pengajian_tinggi')
        </div>
        <div class="tab-pane fade" id="kelayakanProfesional" role="tabpanel" aria-labelledby="kelayakanProfesional-tab">
            <hr>
            @include('maklumat_pemohon.pemohon.maklumat_akademik.kelayakan_profesional')
        </div>
    </div>
</div>