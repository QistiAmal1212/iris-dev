<table class="table header_uppercase table-bordered table-responsive">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date Start</th>
            <th>Date End</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($announcements as $announcement)
        <tr>
            <th>{{ (($announcements->currentPage() - 1) * $announcements->perPage()) + $loop->iteration }}</th>
            <td>{{ $announcement->title }}</td>
            <td>{{ $announcement->description }}</td>
            <td>{{ $announcement->date_start }}</td>
            <td>{{ $announcement->date_end }}</td>
            <td>
                <div class="btn-group" announcement="group" aria-label="announcement Action">
                    @can('admin.announcement.view')
                        <a href="{{ route('announcement.show', $announcement) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-eye"></i> </a>
                    @endcan

                    @can('admin.announcement.update')
                        <a href="{{ route('announcement.edit', $announcement->id) }}" class="btn btn-outline-dark waves-effect" onclick="viewannouncementForm('{{$announcement->id}}')"> <i class="fas fa-edit"></i> </a>
                    @endcan

                    @can('admin.announcement.delete')
                        <a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyannouncement_{{ $announcement->id }}').submit();"> <i class="fas fa-trash"></i> </a>
                        <form id="formDestroyannouncement_{{ $announcement->id }}" method="POST" action="{{ route('announcement.destroy', $announcement) }}">
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
