<div class="modal fade text-start" id="eligibilityFormModal" tabindex="-1" aria-labelledby="title-role"
    aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Kelayakan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.eligibility.store') }}" method="POST" id="eligibilityForm" data-reloadPage="true">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Kod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="code" name="code" value=""
                                        class="form-control" maxlength="16" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="name">Kelayakan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" maxlength="60" required>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="ref_skim_code">Kod Jawatan <span class="text text-danger">*</span>
                                </label>
                                <select class="form-control" name="ref_skim_code" id="ref_skim_code" required>
                                    <option value="">Sila Pilih:-</option>
                                    @foreach ($skim as $skim)
                                        <option value="{{ $skim->kod }}">{{ $skim->diskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="equivalent">Kelayakan Akademik
                                    <span class="text text-danger">*</span>
                                </label>
                                <select class="form-control" name="equivalent" id="equivalent" required>
                                    <option value="">Sila Pilih:-</option>
                                    @foreach ($kelayakanSetaraf as $kelayakanSetaraf)
                                        <option value="{{ $kelayakanSetaraf->kod }}">{{ $kelayakanSetaraf->diskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="rank">Pangkat Kelayakan
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="rank" name="rank" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <button type="button" id="btn_submit" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_fake" class="btn btn-primary"
                    onclick="$('#btn_submit').trigger('click');">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
