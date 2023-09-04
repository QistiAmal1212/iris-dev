<ul class="timeline mt-2">
    {{-- This is where looping started if needed --}}
    @foreach($candidateTimeline as $timeline)
    <li class="timeline-item">
        <span class="timeline-point timeline-point-indicator"></span>
        <div class="timeline-event">
            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                <h6>{{ $timeline->details }}</h6> {{-- Timeline Activity --}}
                <span class="timeline-event-time"  data-target="tooltip" title="{{ $timeline->created_at->format('d-m-Y H:i:s') }}">{{ $timeline->created_at->diffForHumans() }}</span> {{-- Timeline Time --}}
            </div>
            <p>Created by: <strong> {{ $timeline->created_user->name }} </strong></p>
        </div>
    </li>
    @endforeach
    {{-- End of looping --}}
</ul>