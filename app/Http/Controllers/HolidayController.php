<?php

namespace App\Http\Controllers;

use App\Models\Master\MasterState;
use App\Models\Other\Holiday;
use App\Models\Other\Notify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $states = MasterState::paginate(20);
        $events = Holiday::whereNotNull('start_date')->get()->transform(function ($item) {
            return [
                'title' => $item->name,
                'start' => $item->start_date,
                'end' => $item->duration > 1 ?
                Carbon::parse($item->start_date)->addDays((int) $item->duration) :
                $item->start_date,
                'backgroundColor' => '#f56954',
                'borderColor' => '#f56954',
            ];
        });

        return view('admin.holiday.index', compact('states', 'events'));
    }

    public function create()
    {
        return view('admin.holiday.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'is_active_emel' => 'sometimes|integer',
            'is_active_system' => 'sometimes|integer',
        ]);

        session()->put('success', 'Successfully created Notification');

        return redirect()->route('holiday.index');
    }

    public function show(Request $request, $id)
    {
        $holiday = Notify::find($id);
        return view('admin.holiday.show', compact('holiday'));
    }

    public function edit(Request $request, $id)
    {
        $holiday = Notify::find($id);
        return view('admin.holiday.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'is_active_emel' => 'sometimes|integer',
            'is_active_system' => 'sometimes|integer',
        ]);

        session()->put('success', 'Successfully updated Notification');

        return redirect()->route('holiday.index');
    }

    public function destroy(Request $request, $id)
    {
        $holiday = Notify::findOrFail($id);
        $holiday->delete();
        session()->put('success', 'Successfully deleted Notification');

        return redirect()->route('holiday.index');
    }

    public function updateWeekend(Request $request)
    {
        $requestAll = $request->all();

        $MasterState = MasterState::all();
        foreach ($MasterState as $state) {
            $state->is_friday_weekend = $requestAll['is_friday_weekend' . $state->id] == 1 ? 1 : 0;
            $state->save();
        }
        session()->put('success', 'Successfully update weekend');

        return redirect()->route('holiday.index', ['tab' => 4]);
    }
}
