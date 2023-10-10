<div class="modal fade text-start" id="ahlisuruhanjayaFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Ahli Suruhanjaya</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.ahlisuruhanjaya.store') }}" method="POST" id="ahlisuruhanjayaForm" data-reloadPage="true">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Kod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="code" name="code" value="" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="name">Nama
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="no_kp">No. Kad Pengenalan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="no_kp" name="no_kp" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="no_tel">No. Telefon
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="no_tel" name="no_tel" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kekananan">Kekananan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="kekananan" name="kekananan" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kontrak_dari1">Kontrak Bermula
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="kontrak_dari1" id="kontrak_dari1"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kontrak_hingga1">Kontrak Tamat
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="kontrak_hingga1" id="kontrak_hingga1"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="status_ahli">Status Ahli
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="status_ahli" name="status_ahli" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="nama_pasangan">Nama Pasangan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="nama_pasangan" name="nama_pasangan" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="no_tel_pasangan">No. Telefon Pasangan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="no_tel_pasangan" name="no_tel_pasangan" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="alamat1">Alamat Rumah
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="alamat1" name="alamat1" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="alamat2" name="alamat2" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="alamat3" name="alamat3" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="elaun_pada_gred">Elaun Pada Gred
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="elaun_pada_gred" name="elaun_pada_gred" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btn_submit" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_fake" class="btn btn-primary" onclick="$('#btn_submit').trigger('click');">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
