<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <form class="configForm2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class=""> {{ __('msg.sys.maintenancemode') }} <span
                                        style="color:red;">*</span></label>
                                <div class="pt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio1">
                                        <label class="form-check-label">{{ __('msg.sys.active') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="radio1" checked>
                                        <label class="form-check-label">{{ __('msg.sys.inactive') }}</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <strong>Makluman:</strong>
                        Apabila mod penyelenggaraan diaktifkan, paparan "Sistem sedang diselenggara" akan
                        dipaparkan kepada pengguna luar.
                        Akses kepada log masuk juga akan ditutup kepada semua pengguna (selain
                        Pentadbir/Administrator).
                    </div>

                    <div class="card-footer ">
                        <button type="submit" class="btn btn-primary float-right">{{ __('msg.submit') }}</button>
                    </div>
				</div>
            </form>
        </div>
    </div>
</div>
