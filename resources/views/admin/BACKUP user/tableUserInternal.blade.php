<table class="table header_uppercase table-bordered table-responsive" dt dt-btn dt-create-url="{{  route('user.create',["type" => $type]) }}" dt-create-name="{{ $type == "internal" ? __('msg.userinternalcreate') : __('msg.userexternalcreate')}}">
    <thead>
        <tr>
            <th class="font-weight-bold text-center" width="1%"> NO </th>
            <th class="font-weight-bold text-center"> NAME </th>
            <th class="font-weight-bold text-center"> EMAIL </th>
            <th class="font-weight-bold text-center" width="10%"> STATUS </th>
            <th class="font-weight-bold text-center" width="10%"> ACTION </th>
        </tr>
    </thead>
    <tbody>

        @if($users->count() == 0)
        <tr>
            <td colspan="5" class="text-center">No Data Available</td>
        </tr>
        @else
        @foreach($users as $user)
        <tr>
            <td>{{ (($users->currentPage() - 1) * $users->perPage()) + $loop->iteration }}</td>
            <td>{{ $user->name }}
                {{ $roles = $user->getRoleNames() }}
            </td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_active == 1 ? 'Active': 'Inactive'}}</td>
            <td>
                <div class="btn-group" role="group" aria-label="User Action">
                    @can('admin.user.view')
                        <a href="{{ route('user.show', $user) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-eye"></i> </a>
                    @endcan

                    @can('admin.user.update')
                        <a href="javascript:void(0);" class="btn btn-outline-dark waves-effect" onclick="viewUserForm('{{$user->id}}')"> <i class="fas fa-edit"></i> </a>
                    @endcan

                    @can('admin.user.delete')
                        <form id="formDestroyUser_{{ $user->id }}" method="POST" action="{{ route('user.destroy', $user) }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE"/>
                        </form>
                        <a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyUser_{{ $user->id }}').submit();"> <i class="fas fa-trash"></i> </a>
                    @endcan
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {!! $users->links() !!}
</div>
