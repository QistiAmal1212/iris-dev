<?php

namespace App\Http\Controllers;

use App\Models\Other\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $updateInbox = Inbox::where('receiver_user_id', auth()->user()->id)->update(['inbox_status_id' => 3]);
        $inboxs = Inbox::where('receiver_user_id', auth()->user()->id)->paginate(20);

        return view('inbox', compact('inboxs'));
    }
}
