<section>
    <div class="bs-stepper vertical vertical-wizard col-12">
        <div class="bs-stepper-header">
            <div class="step" data-target="#secBtabA-vertical" role="tab" id="secBtabA-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">A</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Modal Table</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <div id="secBtabA-vertical" class="content" role="tabpanel" aria-labelledby="secBtabA-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Table Nama Keluarga</h5>
                    <small class="text-muted"></small>
                </div>
                <div class="">
                    <hr />
                    <div class="col-md-10 col-12 d-flex justify-content-end">
                        <button class="btn btn-primary btn-next mb-1 " data-action="{{route('testForm.editFamilyModal')}}" onclick="getModalContent(this)">
                            <span class="align-middle d-sm-inline-block d-none">Add</span>
                        </button>
                    </div>

                    <div class="col-md-10 col-12" id="tableFamilyDiv">
                        @include('test_form.borang.tab3.subATableFamily')
                    </div>
                </div>
            </div>
    </div>
    </div>
</section>

@push('js')

@endpush
