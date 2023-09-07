@extends('layouts.app')

@section('header')
    Kursus Matrikulasi
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Kursus Matrikulasi</a>
    </li>
@endsection

@section('content')
<style>
    #table-matriculation-course thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-matriculation-course tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-matriculation-course {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Kursus Matrikulasi</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="matriculationCourseForm()">
            <i class="fa-solid fa-add"></i> Tambah Kursus Matrikulasi
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-matriculation-course">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Kursus Matrikulasi</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.matriculationCourseForm')

@endsection

@section('script')
<script>

    var table = $('#table-matriculation-course').DataTable({
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

    matriculationCourseForm = function(id = null){
        var matriculationCourseFormModal;
        matriculationCourseFormModal = new bootstrap.Modal(document.getElementById('matriculationCourseFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#matriculationCourseForm').attr('action', '{{ route("admin.reference.matriculation-course.store") }}');
            $('#matriculationCourseForm input[name="code"]').val("");
            $('#matriculationCourseForm input[name="name"]').val("");

            $('#title-role').html('Tambah Kursus Matrikulasi');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            matriculationCourseFormModal.show();
        }else{
            url = "{{ route('admin.reference.matriculation-course.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    matriculation_course_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.matriculation-course.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', matriculation_course_id);

                    $('#matriculationCourseForm').attr('action',url2 );
                    $('#matriculationCourseForm input[name="code"]').val(data.detail.code);
                    $('#matriculationCourseForm input[name="name"]').val(data.detail.name);

                    $('#matriculationCourseForm input[name="code"]').prop('readonly', true);

                        $('#matriculationCourseForm input[name="code"]').css({
                            'background-color': '#f0f0f0',
                            'color': '#666',
                            'border': '1px solid #ccc',
                            'cursor': 'not-allowed'
                        });

                    $('#title-role').html('Kemaskini Kursus Matrikulasi');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    matriculationCourseFormModal.show();
                },
            });
        }
    };

</script>
@endsection
