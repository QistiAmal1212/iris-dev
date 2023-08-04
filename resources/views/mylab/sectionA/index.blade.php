<section class="">
    <div class="bs-stepper vertical vertical-wizard">
        <div class="bs-stepper-header">
            <hr />
            <div class="step" data-target="#secAtabA-vertical" role="tab" id="secAtabA-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">A</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Field Form</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
            <hr />

            <div class="step" data-target="#secAtabD-vertical" role="tab" id="secAtabD-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">B</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Table Form</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <div id="secAtabA-vertical" class="content" role="tabpanel" aria-labelledby="secAtabA-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Field Form</h5>
                    <small class="text-muted"></small>
                </div>
                <div class="row">
                    <div class="mb-1 col-sm-12">
                        @include('mylab.sectionA.questionA')
                    </div>
                </div>
            </div>

            <div id="secAtabD-vertical" class="content" role="tabpanel" aria-labelledby="secAtabD-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Table Form</h5>
                    <small class="text-muted"></small>
                </div>
                <div class="row">
                    <div class="mb-1 col-sm-12">
                        @include('mylab.sectionA.questionB')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
