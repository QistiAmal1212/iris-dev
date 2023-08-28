
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="#addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body px-sm-2 mx-50">
                <form id="menuForm" action="{{ route('admin.security.menu.store') }}" method="POST" data-reloadPage="true" name="menuForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="name" name="name" value="" class="form-control" placeholder="Menu Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="type">Jenis <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="type" id="type" required onchange="displayModule(this.value)">
                                        <option value="">Sila Pilih:-</option>
                                        <option value="Menu">Menu</option>
                                        <option value="Web">Web</option>
                                    </select>
                                </div>
                            </div>

                            <div id="div_module" style="display:none" class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="module">Modul <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="module" id="module">
                                        <option value="">Sila Pilih:-</option>
                                        @foreach($masterModule as $module)
                                        <option value="{{ $module->id}}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="level">Level <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="level" id="level" required onchange="displayLinkMenu(this.value)">
                                        <option value="">Sila Pilih:-</option>
                                        <option value="1">1</option>
                                        @if($menuLevel2 > 0)<option value="2">2</option>@endif
                                        @if($menuLevel3 > 0)<option value="3">3</option>@endif
                                    </select>
                                </div>
                            </div>

                            <div id="div_parent" style="display:none" class="col-md-6 col-12"></div>

                            <!-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="sequence">Turutan <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="sequence" name="sequence" class="form-control" placeholder="Turutan Menu" oninput="onlyNumberOnInputText(this)" value="1" disabled>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="level">Level <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="level" name="level" class="form-control" placeholder="Menu Level" oninput="onlyNumberOnInputText(this)" value="1" disabled>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                        <button type="button" id="btnCreateMenu" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUpdateFake" class="btn btn-primary" onclick="$('#btnCreateMenu').trigger('click');">{{__('msg.submit')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#menuModal').modal('show');

    function displayModule(type) {

        var div_module = document.getElementById('div_module');
        var module = document.getElementById('module');

        if(type == 'Web') {
            div_module.style.display = 'block';
            module.required = true;
        } else {
            div_module.style.display = 'none';
            module.required = false;
        }
    }

    function displayLinkMenu(level) {

        var div_parent = document.getElementById('div_parent');

        if(level != 1) {

            $.ajax({
                url: "{{ route('admin.security.menu.link') }}",
                method: "POST",
                async: true,
                data: {
                    level: level,
                },
                success: function(response) {
                    div_parent.style.display = 'block';
                    div_parent.innerHTML = response;
                },
                error: function(response) {
                    // toastr.error('failed');
                }
            });
        } else {
            div_parent.style.display = 'none';
            div_parent.innerHTML = '';
        }
    }
</script>
