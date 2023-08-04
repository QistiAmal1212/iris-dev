@extends('layouts.app')

@section('header')
{{__('msg.client')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a> {{__('msg.client')}} </a> </li>
@endsection

@section('content')
<style>
    .searchTitle {
        font-size: 1rem;
    }
</style>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-uppercase">{{__('msg.client')}}</h4>
                <a href="{{ route('client.create') }}" class="btn btn-primary float-right hovertext waves-effect waves-float waves-light"> CREATE </a>
            </div>
            <div class="card-body">

                <table class="table header_uppercase table-bordered table-responsive" dt dt-btn dt-create-url="{{ route('client.create') }}" dt-create-name="Create">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" width="1%">No</th>
                            <th class="font-weight-bold" >Name</th>
                            <th class="font-weight-bold" >Short Name</th>
                            <th class="font-weight-bold" width="10%" >ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ (($clients->currentPage() - 1) * $clients->perPage()) + $loop->iteration }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->name_short }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Action">
                                    @can('admin.client.view')
                                        <a href="{{ route('client.show', $client) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-eye"></i> </a>
                                    @endcan

                                    @can('admin.client.update')
                                        <a href="{{ route('client.edit', $client) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-edit"></i> </a>
                                    @endcan

                                    @can('admin.client.delete')
                                        <a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyClient_{{ $client->id }}').submit();"> <i class="fas fa-trash"></i> </a>
                                        <form id="formDestroyClient_{{ $client->id }}" method="POST" action="{{ route('client.destroy', $client) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE"/>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {!! $clients->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        // Swal.fire('Hello');
    });
</script>
@endsection
