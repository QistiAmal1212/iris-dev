<div class="row">

    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
        <label class="fw-bolder"> Tahun </label>
        <select name="" id="" class="form-select select2">
            <option value="" hidden>Tahun</option>
                @php
                    $currentYear = date('Y');
                @endphp
                @for ($year = $currentYear; $year >= 2007; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
        </select>
    </div>

    <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
        <label class="fw-bolder"> Nama Kementerian </label>
        <input type="text" id="" name="" class="form-control" value="Kementerian Pengajian Tinggi" disabled>
    </div>

    <hr>

    <h6 class="fw-bolder"> Jawatan </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label> Skim Perkhidmatan </label>
        <select name="" id="" class="form-select select2">
            <option value="" hidden>Tahun</option>
                @foreach ($skims as $skim)
                    <option value="{{ $skim->kod }}">{{ $skim->diskripsi }}</option>
                @endforeach
        </select>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label> Klasifikasi Perkhidmatan </label>
        <input type="text" id="" name="" class="form-control" value="Kementerian Pengajian Tinggi">
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label> Kumpulan Perkhidmatan </label>
        <input type="text" id="" name="" class="form-control" value="Kementerian Pengajian Tinggi">
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label> Gred Gaji </label>
        <input type="text" id="" name="" class="form-control" value="Kementerian Pengajian Tinggi">
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label>Jadual Gaji</label>
        <div class="input-group">
            <input type="text" id="" name="" class="form-control" placeholder="P">
            <input type="text" id="" name="" class="form-control" placeholder="T">
        </div>
    </div>

    <hr>

    <h6 class="fw-bolder"> Bilangan Jawatan Yang Diluluskan Mengikut Buku Anggaran Belanja Mengurus </h6>
    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label> Tahun </label>
        <select name="" id="" class="form-select select2">
            <option value="" hidden>Tahun</option>
                @php
                    $currentYear = date('Y');
                @endphp
                @for ($year = $currentYear; $year >= 2007; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
        </select>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label>Tetap</label>
        <input type="text" id="" name="" class="form-control">
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label>Kontrak</label>
        <input type="text" id="" name="" class="form-control">
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
        <label>Sementara</label>
        <input type="text" id="" name="" class="form-control">
    </div>

    <hr>

    <h6 class="fw-bolder"> Kekosongan </h6>
    <table class="table">
        <tr>
            <td>Bilangan Kekosongan Dipohon untuk Pengisian</td>
            <td>
                <input type="text" id="" name="" class="form-control">
            </td>
        </tr>
        <tr>
            <td>
                Bilangan Kekosongan Yang Masih Ada
                <br>
                <a class="text-muted">
                    (Untuk Tempoh 6 Bulan)
                </a>
            </td>
            <td>
                <input type="text" id="" name="" class="form-control">
            </td>
        </tr>
        <tr>
            <td>
                Bilangan Kekosongan Yang Masih Ada
                <br>
                <a class="text-muted">
                    (Akibat Persaraan atau Kenaikan Pangkat)
                </a>
            </td>
            <td>
                <input type="text" id="" name="" class="form-control">
            </td>
        </tr>
        <tr>
            <td>Bilangan Kekosongan Dari Kemungkinan Lain</td>
            <td>
                <input type="text" id="" name="" class="form-control">
            </td>
        </tr>
    </table>

    <hr>

    <h6 class="fw-bolder"> Pecahan Kekosongan </h6>
    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label>Semenajung</label>
        <input type="text" id="" name="" class="form-control">
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label>Sabah</label>
        <input type="text" id="" name="" class="form-control">
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label>Sarawak</label>
        <input type="text" id="" name="" class="form-control">
    </div>
</div>

<div class="card-footer">
    {{-- <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div> --}}
</div>
