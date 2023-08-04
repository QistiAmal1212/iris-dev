<div class="modal fade" id="baseAjaxModalContent" tabindex="-1" aria-labelledby="statusFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addNewCardTitle">Edit Form</h1>
                <p class="text-center"></p>
                <form id="updateseksyenA_A3" class="row"
                    action="{{ route('mylab.application.updateseksyenA_A3', ['mylab_application' => $mylab_application]) }}"
                    method="POST"
                    data-refreshFunctionURL="{{ route('mylab.application.refreshseksyenA_A3', ['mylab_application' => $mylab_application]) }}"
                    data-refreshFunctionDivId="mylab_sectionA_tableCollaboratorSectA" data-reloadPage="false">
                    @csrf
                    <input name="id" value="{{ $data?->id }}" hidden />
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="nama_ngo">a. Nama dan alamat Universiti/Institut
                                Penyelidikan/Agensi Kerajaan/Badan Bukan Kerajaan (NGO)<span
                                    style="color:red;">*</span></label>
                            <textarea id="nama_ngo" name="nama_ngo" rows="5" class="form-control">{{ $data?->university_name_addrs }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label class="form-label" for="nama_industri">b. Nama dan alamat Industri<span
                                    style="color:red;">*</span></label>
                            <textarea id="nama_industri" name="nama_industri" rows="5" class="form-control">{{ $data?->industry_name_addrs }}</textarea>
                        </div>
                    </div>
                    <button id="updateseksyenA_A3_btn" type="button" hidden onclick="generalFormSubmit(this);">
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <button type="button" class="btn btn-success"
                        onclick="$('#updateseksyenA_A3_btn').trigger('click');" data-bs-dismiss="modal">
                        <span class="align-middle d-sm-inline-block d-none">Simpan</span>
                        <i class="far fa-save"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
