<div class="modal fade text-start" id="skimFormModal" tabindex="-1" aria-labelledby="title-role" aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Tambah Jawatan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.skim.store') }}" method="POST" id="skimForm" data-reloadPage="true">
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
                                <label class="form-label" for="name">Nama Jawatan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="GUNASAMA">Gunasama
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="GUNASAMA" name="GUNASAMA" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ref_skim_type">Jenis
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="ref_skim_type" name="ref_skim_type" value="" class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="GGH_KOD">Gred Gaji
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="GGH_KOD" name="GGH_KOD" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($ggh as $gred)
                                        <option value="{{ $gred->code }}">{{ $gred->code }} - {{ $gred->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="SKIM_PKHIDMAT">Skim Perkhidmatan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="SKIM_PKHIDMAT" name="SKIM_PKHIDMAT" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($skim_pkh as $pkh)
                                        <option value="{{ $pkh->kod }}">{{ $pkh->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="KUMP_PKHIDMAT_JKK">Kumpulan Perkhidmatan JKK
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="KUMP_PKHIDMAT_JKK" name="KUMP_PKHIDMAT_JKK" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($kump_jkk as $jkk)
                                        <option value="{{ $jkk->kod }}">{{ $jkk->nama }}</option>
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
