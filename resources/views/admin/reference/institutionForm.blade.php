<div class="modal fade text-start" id="institutionFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Institusi</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.institution.store') }}" method="POST" id="institutionForm" data-reloadPage="true">
                    @csrf
                    <input type="text" name="temp" id="temp" value="" hidden>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Kod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="code" name="code" value="" class="form-control" maxlength="14" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="name">Nama Institusi
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" maxlength="100" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="type">Jenis
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($jenis as $jenis)
                                        <option value="{{ $jenis->kod }}">{{ $jenis->diskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ref_country_code">Negara
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="ref_country_code" name="ref_country_code" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($negara as $neg)
                                        <option value="{{ $neg->kod }}">{{ $neg->diskripsi }}</option>
                                        @endforeach
                                    </select>
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
