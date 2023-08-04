<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body px-3">
                <div class="d-flex flex-row">
                    <div class="col-7">
                        <div class="d-flex flex-row">
                            <div class="col-sm-2">
                                <label class="col-form-label" for="reportTitle">Tajuk Laporan</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="d-flex flex-row input-group">
                                    <input type="text" id="reportTitle" class="form-control" placeholder="First Name" name="reportTitle" value="{{ $reportHelpdesk->title ?? '' }}" required />
                                    <button class="input-group-text" onclick="saveTitle('update');" data-bs-toggle="tooltip" title="Save Title"><i class="fa fa-floppy-disk"></i>
                                    </button>
                                    <button class="input-group-text" onclick="saveTitle('revert');" data-vs-toggle="tooltip" title="Revert Original Title"><i class="fa fa-undo "></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 align-items-end">
                        <div class="form-group">
                            <div class="d-flex justify-content-end align-items-center">
                                <button id="updateAPIButton" onclick="RetrieveDataManualFromAPI('{{ $reportHelpdesk->project_id }}','{{ $reportHelpdesk->month }}','{{ $reportHelpdesk->year }}')" class="btn btn-success mr-3">
                                    UPDATE API
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subHeader extend">
                    <b>MAKLUMAT ISU</b>
                </div>
                <br>
                <form class="form" id="addIssueForm" action="{{ route('report_helpdesk.addIssue') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="text" id="issue_id" name="issue_id" hidden>
                    <input type="text" id="api_id" name="api_id" hidden>
                    <input type="text" id="report_helpdesk_id" name="report_helpdesk_id" value="{{ $reportHelpdesk->id ?? null }}" hidden>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="title"> Tajuk</label>
                                <select id="title" name="title" class="form-control" onchange="checkNote();retrieveDataFromAPI(this);">
                                    <option value="" hidden>Pilih Isu</option>
                                    @foreach ($api_issues as $api_issue)
                                    <option value="{{ $api_issue->id }}" data-isApi="true">
                                        ({{ $api_issue->issue_group }})
                                        {{ $api_issue->title }}</option>
                                    @endforeach
                                    <option value="OTHERS">(Lain-Lain)</option>
                                </select>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="otherTitle" id="otherTitle" style="display:none;" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" id="addNoteTitle" onclick="addValue()" style='display:none;' type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="master_medium_id">Mekanisma <span style="color:red;">*</span></label>
                                <select id="master_medium_id" name="master_medium_id" class="form-control" required>
                                    @foreach ($MasterMedium as $medium)
                                    <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="category">Kategori </label>
                                <select id="category" name="category" class="form-control">
                                    <option value="" hidden>Pilih Status</option>
                                    <option value="0">-</option>
                                    <option value="1">Isu Teknikal</option>
                                    <option value="2">Isu Bukan Teknikal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="status">Status <span style="color:red;">*</span></label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="" hidden>Pilih Status</option>

                                    @foreach ($issueStatusList as $issueStatus)
                                    <option value="{{ $issueStatus->id }}">{{ $issueStatus->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="tracking_id">ID </label>
                                <div class="input-group">
                                    <input type="text" id="tracking_id" name="tracking_id" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="nama_pengguna">Nama Pengguna <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="nama_pengguna" name="nama_pengguna" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="issue_group">Kumpulan Isu <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="issue_group" name="issue_group" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date_issued">Tarikh & Masa Isu Dilaporkan <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="date_issued" name="date_issued" class="form-control" required>
                                    <span class="input-group-text cursor-pointer"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date_response">Tarikh & Masa Isu Direspon </label>
                                <div class="input-group">
                                    <input type="text" id="date_response" name="date_response" class="form-control">
                                    <span class="input-group-text cursor-pointer"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="form-label" for="date_completed">Tarikh & Masa Isu Diselesaikan </label>
                                <div class="input-group">
                                    <input type="text" id="date_completed" name="date_completed" class="form-control">
                                    <span class="input-group-text cursor-pointer"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="explanation">Penerangan <span style="color:red;">*</span></label>
                                <textarea id="explanation" name="explanation" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="action">Tindakan </label>
                                <textarea id="action" name="action" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center my-1 ">
                        <a class="me-3" type="button" onclick="resetForm(this);updateButtonSaveName();" data-toggle="tooltip" title="Reset Form"><span style="color:#fff"> <i class="fas fa-undo text-danger"></i></span></a>
                        <button id="buttonSave" type="submit" class="btn btn-success">
                            <i class="fa-solid fa-floppy-disk"></i> {{ __('msg.save') }}
                        </button>
                    </div>
                </form>
                <div id="tableListIssueContainer">
                    @include('report_helpdesk.borang.tableListIssueTabs')
                </div>
            </div>
        </div>
    </div>
</div>
