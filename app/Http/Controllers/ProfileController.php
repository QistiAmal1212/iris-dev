<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ProfileUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function updatePasswordFirst(Request $request)
    {
        \DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'old_password' => 'required|string',
                'new_password' => [
                    'required',
                    'string',
                    'min:12',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                ],
                'confirm_password' => 'required|same:new_password',
                'captcha_password' => 'required|captcha',
            ], [
                'old_password.required' => 'Sila masukkan kata laluan semasa',
                'new_password.required' => 'Sila masukkan kata laluan baru',
                'new_password.min' => 'Kata laluan mestilah sekurang-kurangnya 12 aksara',
                'new_password.regex' => 'Kata laluan tidak sah',
                'new_password.confirmed' => 'Pengesahan kata laluan tidak sepadan',
                'confirm_password.required' => 'Sila masukkan kata laluan pengsahan',
                'confirm_password.same' => 'Ruangan kata laluan baru dan sahkan kata laluan mesti sepadan',
                'captcha_password.required' => 'Sila masukkan pengesahan CAPTCHA',
                'captcha_password' => 'Pengesahan CAPTCHA gagal. Sila cuba semula.',
            ]);
            
            if (!Hash::check($request->old_password, auth()->user()->password)) { 
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => 'Kata laluan semasa tidak betul'], 401);
            }

            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
                'last_change_password' => now(),
                'first_login' => 0,
            ]);
            $user = auth()->user();

        } catch (\Throwable $e) {

            \DB::rollBack();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 422);
        }

        \DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }
}
