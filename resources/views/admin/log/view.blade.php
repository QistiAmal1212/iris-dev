<!-- Modal -->

<style>
.form-group-default {
    background-color: #fff;
    position: relative;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 2px;
    padding-top: 7px;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 4px;
    overflow: hidden;
    width: 100%;
    -webkit-transition: background-color 0.2s ease;
    transition: background-color 0.2s ease;
}
.form-group label:not(.error) {
    font-family: 'Montserrat';
    font-size: 10.5px;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    font-weight: 500;
}
.form-group-default label {
    margin: 0;
    display: block;
    opacity: 1;
    -webkit-transition: opacity 0.2s ease;
    transition: opacity 0.2s ease;
}
</style>

<div class="modal fade" id="auditModal" tabindex="-1" aria-labelledby="#addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addModalTitle">Detail <span class="bold">Audit Trail</span></h1>
                <p class="text-center" name="sub_title" id="sub_title">Please view the information details below.</p>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group form-group-default ">
                            <label><span>Modul</span></label>
                            {{ $audit_log->module->name }}
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>Activity Type</span></label>
                            @if($audit_log->activity_type_id == 6)
                                <span class="badge bg-danger">{{ $audit_log->activity_type->name_bi }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $audit_log->activity_type->name_bi }}</span>
                            @endif
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>Description</span></label>
                            {{ $audit_log->description }}
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>URL / Link</span></label>
                            <span class="badge bg-secondary">{{ $audit_log->method }}</span> <a href="{{ $audit_log->url }}">{{ $audit_log->url }}</a>
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>IP Address</span></label>
                            {{ $audit_log->ip_address }}
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>Created By</span></label>
                            {{ optional($audit_log->created_by)->name }}
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>Created At</span></label>
                            {{ date('d/m/Y H:i:s',strtotime($audit_log->created_at)) }}
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-group form-group-default ">
                            <label><span>Old Data</span></label>
                            <pre id="json-old"></pre>
                        </div>

                        <div class="form-group form-group-default ">
                            <label><span>New Data</span></label>
                            <pre id="json-new"></pre>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#auditModal').modal('show');

    var data_old = '{!! $audit_log->data_old ? $audit_log->data_old : "{}" !!}';
    if (isJson(data_old)) {
        data_old = JSON.stringify(JSON.parse(data_old), null, 3);
    }
    $('#json-old').html(data_old);

    var data_new = '{!! $audit_log->data_new ? $audit_log->data_new : "{}" !!}';
    if (isJson(data_new)) {
        data_new = JSON.stringify(JSON.parse(data_new), null, 3);
    }
    $('#json-new').html(data_new);

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
</script>