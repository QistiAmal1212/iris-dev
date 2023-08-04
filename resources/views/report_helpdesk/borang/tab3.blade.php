<style>
    .form-field {
        height: auto;
        min-height: 34px;
        border: 2px solid #737679;
        padding: 8px;
        margin: 8px;
        cursor: text;
        border-radius: 3px;

        box-shadow: 0 2px 6px rgba(25, 25, 25, 0.2);
    }

    .form-field .chips .chip {
        display: inline-block;
        width: auto;

        background-color: #0077b5;
        color: #fff;
        border-radius: 3px;
        margin: 2px;
        overflow: hidden;
    }

    .form-field .chips .chip {
        float: left;
    }

    .form-field .chips .chip .chip--button {
        padding: 8px;
        cursor: pointer;
        background-color: #004471;
        display: inline-block;
    }

    .form-field .chips .chip .chip--text {
        padding: 8px;
        cursor: no;
        display: inline-block;
        pointer-events: none
    }

    .form-field>input {
        padding: 15px;
        display: block;
        box-sizing: border-box;
        width: 100%;
        height: 34px;
        border: none;
        margin: 5px 0 0;
        display: inline-block;
        background-color: transparent;
    }

</style>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body px-3">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    @foreach ($allOfReport as $eachReport)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{$loop->iteration == 1 ? "active" : ""}}" id="weekEmail{{$eachReport->week}}tab" data-bs-toggle="tab" href="#weekEmail{{$eachReport->id}}" role="tab" aria-controls="weekEmail{{$eachReport->id}}" aria-selected="true">
                            @if ($eachReport->week == 0)
                            Monthly<br>
                            {{$eachReport->start_date->format('M')}} {{$eachReport->end_date->format('Y')}}
                            @else
                            Week {{$eachReport->week}}<br>
                            ( {{$eachReport->start_date->format('d/m')}} - {{$eachReport->end_date->format('d/m')}} )
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($allOfReport as $eachReport)
                    <div class="tab-pane fade show {{$loop->iteration == 1 ? "active" : ""}}" id="weekEmail{{$eachReport->id}}" role="tabpanel" aria-labelledby="weekEmail{{$eachReport->id}}tab">
                        @include('report_helpdesk.borang.tab3-emailTab')
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
