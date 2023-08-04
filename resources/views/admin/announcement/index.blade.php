@extends('layouts.app')

@section('header')
{{__('msg.announcement')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a> {{__('msg.announcement')}}</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div id="userFormDiv">
                    @include('admin.announcement.announcementForm')
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Announcement  </h4>
                @can('admin.announcement.create')
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-success btn-sm float-right" onclick="viewannouncementForm()">
                            <i class="fa-solid fa-add"></i> Add
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div id="tableAnnouncement">
                    @include('admin.announcement.tableAnnouncement')
                </div>
                {{-- <div class="d-flex justify-content-end">
                    {!! $announcements->links() !!}
                </div> --}}
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

    viewannouncementForm = function(id = null){

        var announcementFormModal;
        announcementFormModal = new bootstrap.Modal(document.getElementById('announcementFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){

            $('#announcementFormModal form[name="announcementFormModal"]').attr('action','{{route("announcement.store")}}');
            $('#announcementFormModal input[name="_method"]').attr('value', 'POST');
            $('#announcementFormModal input[name="announcement_title"]').val("");
            $('#announcementFormModal textarea[name="announcement_description"]').val("");
            $('#announcementFormModal textarea[name="announcement_type_id"]').val("");
            $('#announcementFormModal input[name="date_start"]').val("");
            $('#announcementFormModal input[name="date_end"]').val("");
            $('#announcementFormModal option[value=default]').attr('selected','selected');
            $('#announcementFormModal input[name="announcement_target[]"]').each(function(){
                $(this).removeAttr('checked')
            });
            $('#sub_title').html('Add announcement');
            $('#announcementFormModal #btnannouncementAdd').html('{{__("msg.submit")}}');
            announcementFormModal.show();
        }else{
            url = "{{route('announcement.edit',':replaceThis')}}";
            url = url.replace(':replaceThis',id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    id_used = data.announcement.id;
                    url2 = "{{route('announcement.update',':replaceThis')}}"
                    url2 = url2.replace(':replaceThis',id_used);
                    // console.log(url2);

                    $('#announcementFormModal form[name="announcementFormModal"]').attr('action',url2 );
                    $('#announcementFormModal input[name="_method"]').attr('value','PUT' );
                    $('#announcementFormModal input[name="announcement_title"]').val(data.announcement.title);
                    $('#announcementFormModal textarea[name="announcement_description"]').val(data.announcement.description);
                    $('#announcementFormModal input[name="date_start"]').val(data.announcement.date_start);
                    $('#announcementFormModal input[name="date_end"]').val(data.announcement.date_end);
                    $('#announcementFormModal option[value='+data.MasterAnnouncementType.id+']').attr('selected','selected');
                    $('#sub_title').html('Edit Role');
                    $('#announcementFormModal select[name="announcement_target[]"] option').each(function(){
                    if(data.AnnouncementTarget.includes(parseInt(this.value)))
                        $(this).attr('selected','selected')
                    else
                        $(this).removeAttr('selected')
                    });
                    $('select[name="announcement_target[]"]').trigger('change');
                    $('#announcementFormModal #btnRoleAdd').html('{{__("msg.update")}}');
                    announcementFormModal.show();
                },
            });

        }
    };

    flatpickr("input[name=date_start]", {});
    flatpickr("input[name=date_end]", {});
</script>

@endsection
