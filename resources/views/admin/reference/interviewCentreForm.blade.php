<div class="modal fade text-start" id="interviewCentreFormModal" tabindex="-1" aria-labelledby="title-role"
    aria-hidden="true" data-bs-backdrop="false" style="background:rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title-role">Pusat Temuduga</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.reference.interview-centre.store') }}" method="POST" id="interviewCentreForm" data-reloadPage="true">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="code">Kod
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="code" name="code" value=""
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="name">Pusat Temuduga
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="text" id="name" name="name" value=""
                                        class="form-control" oninput="this.value = this.value.toUpperCase()" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="ref_area_code">Kawasan Pusat Temuduga <span class="text text-danger">*</span>
                                </label>
                                <select class="form-control" name="ref_area_code" id="ref_area_code" required>
                                    <option value="">Sila Pilih:-</option>
                                    @foreach ($areaInterviewCentre as $area)
                                    <option value="{{ $area->kod }}">{{ $area->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="ref_state_code">Negeri
                                    <span class="text text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <select id="ref_state_code" name="ref_state_code" class="form-control" required>
                                        <option value="">Sila Pilih:-</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->kod }}">{{ $state->nama }}</option>
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
                <button type="button" id="btn_fake" class="btn btn-primary"
                    onclick="$('#btn_submit').trigger('click');">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
