@if ($total_pages > 1)
<div class="btn-group" style="float: right;">
  <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Page {{$currentPage}}
  </button>
  <ul class="dropdown-menu overflow-auto" style="height: 300px;float: right;">
  	@for($i=1; $i <= $total_pages; $i++)
    	<li><a class="dropdown-item" onclick="updatePage({{$i}},{{$total_pages}})">{{$i}}</a></li>
   	@endfor
  </ul>
</div>
@endif
<br>
<br>
<br>
<table class="table header_uppercase table-bordered" id="table-carian">
<thead>
<tr>
	<th width="10%">#</th>
	<th>No Kad Pengenalan</th>
	<th width="55%">Nama Penuh</th>
	<th width="15%">Lihat Maklumat</th>
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
	<td>{{ $user->no_kp_baru }}<br>{{$user->no_kp_lama}}</td>
	<td>{{ $user->nama_penuh }}</td>
	<td><div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action"><a class='btn btn-xs btn-default' onclick="searchCandidate('{{$user->no_kp_baru}}')"> <i class="fas fa-pencil text-primary"></i></div> </td>
</tr>
@endforeach
</tbody>
</table>
@if ($total_pages > 1)
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" onclick="updatePage({{ $previousPage }}, {{$total_pages}})">Previous</a>
    </li>
    <li class="page-item">
      <a class="page-link" onclick="updatePage({{ $nextPage }}, {{$total_pages}})">Next</a>
    </li>
  </ul>
</nav>
@endif