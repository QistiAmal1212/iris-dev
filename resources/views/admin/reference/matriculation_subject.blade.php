@extends('layouts.app')

@section('header')
    Subjek Matrikulasi
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Subjek Matrikulasi</a>
    </li>
@endsection

@section('content')
<style>
    #table-matriculation-subject thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-matriculation-subject tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-matriculation-subject {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Subjek Matrikulasi</h4>
        @if($accessAdd)
        <button type="button" class="btn btn-primary btn-md float-right" onclick="matriculationSubjectForm()">
            <i class="fa-solid fa-add"></i> Tambah Subjek Matrikulasi
        </button>
        @endif
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-matriculation-subject">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Kod</th>
                        <th>Subjek Matrikulasi</th>
                        <th width="10%">Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.reference.matriculationSubjectForm')

@endsection

@section('script')
<script>

    var table = $('#table-matriculation-subject').DataTable({
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

    matriculationSubjectForm = function(id = null){
        var matriculationSubjectFormModal;
        matriculationSubjectFormModal = new bootstrap.Modal(document.getElementById('matriculationSubjectFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#matriculationSubjectForm').attr('action', '{{ route("admin.reference.matriculation-subject.store") }}');
            $('#matriculationSubjectForm input[name="code"]').val("");
            $('#matriculationSubjectForm input[name="name"]').val("");
            $('#matriculationSubjectForm input[name="credit"]').val("");
            $('#matriculationSubjectForm input[name="semester"]').val("");

            $('#title-role').html('Tambah Subjek Matrikulasi');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            matriculationSubjectFormModal.show();
        }else{
            url = "{{ route('admin.reference.matriculation-subject.edit', ':replaceThis') }}"
            url = url.replace(':replaceThis', id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    matriculation_subject_id = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{ route('admin.reference.matriculation-subject.update',':replaceThis') }}"
                    url2 = url2.replace(':replaceThis', matriculation_subject_id);

                    $('#matriculationSubjectForm').attr('action',url2 );
                    $('#matriculationSubjectForm input[name="code"]').val(data.detail.code);
                    $('#matriculationSubjectForm input[name="name"]').val(data.detail.name);
                    $('#matriculationSubjectForm input[name="credit"]').val(data.detail.credit);
                    $('#matriculationSubjectForm input[name="semester"]').val(data.detail.semester);

                    $('#title-role').html('Kemaskini Subjek Matrikulasi');

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    matriculationSubjectFormModal.show();
                },
            });
        }
    };

</script>
@endsection
