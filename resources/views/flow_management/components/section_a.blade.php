@php
    $read_only = (in_array($role_id,[3])) ? false : true;
@endphp
<div class="alert alert-primary" role="alert">
    <div class="alert-body"><h3>Penguna Luar Form</h3></div>
</div>
<div class="mb-1">
    <label for="exampleInputEmail1" class="form-label">IC Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" {{ ($read_only) ? 'readonly value=975014520214' : '' }}>
    <div id="emailHelp" class="form-text">Please insert your ic number here</div>
</div>
<div class="mb-1">
    <label for="exampleInputPassword1" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="exampleInputPassword1" {{ ($read_only) ? 'readonly value=Mustaqim'  : '' }}>
</div>
<div class="mb-1 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" {{ ($read_only) ? 'disabled' : '' }}>
    <label class="form-check-label" for="exampleCheck1"></label>
</div>

@if (!$read_only)
    @if ($role_id == 3)
        <button type="button" class="btn btn-primary float-end" onclick="retrieveNextValue('{{$role_id}}','submit','{{$user_status}}')">Submit</button>
    @endif
@endif

