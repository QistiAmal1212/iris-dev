<div class="row mt-2 mb-2">

    <div class="col sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label fw-bolder">Tindakan Tatatertib</label>
        <select class="form-select select2" name="" id="">
            <option value="" hidden>Tindakan Tatatertib</option>
        </select>
    </div>

    <div class="col sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label fw-bolder">Tempoh Hukuman</label>
            <div class="input-group">
                <input type="text" class="form-control">
                <span class="input-group-text" id="basic-addon-search1">
                    <select class="form-control select2" name="jenis" id="jenis">
                        <option value="" hidden>Spesis</option>
                        <option value="Ayam">Tahun</option>
                        <option value="Babi">Bulan</option>
                        <option value="Kerbau">Hari</option>
                    </select>
                </span>
            </div>
        </div>
    </div>

    <div class="col sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label fw-bolder">Tarikh Mula Hukuman</label>
        <input type="date" class="form-control" name="" id="">
    </div>

    <div class="col sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label fw-bolder">Tarikh Akhir Hukuman</label>
        <input type="date" class="form-control" name="" id="" disabled>
    </div>

    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3" type="button" id="reset" href="#">
            <span class="text-danger"> Set Semula </span>
        </a>
        <button type="submit" class="btn btn-success float-right">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>

    <hr>

    <div class="table-responsive">
        <table class="table header_uppercase table-bordered table-hovered">
            <thead>
                <tr>
                    <th>Bil.</th>
                    <th>Tindakan Tatatertib</th>
                    <th>Tempoh Hukuman</th>
                    <th>Tarikh Hukuman</th>
                    <th>Kemaskini Terkini</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>1</td>
                    <td>12 - Memalsukan Maklumat</td>
                    <td>1</td>
                    <td>21/05/2020</td>
                    <td>21/05/2020 03:44:15</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>