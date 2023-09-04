<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Tindakan Tatatertib</th>
                <th>Tempoh Hukuman</th>
                <th>Tarikh Mula Hukuman</th>
                <th>Tarikh Akhir Hukuman</th>
            </tr>
        </thead>

        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach($candidatePenalty as $penalty)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $penalty->penalty->name }}</td>
                <td>{{ $penalty->duration." ".$penalty->type }}</td>
                <td>{{ $penalty->date_start }}</td>
                <td>{{ $penalty->date_end }}</td>
            </tr>
            @php
            $i++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>