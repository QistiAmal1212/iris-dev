
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr class="table-success">
                    <th width="5%">No</th>
                    <th>Question</th>
                    <th>Locale</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                @if(!count($faqs))
                <tr class="text-center">
                    <td colspan="4">No data yet</td>
                </tr>
                @endif

                @foreach($faqs as $faq)
                <tr>
                    <th>{{ (($faqs->currentPage() - 1) * $faqs->perPage()) + $loop->iteration }}</th>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->lang }}</td>
                    <td>
                        {{-- <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Role Action">
                            @can('admin.faq.view')
                                <a href="javascript:" class="btn btn-xs btn-outline-dark" data-toggle="modal" data-target="#viewModal" onclick="viewFaq('{{ route('faq.show', $faq->id) }}')">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan

                            @can('admin.faq.update')
                                <a href="javascript:" class="btn btn-xs btn-outline-info" data-toggle="modal" data-target="#editModal" onclick="editFaq('{{ route('faq.edit', $faq->id) }}')">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan

                            @can('admin.faq.delete')
                                <a href="javascript:" class="btn btn-xs btn-outline-danger" onclick="destroyFaq('#formDestroyFaq_{{ $faq->id }}')"> <i class="fa fa-trash"></i> </a>
                                <form id="formDestroyFaq_{{ $faq->id }}" method="POST" action="{{ route('faq.destroy', $faq) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                </form>
                            @endcan
                        </div> --}}
                        <div class="btn-group" faq="group" aria-label="faq Action">
                            @can('admin.faq.view')
                                <a href="" class="btn btn-outline-dark waves-effect"> <i class="fas fa-eye"></i> </a>
                            @endcan

                            @can('admin.faq.update')
                                <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-outline-dark waves-effect" onclick="viewannouncementForm('{{$faq->id}}')"> <i class="fas fa-edit"></i> </a>
                            @endcan

                            @can('admin.faq.delete')
                                <a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyfaq_{{ $faq->id }}').submit();"> <i class="fas fa-trash"></i> </a>
                                <form id="formDestroyfaq_{{ $faq->id }}" method="POST" action="">
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
            {!! $faqs->links() !!}
        </div>

