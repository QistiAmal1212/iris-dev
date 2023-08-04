<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body px-3">
                <ul class="nav nav-pills nav-justified pt-2" role="tablist">
                    @foreach ($allOfReport as $eachReport)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $loop->iteration == 1 ? 'active' : '' }}" id="weekDeclaration{{ $eachReport->week }}tab" data-bs-toggle="tab" href="#weekDeclaration{{ $eachReport->week }}" role="tab" aria-controls="weekDeclaration{{ $eachReport->week }}" aria-selected="true">
                            @if ($eachReport->week == 0)
                            Monthly<br>
                            {{ $eachReport->start_date->format('M') }} {{ $eachReport->end_date->format('Y') }}
                            @else
                            Week {{ $eachReport->week }}<br>
                            ( {{ $eachReport->start_date->format('d/m') }} -
                            {{ $eachReport->end_date->format('d/m') }} )
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach ($allOfReport as $eachReport)
                    <div class="tab-pane fade show {{ $loop->iteration == 1 ? 'active' : '' }}" id="weekDeclaration{{ $eachReport->week }}" role="tabpanel" aria-labelledby="weekDeclaration{{ $eachReport->week }}tab">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="deklarasiForm_{{ $eachReport->id }}" action="{{ route('report_helpdesk.updateDeclaration') }}" method="POST">
                                    @csrf
                                    <input type="text" id="report_helpdesk_id" name="report_helpdesk_id" value="{{ $eachReport->id ?? null }}" hidden>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 mb-1">
                                                        <b>DISEDIAKAN OLEH (PIHAK UNIJAYA)</b>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="signature_penyedia">Tandatangan <span style="color:red;">*</span></label>
                                                            <span data-toggle="tooltip" data-placement="top" title="PNG sahaja">
                                                                <i class="fas fa-circle-info text-primary "></i>
                                                            </span>
                                                            <div class="input-group">
                                                                <input type="file" class="dropify" id="signature_penyedia" name="signature_penyedia" data-height="150" data-allowed-file-extensions="png" data-default-file="{{ $eachReport ? ($eachReport->uploadedFiles('signature_penyedia')->first() ? asset($eachReport->uploadedFiles('signature_penyedia')->first()->path) : '') : '' }}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="nama_penyedia">Nama <span style="color:red;">*</span></label>
                                                            <select id="nama_penyedia" name="nama_penyedia" class="form-control" required>
                                                                <option value="" hidden selected> Pilih Ahli Projek
                                                                </option>
                                                                @foreach ($allProjectMembers as $members)
                                                                <option value="{{ $members->user->name }}" {{ $eachReport->nama_penyedia == $members->user->name ? 'selected' : '' }}>
                                                                    {{ $members->user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label" for="jawatan_penyedia">Jawatan <span style="color:red;">*</span></label>
                                                            <select id="jawatan_penyedia" name="jawatan_penyedia" class="form-control" required>
                                                                <option value="" hidden selected> Pilih Jawatan</option>
                                                                @foreach ($MasterProjectRole as $role)
                                                                <option value="{{ $role->name }}" {{ $eachReport->jawatan_penyedia == $role->name ? 'selected' : '' }}>
                                                                    {{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label" for="tarikh_disediakan">Tarikh <span style="color:red;">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" id="tarikh_disediakan" name="tarikh_disediakan" class="form-control" required value="{{ $eachReport->tarikh_disediakan ? $eachReport->tarikh_disediakan->format('d/m/Y') : '' }}">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-12 d-flex">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 mb-1">
                                                        <b>DISAHKAN OLEH (PIHAK UNIJAYA)</b>
                                                    </div>
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="signature_pengesah">Tandatangan <span style="color:red;">*</span></label>
                                                            <span data-toggle="tooltip" data-placement="top" title="PNG sahaja">
                                                                <i class="fas fa-circle-info text-primary "></i>
                                                            </span>
                                                            <div class="input-group">
                                                                <input type="file" class="dropify" id="signature_pengesah" name="signature_pengesah" data-height="150" data-allowed-file-extensions="png" data-default-file="{{ $eachReport ? ($eachReport->uploadedFiles('signature_pengesah')->first() ? asset($eachReport->uploadedFiles('signature_pengesah')->first()->path) : '') : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-12">

                                                        <div class="form-group">
                                                            <label class="form-label" for="nama_pengesah">Nama <span style="color:red;">*</span></label>
                                                            <select id="nama_pengesah" name="nama_pengesah" class="form-control" required>
                                                                <option value="" hidden selected> Pilih Ahli Projek
                                                                </option>
                                                                @foreach ($allProjectMembers as $members)
                                                                <option value="{{ $members->user->name }}" {{ $eachReport->nama_pengesah == $members->user->name ? 'selected' : '' }}>
                                                                    {{ $members->user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label" for="jawatan_pengesah">Jawatan <span style="color:red;">*</span></label>
                                                            <select id="jawatan_pengesah" name="jawatan_pengesah" class="form-control" required>
                                                                <option value="" hidden selected> Pilih Jawatan</option>
                                                                @foreach ($MasterProjectRole as $role)
                                                                <option value="{{ $role->name }}" {{ $eachReport->jawatan_pengesah == $role->name ? 'selected' : '' }}>
                                                                    {{ $role->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="form-label" for="tarikh_disahkan">Tarikh <span style="color:red;">*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" id="tarikh_disahkan" name="tarikh_disahkan" class="form-control" required value="{{ $eachReport->tarikh_disahkan ? $eachReport->tarikh_disahkan->format('d/m/Y') : '' }}">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end align-items-center my-1">
                                        <button type="submit" class="btn btn-success float-right me-2">
                                            <i class="fa-solid fa-floppy-disk"></i> {{ __('msg.save') }}
                                        </button>
                                        <button type="button" onclick="generatePDF(this)" data-report-helpdesk-id="{{ $eachReport->id }}" class="btn btn-primary float-right mr-2" data-toggle="tooltip" data-title="{{ $eachReport->week == 0 ? 'Monthly' : 'Weekly' }}">
                                            <i class="fa-solid fa-file-pdf"></i> Preview Report
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
