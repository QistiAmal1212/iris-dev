<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
     */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $checkActive = User::where('email', $request->email)->first();

        if($checkActive){
            if(!!!$checkActive->is_active){
                return redirect()->back()->withErrors(['active' => 'Akaun anda sudah tidak aktif. Sila hubungi pentadbir bahagian masing-masing']);
            }
            elseif($checkActive->is_blocked){
                return redirect()->back()->withErrors(['blocked' => 'Akaun anda telah disekat. Sila hubungi pentadbir bahagian masing-masing']);
            }
            else{}
        }

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
}
