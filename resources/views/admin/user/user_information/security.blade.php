<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tukar Kata Laluan</h4>
    </div>
    <hr>
    <form method="POST" action="{{ route('updatePassword') }}" refreshFunctionDivId="divChangePassword"
        data-refreshFunctionNameIfSuccess="resetInput" data-refreshFunctionName="resetOnlyCaptcha"
        data-swal="Kata laluan berjaya dikemaskini.">
        @csrf

        <div class="card-body" id="divChangePassword">
            <div class="alert alert-warning mb-2" role="alert">
                <h6 class="alert-heading">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    Pastikan keperluan ini dipenuhi:
                </h6>
                <div class="alert-body fw-normal">
                    Minimum panjang kata laluan adalah 12 huruf, kombinasi antara huruf besar dan kecil, karakter & nombor.
                </div>
            </div>

            <table class="table" width="100%">
                <tr>
                    <td class="fw-bolder">Kata Laluan Semasa: </td>
                    <td>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control" name="reset_password_old" id="reset_password_old" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="fw-bolder">Kata Laluan Baru: </td>
                    <td>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control" name="reset_password_new" id="reset_password_new" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="fw-bolder">Sahkan Kata Laluan: </td>
                    <td>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control" name="reset_password_confirm" id="reset_password_confirm" placeholder="············">
                            <span class="input-group-text cursor-pointer">
                                <i data-feather="eye"></i>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="fw-bolder">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                        </div>
                    </td>
                    <td>
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Masukkan Captcha">
                            <span class="input-group-text cursor-pointer" data-toggle="tooltip" title="Set Semula Captcha" id="reload_captcha">
                                <i data-feather="refresh-cw"></i>
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="button" class="btn btn-success" onclick="generalFormSubmit(this);" id="change_password_button" hidden></button>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" onclick="$('#change_password_button').trigger('click');">
                    <span class="align-middle d-sm-inline-block d-none">
                        Kemaskini Kata Laluan
                    </span>
                </button>
            </div>
        </div>
    </form>
</div>

@section('script')
<script>
    $('#reload_captcha').click(function() {
        $.ajax({
            method : "GET",
            url : "{{ route('reload.captcha') }}",
            success:function(data){
                $(".captcha span").html(data.captcha)
            }
        });
    });

    function resetInput() {
        var reset_password_old = document.getElementById('reset_password_old');
        var reset_password_new = document.getElementById('reset_password_new')
        var reset_password_confirm = document.getElementById('reset_password_confirm');
        var captcha = document.getElementById('captcha');

        reset_password_old.value = '';
        reset_password_new.value = '';
        reset_password_confirm.value = '';
        captcha.value = '';

        $.ajax({
            method : "GET",
            url : "{{ route('reload.captcha') }}",
            success:function(data){
                $(".captcha span").html(data.captcha)
            }
        });
    }

    function resetOnlyCaptcha() {
        var captcha = document.getElementById('captcha');
        captcha.value = '';

        $.ajax({
            method : "GET",
            url : "{{ route('reload.captcha') }}",
            success:function(data){
                $(".captcha span").html(data.captcha)
            }
        });
    }

</script>
@endsection
