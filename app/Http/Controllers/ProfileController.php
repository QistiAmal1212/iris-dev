<?php

namespace App\Http\Controllers;

use App\Notifications\ProfileUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view(Request $request)
    {
        $user = Auth::user();

        return view('profile.view', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->notify(new ProfileUpdated($user));

        $request->session()->flash('success', 'Profile Updated');
        return redirect()->back();
    }
}
