<div class="modal fade text-start" id="departmentMinistryFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Kementerian</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.department-ministry.store') }}" method="POST" id="departmentMinistryForm" data-reloadPage="true">
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
                                <label class="form-label" for="name">Nama Kementerian
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kem_kod">Kod Kementerian
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="kem_kod" name="kem_kod" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="gelaran_ketua">Gelaran Ketua
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="gelaran_ketua" name="gelaran_ketua" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="unit_urusan">Unit Urusan
                                    {{-- <span class="text text-danger">*</span> --}}
                                </label>
                                <div class="input-group">
                                    <select id="unit_urusan" name="unit_urusan" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="alamat_1">Alamat
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="alamat_1" name="alamat_1" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="alamat_2" name="alamat_2" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="alamat_3" name="alamat_3" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="poskod">Poskod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="poskod" name="poskod" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="bandar">Bandar
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="bandar" name="bandar" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
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
