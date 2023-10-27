<div class="modal fade" id="update_integration" tabindex="-1" aria-labelledby="update_integration" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="integration-title">Maklumat API Integrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('update.api', $api->id) }}" method="POST" id="apiUpdateForm" data-reloadPage="true">
            @csrf
            <div class="modal-body">
                <div class="row">
                    @if($api->url == 'api/pemohon/store')
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label fw-bolder">Url API</label>
                        <input type="text" class="form-control" name="url_api" id="url_api" value="{{ url('/').'/'.$api->url }}" readonly>
                    </div>
                    @else
                    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
                        <label class="form-label fw-bolder">Url API</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text" id="url_api">{{ url('/')."/api/pemohon/details/" }}</span>
                            <input type="text" class="form-control" id="url_api" name="url_api" value="{{ $api->nama_path }}"/>
                        </div>
                    </div>
                    @endif

                    <div class="col-sm-10 col-md-10 col-lg-10 mb-1">
                        <label class="form-label fw-bolder">Nama API</label>
                        <input type="text" class="form-control" name="nama_api" id="nama_api" value="{{ $api->nama }}">
                    </div>

                    <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
                        <label class="form-label fw-bolder">Status API</label>
                        <div class="mt-0">
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="status_api" value="1" name="status_api" @if($api->status) checked @endif />
                            </div>
                        </div>
                    </div>
                </div>
                @if($api->url != 'api/pemohon/store')
                <hr>
                <label class="form-label fw-bolder">Table API</label>
                <br>
                <div class="row">
                    @foreach($tableApi as $table)
                    @if($table->id != 4 && $table->id != 14 && $table->id != 20)
                    <div class="col-sm-3 col-md-3 col-lg-3 mb-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="table_api{{ $table->id }}" name="table_api[]" value="{{ $table->id }}" @if(in_array($table->id, $aksesApi)) checked @endif>
                            <label class="form-check-label" for="table_api{{ $table->id }}">{{ $table->nama }}</label>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end align-items-center">
                    
                    <button type="button" id="btn_update" hidden onclick="generalFormSubmit(this);"></button>
                    <button type="button" class="btn btn-success float-right" id="btn_update_fake" onclick="$('#btn_update').trigger('click');">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#update_integration').modal('show');
</script>