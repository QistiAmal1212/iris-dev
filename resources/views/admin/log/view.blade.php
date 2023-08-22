<div class="modal fade" id="auditModal" tabindex="-1" aria-labelledby="#addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light-secondary">
                <h4 class="modal-title">Jejak Audit</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table" width="100%">
                        <tr>
                            <td class="fw-bolder" width="30%">Modul: </td>
                            <td>
                                {{ $audit_log->module->name }}
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-bolder" width="30%">Jenis Aktiviti: </td>
                            <td>
                                @if($audit_log->activity_type_id == 6)
                                    <span class="badge bg-danger">{{ $audit_log->activity_type->name_bi }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $audit_log->activity_type->name_bi }}</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-bolder" width="30%">Perincian Aktiviti: </td>
                            <td>
                                {{ $audit_log->description }}
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-bolder" width="30%">URL AKtiviti: </td>
                            <td>
                                {{ $audit_log->description }}
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-bolder" width="30%">Tarikh Data Dimasukkan: </td>
                            <td>
                                {{ date('d/m/Y H:i:s',strtotime($audit_log->created_at)) }}
                            </td>
                        </tr>

                        <tr>
                            <td class="fw-bolder" width="30%">Pengguna: </td>
                            <td>
                                {{ optional($audit_log->created_by)->name }}
                            </td>
                        </tr>
                    </table>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <label class="fw-bolder">Data Lama</label>
                        <pre class="px-1 py-1" id="json-old"></pre>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <label class="fw-bolder">Data Baru</label>
                        <pre class="px-1 py-1" id="json-new"></pre>
                    </div>
                </div>
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