@extends('layouts.app')

@section('header')
    Gred Gaji
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Gred Gaji</a>
    </li>
@endsection

@section('content')
<style>
    #table-salary-grade thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-salary-grade tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-salary-grade {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Gred Gaji</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="salaryGradeForm()">
            <i class="fa-solid fa-add"></i> Tambah Gred Gaji
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-salary-grade">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Gred Gaji</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.salaryGradeForm')

@endsection

@section('script')
<script>

    var table = $('#table-salary-grade').DataTable({
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
                data: "code",
                name: "code",
                className : "text-center",
                render: function(data, type, row) {
                    return $("<div/>").html(data).text();
                }
            },
            {
                data: "name",
                name: "name",
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

    salaryGradeForm = function(id = null){
        var salaryGradeFormModal;
        salaryGradeFormModal = new bootstrap.Modal(document.getElementById('salaryGradeFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#salaryGradeForm').attr('action', '{{ route("admin.reference.salary-grade.store") }}');
            $('#salaryGradeForm input[name="code"]').val("");
            $('#salaryGradeForm input[name="name"]').val("");

            $('#title-role').html('Tambah Gred Gaji');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            salaryGradeFormModal.show();
        }else{
            url = "{{ route('admin.reference.salary-grade.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    salary_grade_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.salary-grade.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', salary_grade_id);

                    $('#salaryGradeForm').attr('action',url2 );
                    $('#salaryGradeForm input[name="code"]').val(data.detail.code);
                    $('#salaryGradeForm input[name="name"]').val(data.detail.name);

                    $('#salaryGradeForm input[name="code"]').prop('readonly', true);

                        $('#salaryGradeForm input[name="code"]').css({
                            'background-color': '#f0f0f0',
                            'color': '#666',
                            'border': '1px solid #ccc',
                            'cursor': 'not-allowed'
                        });

                    $('#title-role').html('Kemaskini Gred Gaji');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    salaryGradeFormModal.show();
                },
            });
        }
    };

</script>
@endsection
