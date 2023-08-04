@php
    $read_only = (in_array($role_id,[1])) ? false : true;
@endphp

@if (in_array($role_id,[1]))
<div class="alert alert-primary" role="alert">
    <div class="alert-body"><h3>Pengesah Form</h3></div>
</div>
    <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Note</label>
        <textarea class="form-control" rows="3" id="note" name="note" {{ ($read_only) ? 'disabled' : '' }}>{{ ($read_only) ? 'Semua Lengkap' : '' }}</textarea>
    </div>
    <div class="mb-1">
        <label for="exampleInputPassword1" class="form-label">Date</label>
        <input type="text" class="form-control flatpickr" id="exampleInputPassword1" {{ ($read_only) ? 'readonly' : '' }} value="{{ ($read_only) ? '31/07/2022' : '' }}">
    </div>
@endif



@if (!$read_only)
    @if (in_array($role_id,[1]))
        <button type="submit" class="btn btn-primary float-end" onclick="retrieveNextValue('{{$role_id}}','approve','{{$user_status}}')">Submit</button>
    @endif
@endif

