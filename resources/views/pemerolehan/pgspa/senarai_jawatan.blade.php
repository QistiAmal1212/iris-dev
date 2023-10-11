@extends('layouts.app')

@section('header')
    Jawatan Kosong
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Jawatan Kosong</a>
    </li>
@endsection

@section('content')
<style>
    #table-pgspa thead th {
        vertical-align: middle;
        text-align: center;
    }

    #table-pgspa tbody {
        vertical-align: middle;
        /* text-align: center; */
    }

    #table-pgspa {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Jawatan Kosong di Kementerian</h4>
        <a href="{{ route('skim_baharu') }}">
            <button  type="button" class="btn btn-primary btn-md float-right">
                <i class="fa-solid fa-add"></i> Tambah Kekosongan
            </button>
        </a>
    </div>
    <hr>

    <div class="card-body" id="cardJawatanKosong">
        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <label class="fw-bolder"> Tahun </label>
                <select name="" id="" class="form-select select2">
                    <option value="" hidden>Tahun</option>
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($year = $currentYear; $year >= 2007; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                </select>

                <label class="fw-bolder mt-1"> Tarikh Permohonan </label>
                <input type="text" id="" name="" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD">
            </div>

            <div class="col-sm-8 col-md-8 col-lg-8">
                <label class="fw-bolder"> No. Perolehan </label>
                <input type="text" name="" id="" class="form-control mb-1" />

                <label class="fw-bolder"> Skim Perkhidmatan </label>
                <select name="" id="" class="form-select select2" multiple>
                    <option value="" hidden>Skim Perkhidmatan</option>
                        @foreach ($skims as $skim)
                            <option value="{{ $skim->kod }}">{{ $skim->diskripsi }}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end align-items-center my-1 ">

            <a class="me-3" type="button" id="reset" href="#">
                <span class="text-danger"> Set Semula </span>
            </a>

            <button type="submit" class="btn btn-success float-right">
                <i class="fa fa-search"></i> Cari
            </button>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="table-pgspa">
                <thead>
                    <tr>
                        <th width="2%">No.</th>
                        <th width="10%">Tahun</th>
                        <th width="15%">No. Perolehan</th>
                        <th>Skim Perkhidmatan</th>
                        <th width="10%">Bilangan Kekosongan Dipohon</th>
                        <th width="10%">Tarikh Permohonan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
{{-- <script>

    var table = $('#table-pgspa').DataTable({
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
</script> --}}
@endsection
