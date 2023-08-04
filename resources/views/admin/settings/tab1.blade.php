<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            {{-- <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div> --}}
            <form id="configForm" action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="system_name" class=""> {{ __('msg.webapp_name') }} <span style="color:red;">*</span> </label>
                                <input type="text" class="form-control" id="system_name" name="system_name" placeholder="" value="{{ $system_name }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="copyright" class=""> {{ __('msg.copyright') }} <span style="color:red;">*</span> </label>
                                <input type="text" class="form-control" id="copyright" name="copyright" placeholder="" value="{{ $copyright }}">
                            </div>
                        </div>

                        {{-- <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="emeladmin" class="">EMEL PENTADBIR SISTEM <span style="color:red;">*</span> </label>
                                <input type="email" class="form-control" id="emeladmin" placeholder="">
                            </div>
                        </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="logo_header" class=""> {{ __('msg.webapp_logo') }} <span style="color:red;">*</span></label>
                                <input id="logo_header" name="logo_header" type="file" class="dropify" data-default-file="{{ url($logo_header) }}" data-height="150" data-allowed-file-extensions="png" >
                            </div>
                        </div>
                        
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="favicon" class=""> {{ __('msg.webapp_favicon') }} <span style="color:red;">*</span></label>
                                <input id="favicon" name="favicon" type="file" class="dropify" data-default-file="{{ url($favicon) }}" data-height="150" data-allowed-file-extensions="png" >
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="background_login_page" class=""> {{ __('msg.webapp_bg') }} <span style="color:red;">*</span></label>
                                <input id="background_login_page" name="background_login_page" type="file" class="dropify" data-default-file="{{ url($background_login_page) }}" data-height="150" data-allowed-file-extensions="png jpeg jpg" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer ">
                    <button type="submit" class="btn btn-primary float-right">{{ __('msg.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
