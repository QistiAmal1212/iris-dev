<?php

namespace App\Http\Controllers;

use App\Models\Other\Inbox;
use App\Models\Other\Notify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NotifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifys = Notify::paginate(20);

        return view('admin.notify.index', compact('notifys'));
    }

    public function create()
    {
        return view('admin.notify.create');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'is_active_emel' => 'sometimes|integer',
            'is_active_system' => 'sometimes|integer',
        ]);

        $splitName = explode(' ', $request->name);
        $code = implode('', $splitName);
        $notify = Notify::create([
            'name' => $request->name,
            'message' => $request->message,
            'code' => $code,
            'is_active_emel' => $request->is_active_emel ? 1 : 0,
            'is_active_system' => $request->is_active_system ? 1 : 0,
            'created_by_user_id' => auth()->user()->id,
        ]);
        session()->put('success', 'Successfully created Notification');

        return redirect()->route('notify.index');
    }

    public function show(Request $request, $id)
    {
        $notify = Notify::find($id);
        return view('admin.notify.show', compact('notify'));
    }

    public function edit(Request $request, $id)
    {
        $notify = Notify::find($id);
        return view('admin.notify.edit', compact('notify'));
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'required|string',
            'message' => 'required|string',
            'is_active_emel' => 'sometimes|integer',
            'is_active_system' => 'sometimes|integer',
        ]);

        $notify = Notify::find($id);
        $notify->update([
            'name' => $request->name,
            'message' => $request->message,
            'is_active_emel' => $request->is_active_emel ? 1 : 0,
            'is_active_system' => $request->is_active_system ? 1 : 0,
        ]);
        session()->put('success', 'Successfully updated Notification');

        return redirect()->route('notify.index');
    }

    public function destroy(Request $request, $id)
    {
        $notify = Notify::findOrFail($id);
        $notify->delete();
        session()->put('success', 'Successfully deleted Notification');

        return redirect()->route('notify.index');
    }

    public function showSendNotification(Request $request, $id)
    {
        $notify = Notify::find($id);
        $Users = User::all();
        return view('admin.notify.notify', compact('notify', 'Users'));
    }

    public function sendNotification(Request $request, $id)
    {
        Validator::make($request->all(), [
            'user_id' => 'required|integer',
        ]);

        $notify = Notify::find($id);
        $user = User::find($request->user_id);

        $template = [
            'username',
        ];
        foreach ($template as $tpl) {
            if ($tpl == 'username') {
                $notify->name = str_replace('[' . $tpl . ']', $user->email, $notify->name);
                $notify->message = str_replace('[' . $tpl . ']', $user->email, $notify->message);
            }
            if ($tpl == 'email') {
                $notify->name = str_replace('[' . $tpl . ']', $user->email, $notify->name);
                $notify->message = str_replace('[' . $tpl . ']', $user->email, $notify->message);
            }
        }

        if ($notify->is_active_system) {
            $inbox = Inbox::create([
                'sender_user_id' => $notify->created_by_user_id,
                'receiver_user_id' => $user->id,
                'subject' => $notify->name,
                'message' => $notify->message,
                'inbox_status_id' => 2,
            ]);

            DB::table('notifications')->insert([
                'id' => Str::random(8) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4) . '-' . Str::random(12),
                'type' => 'App\Models\Other\Inbox',
                'notifiable_type' => 'App\Models\User',
                'notifiable_id' => $user->id,
                'data' => json_encode(['message' => $inbox->subject]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        if ($notify->is_active_emel) {
            // Send email
        }
        session()->put('success', 'Successfully send Notification');

        return redirect()->route('notify.index');
    }
}
