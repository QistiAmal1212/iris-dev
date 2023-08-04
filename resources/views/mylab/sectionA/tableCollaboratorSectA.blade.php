<div class="table-responsive">
    <table class="table table-hover required-table">
        <thead>
            <th class="font-weight-bold" width="3%"> Bil. </th>
            <th class="font-weight-bold" width="50%"> E </th>
            <th class="font-weight-bold"> F </th>
            <th class="font-weight-bold" width="3%"><i class="fa fa-chevron-down" aria-hidden="true"></i> </th>
            <th class="font-weight-bold" width="3%"><i class="fa fa-chevron-down" aria-hidden="true"></i> </th>
        </thead>
        <tbody>
            @foreach ($mylab_application->mylabUniversityIndustries as $mylabUniversityIndustri)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $mylabUniversityIndustri->university_name_addrs }} </td>
                    <td> {{ $mylabUniversityIndustri->industry_name_addrs }} </td>
                    <td>
                        <a onclick="getModalContent(this)"
                            data-action="{{ route('mylab.application.editseksyenA_A3', ['mylab_application' => $mylab_application, 'id' => $mylabUniversityIndustri->id]) }}"
                            class="btn btn-xs btn-default" title="">
                            <i class="fas fa-pencil text-warning"></i>
                        </a>
                    </td>
                    <td>
                        <form id="deleteseksyenA_A3"
                            action="{{ route('mylab.application.deleteseksyenA_A3', ['mylabUniversityIndustri' => $mylabUniversityIndustri]) }}"
                            method="POST"
                            data-refreshFunctionURL="{{ route('mylab.application.refreshseksyenA_A3', ['mylab_application' => $mylab_application]) }}"
                            data-refreshFunctionDivId="mylab_sectionA_tableCollaboratorSectA" data-reloadPage="false">
                            @csrf
                            <button id="deleteseksyenA_A3_delete_btn_{{ $mylabUniversityIndustri->id }}" type="button"
                                hidden onclick="generalFormSubmit(this);"></button>
                        </form>
                        <button type="button" class="btn btn-xs btn-default" title="Delete">
                            <i class="fas fa-trash text-danger"
                                onclick="$('#deleteseksyenA_A3_delete_btn_{{ $mylabUniversityIndustri->id }}').trigger('click');"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
