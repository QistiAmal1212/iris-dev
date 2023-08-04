<div class="row">
    <form id="saveseksyenA_A1" class="row"
        action={{ route('mylab.application.saveseksyenA_A1', ['mylab_application' => $mylab_application]) }}
        method="POST"
        data-autosave-url="{{ route('mylab.application.autosave.saveseksyenA_A1', ['mylab_application' => $mylab_application]) }}"
        data-reloadPage="false">
        @csrf
        <div class="col-md-12 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>A</b><span style="color:red;">*</span></h6>
                <textarea type="text" id="tajuk_projek" name="project_title" class="form-control" rows="4" required>{{ $mylab_application->project_title }}</textarea>
            </div>
        </div>
        <hr />
        <div class="col-md-6 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>B</b><span style="color:red;">*</span></h6>
                <select class="select23 form-select" id="tempoh_projek" name="project_duration" required>
                    <option value="" hidden>Sila pilih</option>
                    @for ($i = 1; $i <= 24; $i++)
                        <option value={{ $i }}
                            {{ $mylab_application->project_duration == $i ? 'selected' : '' }}>{{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <hr />
        <div class="col-md-12 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>C</b><span style="color:red;">*</span></h6>
                <textarea type="text" id="ringkasan_trl" name="trl_output_remarks" class="form-control" rows="2"
                    maxlength="255" required>{{ $mylab_application->trl_output_remarks }}</textarea>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>D</b><span
                        style="color:red;">*</span></label><br><label><b>{{ __('msg.file_upload_RegEx') }}</b></h6>
                <input type="file" accept="application/pdf" class="form-control" id="file" name="file"
                    data-allowed-file-extensions="pdf" required />
                <div id="fileReloadSection">
                    @forelse($mylab_application->uploadedFiles($mylab_application?->file)->get() ?? array() as $key => $value)
                        <a href="{{ asset($value->path) }}" target="_blank"><i class="fa-solid fa-download"></i>
                            {{ $value->original_filename ?? '-' }}</a>
                        <br>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label class="form-label" for="mohe">In group</i></label>
                    <div class="input-group mb-2">
                        <input type="text" id="test1" name="amount_applied_mohe" class="form-control"
                            placeholder="amount">
                        <input type="text" id="test2" name="amount_applied_mohe" class="form-control"
                            placeholder="amount">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Check in server --}}
<form id="checkA_A1" class="row"
    action={{ route('mylab.application.checkA_A1', ['mylab_application' => $mylab_application]) }} method="POST" data-swal="false">
    @csrf
    <button type="button" onclick="generalFormSubmit(this);" id="checkA_A1_btn" hidden>
    </button>
</form>

{{-- checkFormRequire('#') Check in client --}}
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-outline-secondary btn-prev" disabled>
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        <span class="align-middle d-sm-inline-block d-none">Previous</span>
    </button>
    <button type="button" class="btn btn-primary" onclick="$('#checkA_A1_btn').trigger('click');checkFormRequire('saveseksyenA_A1',this);">
        <span class="align-middle d-sm-inline-block d-none">Next</span>
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </button>
    <button type="button" class="btn btn-primary btn-next" hidden>
        <span class="align-middle d-sm-inline-block d-none">Next</span>
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
    </button>
</div>

@push('js')
@endpush
