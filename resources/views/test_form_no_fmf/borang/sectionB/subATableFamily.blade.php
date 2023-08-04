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
        @if($allTestFamily->count() == 0)
            <tr >
                <td colspan="4" align="middle">No Data</td>
            </tr>
        @endif
        @foreach($allTestFamily as $testFamily)
            <tr>
                <td>{{$testFamily->name}}</td>
                <td>{{$testFamily->age}}</td>
                <td>{{$testFamily->gender}}</td>
                <td>
                    <a onclick="getModalContent(this)" data-action="{{route('testFormNoFMF.openFamilyFormModal',['testFormId' => $testForm->id,'testFamilyId'=>$testFamily->id])}}" class="btn btn-xs btn-default" >
                        <i class="fas fa-pencil text-warning"></i>
                    </a>
                </td>
            </tr>
        @endforeach
 </table>
