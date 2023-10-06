<div class="modal fade text-start" id="cutiawamFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Cuti Awam</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.cutiawam.store') }}" method="POST" id="cutiawamForm" data-reloadPage="true">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="tarikh_cuti">Cuti Awam
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="tarikh_cuti" id="tarikh_cuti"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="kod_ruj_senarai_cuti">Senarai Cuti
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="kod_ruj_senarai_cuti" name="kod_ruj_senarai_cuti" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($senaraicuti as $cuti)
                                        <option value="{{ $cuti->kod }}">{{ $cuti->nama }}</option>
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
                                        <option value="{{ $neg->kod }}">{{ $neg->nama }}</option>
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
