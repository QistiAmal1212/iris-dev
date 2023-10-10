@extends('layouts.app')

@section('header')
    Kementerian
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Kementerian</a>
    </li>
@endsection

@section('content')
<style>
    #table-department-ministry thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-department-ministry tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-department-ministry {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

    input[readonly] {
            pointer-events: none;
            /* Disable pointer events */
            background-color: #f0f0f0;
            /* Change background color */
            color: #666;
            /* Change text color */
            border: 1px solid #ccc;
            /* Change border color */
        }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Kementerian</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="departmentMinistryForm()">
            <i class="fa-solid fa-add"></i> Tambah Kementerian
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-department-ministry">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Nama Kementerian</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.departmentMinistryForm')

@endsection

@section('script')
<script>

    var table = $('#table-department-ministry').DataTable({
        orderCellsTop: true,
        colReorder: false,
        pageLength: 25,
        processing: true,
        serverSide: true, //enable if data is large (more than 50,000)
        ajax: {
            url: "{{ fullUrl() }}",
            cache: false,
        },
        columns: [
            {
                defaultContent: '',
                orderable: false,
                searchable: false,
                className : "text-center",
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: "kod",
                name: "kod",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "nama",
                name: "nama",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },

        ],
        language : {
            emptyTable : "Tiada data tersedia",
            info : "Menunjukkan _START_ hingga _END_ daripada _TOTAL_ entri",
            infoEmpty : "Menunjukkan 0 hingga 0 daripada 0 entri",
            infoFiltered : "(Ditapis dari _MAX_ entri)",
            search : "Cari:",
            zeroRecords : "Tiada rekod yang ditemui",
            paginate : {
                first : "Pertama",
                last : "Terakhir",
                next : "Seterusnya",
                previous : "Sebelumnya"
            },
            lengthMenu : "Lihat _MENU_ entri",
        }
    });

    departmentMinistryForm = function(id = null){
        var departmentMinistryFormModal;
        departmentMinistryFormModal = new bootstrap.Modal(document.getElementById('departmentMinistryFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#departmentMinistryForm').attr('action', '{{ route("admin.reference.department-ministry.store") }}');
            $('#departmentMinistryForm input[name="code"]').val("");
            $('#departmentMinistryForm input[name="name"]').val("");
            $('#departmentMinistryForm input[name="kem_kod"]').val("");
            $('#departmentMinistryForm input[name="gelaran_ketua"]').val("");
            $('#departmentMinistryForm input[name="alamat_1"]').val("");
            $('#departmentMinistryForm input[name="alamat_2"]').val("");
            $('#departmentMinistryForm input[name="alamat_3"]').val("");
            $('#departmentMinistryForm input[name="poskod"]').val("");
            $('#departmentMinistryForm input[name="bandar"]').val("");
            $('#departmentMinistryForm select[name="unit_urusan"]').val("").trigger('change');
            $('#departmentMinistryForm input[name="code"]').prop('readonly', false);

            $('#title-role').html('Tambah Kementerian');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            departmentMinistryFormModal.show();
        }else{
            url = "{{ route('admin.reference.department-ministry.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    department_ministry_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.department-ministry.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', department_ministry_id);

                    $('#departmentMinistryForm').attr('action',url2 );
                    $('#departmentMinistryForm input[name="code"]').val(data.detail.kod);
                    $('#departmentMinistryForm input[name="name"]').val(data.detail.nama);
                    $('#departmentMinistryForm input[name="kem_kod"]').val(data.detail.kem_kod);
                    $('#departmentMinistryForm input[name="gelaran_ketua"]').val(data.detail.gelaran_ketua);
                    $('#departmentMinistryForm input[name="alamat_1"]').val(data.detail.alamat_1);
                    $('#departmentMinistryForm input[name="alamat_2"]').val(data.detail.alamat_2);
                    $('#departmentMinistryForm input[name="alamat_3"]').val(data.detail.alamat_3);
                    $('#departmentMinistryForm input[name="poskod"]').val(data.detail.poskod);
                    $('#departmentMinistryForm input[name="bandar"]').val(data.detail.bandar);
                    $('#departmentMinistryForm select[name="unit_urusan"]').val(data.detail.unit_urusan).trigger('change');
                    $('#departmentMinistryForm input[name="code"]').prop('readonly', true);

                    $('#title-role').html('Kemaskini Kementerian');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    departmentMinistryFormModal.show();
                },
            });
        }
    };

    function toggleActive(departmentMinistryId) {
            var url = "{{ route('admin.reference.department-ministry.toggleActive', ':replaceThis') }}"
            url = url.replace(':replaceThis', departmentMinistryId);

            $.ajax({
                url: url,
                method: 'POST',
                success: function(data) {
                    if (data.success) {
                        // Toggle the button class and icon
                        var button = document.querySelector('[data-id="' + departmentMinistryId + '"]');
                        button.classList.toggle('activate');
                        button.classList.toggle('deactivate');

                        // Toggle the icon
                        var icon = button.querySelector('i');
                        if (icon.classList.contains('fa-toggle-on')) {
                            icon.classList.replace('fa-toggle-on', 'fa-toggle-off');
                            icon.classList.replace('text-success', 'text-danger');
                        } else {
                            icon.classList.replace('fa-toggle-off', 'fa-toggle-on');
                            icon.classList.replace('text-danger', 'text-success');
                        }
                    } else {
                        alert('Error toggling active state');
                    }
                },
                error: function(error) {
                    console.error('Error toggling active state:', error);
                }
            });
        }

</script>
@endsection
