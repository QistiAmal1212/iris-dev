<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

//check email is blocked or not
class CheckEmailController extends Controller
{
    public function checkEmailBlocked($email)
    {
        $user = User::where('email', $email)->first();

        if ($user->is_blocked) {
            return response()->json(['blocked' => true]);
        }

        return response()->json(['blocked' => false]);
    }

}
