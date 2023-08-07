<div class="card">
    <div class="card-header">
        <h4 class="card-title">Change Password</h4>
    </div>
    <hr>

    <div class="card-body">
        <p class="text-danger text-center">
            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            Minimum 8 characters long, mixed with uppercase, lowercase, symbol and number.
        </p>
        <table class="table" width="100%">
            <tr>
                <td class="fw-bolder">New Password: </td>
                <td>
                    <input type="text" class="form-control" value="{{ $user->name }}">
                </td>
            </tr>

            <tr>
                <td class="fw-bolder">Confirm Password: </td>
                <td>
                    <input type="text" class="form-control" value="{{ $user->email }}">
                </td>
            </tr>
        </table>
    </div>

    <div class="card-footer">
        <div class="d-flex justify-content-center">
            <a href="javascript();" class="btn btn-primary me-1">
                Update Password
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">2-Step Verification</h4>
    </div>
    <hr>

    <div class="card-body">
        <table class="table" width="100%">
            <tr>
                <td class="fw-bolder">Through SMS (Phone Number): </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" required/>
                        <button class="btn btn-primary" type="button">
                            Verify
                        </button>
                    </div>
                </td>
            </tr>

            <tr class="text-center fw-bolder">
                <td colspan="2">
                    <h4>or</h4>
                </td>
            </tr>

            <tr>
                <td class="fw-bolder">Using Email: </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" required/>
                        <button class="btn btn-primary" type="button">
                            Verify
                        </button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
