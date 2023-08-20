@if(count($securityMenu) > 0)
<table class="table header_uppercase table-bordered table-responsive" id="table-one">
    <thead>
        <tr>
            <th>Bil</th>
            <th>Modul/Menu</th>
            <th>Level</th>
            <th>Turutan</th>
            <th>Capaian</th>
            <th>Cari</th>
            <th>Tambah</th>
            <th>Kemaskini</th>
            <th>Hapus</th>
            <th>Laporan</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 1;
        @endphp
        @foreach($securityMenu as $menu)
        <tr>
            <td align="center">{{ $i }}</td>
            <td>{{ $menu->name }}</td>
            <td align="center">{{ $menu->level }}</td>
            <td align="center">{{ $menu->sequence }}</td>
            <td align="center"><input type="checkbox" class="form-check-input" name="access[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->access) checked @endif></td>
            <td align="center"><input type="checkbox" class="form-check-input" name="search[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->search) checked @endif></td>
            <td align="center"><input type="checkbox" class="form-check-input" name="add[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->add) checked @endif></td>
            <td align="center"><input type="checkbox" class="form-check-input" name="update[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->update) checked @endif></td>
            <td align="center"><input type="checkbox" class="form-check-input" name="delete[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->delete) checked @endif></td>
            <td align="center"><input type="checkbox" class="form-check-input" name="report[]" value="{{ $menu->id }}" @if($menu->role != null && $menu->role->pivot->report) checked @endif></td>
        </tr>
        @php
        $i++;
        @endphp
        @endforeach
    </tbody>
</table>
@endif