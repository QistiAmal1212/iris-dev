@if ($total_pages > 1)
    <div class="btn-group mb-1" style="float: right;">
        <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Page {{$currentPage}}
        </button>
        <ul class="dropdown-menu overflow-auto" style="height: 300px;float: right;">
            @for($i=1; $i <= $total_pages; $i++)
                <li>
                    <a class="dropdown-item" onclick="updatePage({{$i}},{{$total_pages}})">{{$i}}</a>
                </li>
            @endfor
        </ul>
    </div>
@endif

<table class="table header_uppercase table-bordered" id="table-carian">
    <thead>
        <tr>
            <th>#</th>
            <th width="35%">No Kad Pengenalan Baru</th>
            <th width="55%">Nama Penuh</th>
            <th>Lihat Maklumat</th>
        </tr>
    </thead>

    <tbody>
        @foreach($candidate as $key => $user)
            <?php
                if(!isset($user->no_kp_baru)) {
                    continue;
                }
                $index = $key+1;
                if ($currentPage > 1)
                    $index = $index + ($currentPage*10);
            ?>
            <tr>
                <td>{{$index}}</td>
                <td>{{ $user->no_kp_baru }}</td>
                <td>{{ $user->nama_penuh }}</td>
                <td>
                    <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">
                        <a class='btn btn-xs btn-default' onclick="searchCandidate('{{$user->no_kp_baru}}')">
                            <i class="fas fa-pencil text-primary"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if ($total_pages > 1)
    <nav aria-label="Page navigation example mt-1">
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a class="page-link" onclick="updatePage({{ $previousPage }}, {{$total_pages}})">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" onclick="updatePage({{ $nextPage }}, {{$total_pages}})">Next</a>
            </li>
        </ul>
    </nav>
@endif