<div class="modal fade text-start" id="daerahFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Daerah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.daerah.store') }}" method="POST" id="daerahForm" data-reloadPage="true">
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
                                <label class="form-label" for="name">Daerah
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kod_ruj_bahagian">Bahagian
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="kod_ruj_bahagian" name="kod_ruj_bahagian" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($bahagian as $bah)
                                        <option value="{{ $bah->kod }}">{{ $bah->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kod_ruj_negeri">Negeri
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="kod_ruj_negeri" name="kod_ruj_negeri" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($negeri as $neg)
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
