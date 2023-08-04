@php
    $read_only = (in_array($role_id,[2])) ? false : true;
@endphp

@if (in_array($role_id,[1,2]))
<div class="alert alert-primary" role="alert">
    <div class="alert-body"><h3>Penyemak Form</h3></div>
</div>
    <div class="mb-1">
        <label for="exampleInputEmail1" class="form-label">Note</label>
        <textarea class="form-control" rows="3" id="note" name="note" {{ ($read_only) ? 'disabled' : '' }}>{{ ($read_only) ? 'Isi Dengan Lengkap' : '' }}</textarea>
    </div>
    <div class="mb-1">
        <label for="exampleInputPassword1" class="form-label">Date</label>
        <input type="text" class="form-control flatpickr" id="exampleInputPassword1" {{ ($read_only) ? 'readonly' : '' }} value="{{ ($read_only) ? '29/07/2022' : '' }}">
    </div>
@endif



@if (!$read_only)
    @if (in_array($role_id,[2]))
        {{-- <button type="button" class="btn btn-danger float-start" onclick="retrieveNextValue('{{$role_id}}','submit','{{$user_status}}')">Query</button> --}}
        <button type="submit" class="btn btn-primary float-end" onclick="retrieveNextValue('{{$role_id}}','approve','{{$user_status}}')">Submit</button>
    @endif
@endif

