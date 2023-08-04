{{-- Modal For View PDF --}}
 <div class="modal fade modal-primary" id="modal-viewPDF" tabindex="-1" role="dialog" aria-labelledby="addModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header ">
                <h4 class="modal-title" id="addModalTitle"> Helpdesk Report PDF Viewer<span class="bold"> </span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- change 1 to variable borang->id for example --}}
                <embed src="{{ route('report_helpdesk.viewPDF', [$id,0] ).'#view=FitH' }}" type="application/pdf" width="100%" height="100%">

            </div>
            <div class="modal-footer">
               
                <a target="_blank" href="{{ route('report_helpdesk.viewPDF', [$id, 1]).'#view=FitH' }}" class="btn btn-success btn-xs m-b-5" target="_blank"><i class="fas fa-print"></i> Print </a>

                <a target="_blank" href="{{ route('report_helpdesk.viewPDF', [$id, 2] ).'#view=FitH' }}" class="btn btn-success btn-xs m-b-5"><i class="fas fa-download"></i> Download PDF </a>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function(){
    $('#modal-viewPDF').modal('show');
})
</script>
