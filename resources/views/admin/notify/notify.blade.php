<div class="card-header bg-transparent">
    <h4 class="card-title w-100">Send Notification</h4>
</div>
<div class="row" style="width: 100%;">
    <div class="col-md-12">
        <form id="shootNotify" action="{{ route('notify.send', $notify->id) }}" method="POST" class="form-horizontal" autocomplete="off">
            @csrf
            <div class="form-group row">
                <label for="inputUser" class="col-sm-2 col-form-label">Select Target User <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                    <select name="user_id" class="select2 p-0" id="inputUser" data-placeholder="Please Select" style="width: 100%" required>
                        <option value="">Please Select</option>
                        @foreach ($Users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="button" class="btn btn-success float-right" onclick="shootNotify('#shootNotify')">Notify <i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$('.select2').select2();
</script>