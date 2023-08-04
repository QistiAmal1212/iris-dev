@extends('layouts.app')

@section('header')
    <h2 class="customTitle1"> {{__('msg.faq')}}</span></h2>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item active"> {{__('msg.faq')}}</li>
@endsection

@section('content')
<div class="row mb-10">
    <div class="col-md-12">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div id="userFormDiv">
                    @include('admin.faq.faqForm')
                    {{-- <a href="{{ route('faq.create') }}" class="btn btn-block btn-sm btn-primary"> CREATE </a> --}}
                    <div class="card-header">
                        <h4 class="card-title">FAQ</h4>
                        @can('admin.announcement.create')
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="button" class="btn btn-success btn-sm float-right" onclick="viewannouncementForm()">
                                    <i class="fa-solid fa-add"></i> Add
                                </button>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div id="tableFaqDiv">
                        @include('admin.faq.tableFaq')
                    </div>
                    <div class="d-flex justify-content-end">
                        {!! $faqs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/><br/>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function(){
        // Swal.fire('Hello');
    });

    viewannouncementForm = function(id = null){

        var faqFormModal;
        faqFormModal = new bootstrap.Modal(document.getElementById('faqFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){

            $('#sub_title').html('Add Question');
            $('#faqFormModal form[name="faqForm"]').attr('action','{{route("faq.store")}}');
            $('#faqFormModal input[name="_method"]').attr('value','POST');
            $('#faqFormModal input[name="question"]').val("");
            $('#faqFormModal textarea[name="answer"]').val("");
            $('#faqFormModal select[name="faq_language"] option').each(function(){
                $(this).removeAttr('selected')
            });
            $('select[name="faq_language"]').trigger('change');
            $('#faqFormModal select[name="faq_type"] option').each(function(){
                $(this).removeAttr('selected')
            });
            $('select[name="faq_type"]').trigger('change');
            $('#faqFormModal #btnfaqAdd').html('{{__("msg.submit")}}');
            faqFormModal.show();
        }else{
            url = "{{route('faq.edit',':replaceThis')}}";
            url = url.replace(':replaceThis',id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    id_used = data.faq.id;
                    url2 = "{{route('faq.update',':replaceThis')}}"
                    url2 = url2.replace(':replaceThis',id_used);
                    $('#sub_title').html('Edit Question');
                    $('#faqFormModal form[name="faqForm"]').attr('action',url2 );
                    $('#faqFormModal input[name="_method"]').attr('value','PUT' );
                    $('#faqFormModal input[name="question"]').val(data.faq.question);
                    $('#faqFormModal textarea[name="answer"]').val(data.faq.answer);
                    $('#faqFormModal select[name="faq_language"] option').each(function(){
                        if(data.faq.lang == (this.value))
                            $(this).attr('selected','selected')
                        else
                            $(this).removeAttr('selected')
                    });
                    $('select[name="faq_language"]').trigger('change');
                    $('#faqFormModal select[name="faq_type"] option').each(function(){
                        if(data.faq.faq_type_id== parseInt(this.value))
                            $(this).attr('selected','selected')
                        else
                            $(this).removeAttr('selected')
                    });
                    $('select[name="faq_type"]').trigger('change');
                    $('#faqFormModal #btnRoleAdd').html('{{__("msg.update")}}');
                    faqFormModal.show();
                },
            });
        }
    };

    flatpickr("input[name=date_start]", {});
    flatpickr("input[name=date_end]", {});
</script>

@endsection
