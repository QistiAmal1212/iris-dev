<div class="row">
    <form id="saveseksyenA_B1" class="row"
        action="{{ route('mylab.application.saveseksyenA_A3', ['mylab_application' => $mylab_application]) }}"
        method="POST"
        data-refreshFunctionURL="{{ route('mylab.application.refreshseksyenA_A3', ['mylab_application' => $mylab_application]) }}"
        data-refreshFunctionDivId="mylab_sectionA_tableCollaboratorSectA" data-reloadPage="false">
        @csrf
        <div class="col-md-6 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>E</b><span style="color:red;">*</span></h6>
                <textarea id="nama_ngo" name="nama_ngo" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <h6 class="mb-1"><b>F</b><span style="color:red;">*</span></h6>
                <textarea id="nama_industri" name="nama_industri" rows="5" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="form-group">
                <button type="button" class="btn btn-success" onclick="generalFormSubmit(this);"
                    id="saveseksyenA_A3_btn" hidden>
                    <span class="align-middle d-sm-inline-block d-none">Create</span>
                    <i class="far fa-save"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-between">
        <div class="form-group">
            <button type="button" class="btn btn-success" onclick="$('#saveseksyenA_A3_btn').trigger('click');">
                <span class="align-middle d-sm-inline-block d-none">Create</span>
                <i class="far fa-save"></i>
            </button>
        </div>
        <div class="form-group">
            <button type="button" class="btn mb-1" data-bs-toggle="collapse"
                aria-controls="mylab_sectionA_tableCollaboratorSectA_div"
                href="#mylab_sectionA_tableCollaboratorSectA_div" role="button" aria-expanded="false">
                <i class="fa-solid fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="collapse show multi-collapse" id="mylab_sectionA_tableCollaboratorSectA_div">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-12" id="mylab_sectionA_tableCollaboratorSectA">
                    @include('mylab.sectionA.tableCollaboratorSectA')
                </div>
            </div>
        </div>
    </div>
</div>

<form
    action="{{ route('mylab.application.checkACompletion', ['mylab_application' => $mylab_application, 'section' => 'subB']) }}"
    method="GET" data-reloadPage="false" data-swal="false">
    @csrf

    <div class="d-flex justify-content-between">
        <button type="button" class="btn btn-primary btn-prev">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            <span class="align-middle d-sm-inline-block d-none">Previous</span>
        </button>
        <button type="button" class="btn btn-primary" id="seksyenASubB" onclick="checkFormRequire('seksyenASubB');">
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
        <button class="btn btn-primary btn-next" type="button" hidden>
            <span class="align-middle d-sm-inline-block d-none">Next</span>
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
    </div>
</form>
