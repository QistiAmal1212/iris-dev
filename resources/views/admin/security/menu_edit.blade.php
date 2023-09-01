
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="#editModal" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body px-sm-2 mx-50">
                <form id="menuForm" action="{{ route('admin.security.menu.update', $menuId) }}" method="POST" data-reloadPage="true" name="menuForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nama <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="name" name="name" value="{{ $menu->name }}" class="form-control" placeholder="Menu Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="type">Jenis <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="type" id="type" required onchange="displayModule(this.value)">
                                        <option value="">Sila Pilih:-</option>
                                        <option value="Menu" @if($menu->type == 'Menu') selected @endif>Menu</option>
                                        <option value="Web" @if($menu->type == 'Web') selected @endif>Web</option>
                                    </select>
                                </div>
                            </div>

                            <div id="div_module" class="col-md-6 col-12"
                            @if($menu->module_id != null && $menu->type == 'Web')
                            style="diplay:block"
                            @else
                            style="display:none" 
                            @endif
                            >
                                <div class="form-group">
                                    <label class="form-label" for="module">Modul <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="module" id="module">
                                        <option value="">Sila Pilih:-</option>
                                        @foreach($masterModule as $module)
                                        <option value="{{ $module->id}} "@if($menu->module_id == $module->id) selected @endif>{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="level">Level <span class="text text-danger">*</span> </label>
                                    <select class="form-control" name="level" id="level" required onchange="displayLinkMenu({{ $menu->id }}, this.value)">
                                        <option value="">Sila Pilih:-</option>
                                        <option value="1" @if($menu->level == 1) selected @endif>1</option>
                                        @if(count($menuLevel2) > 0)<option value="2" @if($menu->level == 2) selected @endif>2</option>@endif
                                        @if(count($menuLevel3) > 0)<option value="3" @if($menu->level == 3) selected @endif>3</option>@endif
                                    </select>
                                </div>
                            </div>

                            <div id="div_parent" 
                            class="col-md-6 col-12"
                            @if($menu->level != 1)
                            style="diplay:block"
                            @else
                            style="display:none" 
                            @endif
                            >
                                <div class="form-group">
                                    <label class="form-label" for="menu_link">Pautan Menu <span class="text text-danger">*</span></label>
                                    <select class="form-control" name="menu_link" id="menu_link" required>
                                        <option value="">Sila Pilih:-</option>
                                        @if($menu->level == 2)
                                        @php   
                                        $listMenu = $menuLevel2;
                                        @endphp
                                        @else if($menu->level == 3)
                                        @php   
                                        $listMenu = $menuLevel3;
                                        @endphp
                                        @endif
                                        @foreach($listMenu as $list)
                                        <option value="{{ $list->id }}" @if($menu->menu_link == $list->id) selected @endif>{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
                @if($accessUpdate)
                <button type="button" id="btnUpdateFake" class="btn btn-primary" onclick="$('#btnCreateMenu').trigger('click');">{{__('msg.submit')}}</button>
                @endif
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

    function displayLinkMenu(id, level) {

        var div_parent = document.getElementById('div_parent');

        if(level != 1) {

            $.ajax({
                url: "{{ route('admin.security.menu.link') }}",
                method: "POST",
                async: true,
                data: {
                    id : id,
                    level : level,
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
