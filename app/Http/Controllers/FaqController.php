<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterFaqType;
use App\Models\Other\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $faqs = Faq::paginate(20);
        $master_faq_type = MasterFaqType::all();

        return view('admin.faq.index', compact('faqs', 'master_faq_type'));
    }

    public function create()
    {
        $MasterFaqType = MasterFaqType::all();
        $FaqLang = Faq::all()->unique('lang')->pluck('lang');
        return view('admin.faq.create', compact('MasterFaqType', 'FaqLang'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'question' => 'required|string',
            'answer' => 'required|string',
            'faq_type_id' => 'required|numeric',
            'lang' => 'required|string',
        ]);

        $fill = $request->only(['question', 'answer', 'faq_type_id', 'lang']);
        $Faq = Faq::create($fill);
        session()->put('success', 'Successfully created Faq');

        return redirect()->route('faq.index');
    }

    public function show(Request $request, $id)
    {
        $faq = Faq::find($id);
        $MasterFaqType = MasterFaqType::all();
        $FaqLang = Faq::all()->unique('lang')->pluck('lang');
        return view('admin.faq.show', compact('faq', 'MasterFaqType', 'FaqLang'));
    }

    public function edit($id)
    {

        $faq = faq::find($id);
        $FaqLang = Faq::all()->unique('lang')->pluck('lang');
        return response()->json(['status' => 200, 'faq' => $faq, 'FaqLang' => $FaqLang, 'faqListOfType' => $faq->listOfType]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $faq = FAQ::findOrFail($id);
            $faq = $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'lang' => $request->faq_language,
                'faq_type_id' => $request->faq_type,
            ]);

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return to_route('faq.index');
    }

    public function destroy(Request $request, $id)
    {
        Faq::find($id)->delete();
        session()->put('success', 'Successfully deleted Faq');

        return redirect()->route('faq.index');
    }

    public function refreshFaqTable()
    {
        $faqs = Faq::paginate(20);
        $master_faq_type = MasterFaqType::all();
        return view('admin.faq.tableFaq', compact('faqs', 'master_faq_type'));
    }
}
