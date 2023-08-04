<div class="card-header bg-transparent">
    <h4 class="card-title w-100">Edit Faq</h4>
</div>
<div class="row" style="width: 100%;">
    <div class="col-md-12">
        <form action="{{ route('faq.update', $faq->id) }}" method="POST" class="form-horizontal" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group row">
                <label for="inputQuestion" class="col-sm-2 col-form-label">Question <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                    <input type="text" name="question" class="form-control" id="inputQuestion" placeholder="Question" value="{{ $faq->question }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputAnswer" class="col-sm-2 col-form-label">Answer <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                    <input type="text" name="answer" class="form-control" id="inputAnswer" placeholder="Answer" value="{{ $faq->answer }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputFaqType" class="col-sm-2 col-form-label">Faq Type <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                    <select name="faq_type_id" class="custom-select rounded-0 text" id="inputFaqType" required>
                        <option value="">Please Select</option>
                        @foreach ($MasterFaqType as $faqType)
                            <option value="{{ $faqType->id }}" {{ $faqType->id == $faq->faq_type_id ? 'selected' : '' }}>{{ $faqType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputLocale" class="col-sm-2 col-form-label">Locale <b class="text-danger">*</b></label>
                <div class="col-sm-10">
                    <select name="lang" class="custom-select rounded-0 text" id="inputLocale" required>
                        <option value="">Please Select</option>
                        @foreach ($FaqLang as $lang)
                            <option value="{{ $lang }}" {{ $lang == $faq->lang ? 'selected' : '' }}>{{ strtoupper($lang) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>