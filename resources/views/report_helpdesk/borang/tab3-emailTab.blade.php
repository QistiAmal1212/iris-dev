<div class="row">
    <div class="col-md-12">
        <div class="card bg-transparent border-dark">
            {{-- <div class="card-header">
                <label for="email_to_{{$eachReport->id}}">TO <span style="color:red;">*</span></label>
            </div> --}}
            <div class="card-body">
                <div id="chips_to_{{$eachReport->id}}">
                    <label for="email_to_{{$eachReport->id}}">TO <span style="color:red;">*</span></label>
                    @foreach ($eachReport->email as $eachEmail )
                        @if($eachEmail)
                            @foreach ($eachEmail->emailRecipientTo as $eachRecipient )
                                <button type="button" class="btn round btn-gradient-primary waves-effect btn-sm badge-glow">
                                    {{$eachRecipient->email}}
                                    <i class="fa-solid fa-delete-left" onclick="chipClickHandler({{$eachRecipient->id}},{{$eachReport->id}})"></i>
                                </button>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="input-group mt-1" id="form-field-to_{{$eachReport->id}}">
                    <input id="email_to_{{$eachReport->id}}" name="email_to_{{$eachReport->id}}" class="form-control chip-input"
                        data-entity-id="{{$eachReport->id}}" data-entity-type="{{class_basename($eachReport)}}" data-email-type="TO"
                        placeholder="Enter email and type enter" autocomplete="off" autofocus />
                        <button id="add_email" class="btn btn-outline-primary waves-effect" onclick="addEmail({{$eachReport->id}});" type="button">Add</button>
                </div>
            </div>
        </div>

        <div class="card bg-transparent border-dark">
            {{-- <div class="card-header">
                <label for="email_cc_{{$eachReport->id}}">CC <span style="color:red;">*</span></label>
            </div> --}}
            <div class="card-body">
                <div id="chips_cc_{{$eachReport->id}}">
                    <label for="email_cc_{{$eachReport->id}}">CC <span style="color:red;">*</span></label>
                    @foreach ($eachReport->email as $eachEmail )
                        @if($eachEmail)
                            @foreach ($eachEmail->emailRecipientCc as $eachRecipient )
                            <button type="button" class="btn round btn-gradient-primary waves-effect btn-sm badge-glow">
                                {{$eachRecipient->email}}
                                <i class="fa-solid fa-delete-left" onclick="chipClickHandler({{$eachRecipient->id}},{{$eachReport->id}})"></i>
                            </button>
                            @endforeach
                        @endif
                    @endforeach
                </div>
                <div class="input-group mt-1" id="form-field-cc_{{$eachReport->id}}">
                    <input id="email_cc_{{$eachReport->id}}" name="email_cc_{{$eachReport->id}}" class="form-control chip-input"
                    data-entity-id="{{$eachReport->id}}" data-entity-type="{{class_basename($eachReport)}}" data-email-type="CC"
                    placeholder="Enter email and type enter" autocomplete="off" autofocus />
                        <button id="add_email" class="btn btn-outline-primary waves-effect" onclick="addEmail({{$eachReport->id}},'cc');" type="button">Add</button>
                </div>
            </div>
        </div>

        <div class="card bg-transparent border-dark">
            {{-- <div class="card-header">
                <label for="email_bcc_{{$eachReport->id}}">BCC <span style="color:red;">*</span></label>
            </div> --}}
            <div class="card-body">
                <div id="chips_bcc_{{$eachReport->id}}">
                    <label for="email_bcc_{{$eachReport->id}}">BCC <span style="color:red;">*</span></label>
                    @foreach ($eachReport->email as $eachEmail )
                        @if($eachEmail)
                            @foreach ($eachEmail->emailRecipientBcc as $eachRecipient )
                            <button type="button" class="btn round btn-gradient-primary waves-effect btn-sm badge-glow">
                                {{$eachRecipient->email}}
                                <i class="fa-solid fa-delete-left" onclick="chipClickHandler({{$eachRecipient->id}},{{$eachReport->id}})"></i>
                            </button>
                            @endforeach
                        @endif
                    @endforeach
                </div>
                <div class="input-group mt-1" id="form-field-bcc_{{$eachReport->id}}">
                    <input id="email_bcc_{{$eachReport->id}}" name="email_bcc_{{$eachReport->id}}" class="form-control chip-input"
                        data-entity-id="{{$eachReport->id}}" data-entity-type="{{class_basename($eachReport)}}" data-email-type="BCC"
                        placeholder="Enter email and type enter" autocomplete="off" autofocus
                    />
                    <button id="add_email" class="btn btn-outline-primary waves-effect" onclick="addEmail({{$eachReport->id}},'bcc');" type="button">Add</button>
                </div>
            </div>
        </div>

        <div class="card bg-transparent border-dark">
            <div class="card-body">
                <label for="attachment">Attachment
                    <span style="color:red;"> * </span>
                    <span data-toggle="tooltip" data-placement="top" title="DOCX atau PDF sahaja">
                        <i class="fas fa-circle-info text-primary "></i>
                    </span>
                </label>
                <div class="row mt-1">
                    <div class="col-md-6 col-12">
                        <div class="btn-group btn-group-sm col-12" role="group" aria-label="Button Image">
                            <button type="button" class="form-control btn btn-outline-primary  btn-sm waves-effect" onclick="generatePDF(this)" data-report-helpdesk-id="{{ $eachReport->id }}" >
                                <i class="fas fa-eye"></i> Preview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="submit" onclick="sendEmail(this)" data-report-helpdesk-id="{{$eachReport->id}}" class="btn btn-success">Send Email
                @if ($eachReport->week == 0)
                Monthly
                @else
                Week {{$eachReport->week}}
                @endif
            </button>
        </div>
        <div class="d-flex justify-content-end align-items-center my-1">
            <div class="col-12">

            </div>
        </div>
    </div>
</div>
