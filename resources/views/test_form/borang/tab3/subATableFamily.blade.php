<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Action</th>
         </tr>
    </thead>
    <tbody>
        @php
           $allTestTable = App\Models\Reports\TestTable::all();
        @endphp
        @foreach($allTestTable as $value)
        <tr>
            <td>{{$value->name}}</td>
            <td>{{$value->age}}</td>
            <td>{{$value->gender}}</td>
            <td>
                <a onclick="getModalContent(this)" data-action="{{route('testForm.editFamilyModal',['testTableId'=>$value->id])}}" class="btn btn-xs btn-default" title="" >
                    <i class="fas fa-pencil text-warning"></i>
                </a>
            </td>
         </tr>
        @endforeach
 </table>
