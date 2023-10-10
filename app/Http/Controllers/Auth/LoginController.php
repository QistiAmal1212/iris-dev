<?php

namespace App\Http\Controllers\Auth;

use App\Models\LogSystem;
use App\Http\Controllers\Controller;
use App\Models\Master\MasterFaqType;
use App\Models\Other\Announcement;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'no_ic';
    }

    protected function authenticated($request, $user)
    {
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')->withErrors(["active" => "Akaun anda sudah tidak aktif"]);
        }
        if ($user->is_blocked) {
            auth()->logout();
            return redirect()->route('login')->withErrors(["active" => "Akaun anda telah disekat"]);
        }
        if($user->last_change_password==null){
            $user->login_failed_counter = 0;
            $user->last_login = now();
            $user->save();
            return redirect()->to('/admin/user/' . $user->id)->withErrors(["change_password" => "Kata Laluan perlu ditukar untuk kali pertama"]);
        }
        $today= now();
        $lastUpdate = $user->last_change_password;
        if($today->diffInDays($lastUpdate)>1){
            $user->login_failed_counter = 0;
            $user->last_login = now();
            $user->save();
            return redirect()->to('/admin/user/' . $user->id)->withErrors(["change_password" => "Kata Laluan perlu ditukar setiap 6 bulan"]);
        }
        $user->login_failed_counter = 0;
        $user->last_login = now();
        $user->save();

        $log = new LogSystem;
        $log->module_id = 1;
        $log->activity_type_id = 6;
        $log->description = "Log Masuk Pengguna [{$user->name}]";
        $log->data_new = json_encode($user);
        $log->url = $request->fullUrl();
        $log->method = strtoupper($request->method());
        $log->ip_address = $request->ip();
        $log->created_by_user_id = $user->id;
        $log->save();

        if($request->remember_login)
        {
            Cookie::queue(Cookie::make('no_ic', $user->no_ic, 525600));
            Cookie::queue(Cookie::make('password', $request->password, 525600));
        } else {
            Cookie::queue(Cookie::forget('no_ic'));
            Cookie::queue(Cookie::forget('password'));
        }
        // Cookie::make('no_ic', $user->no_ic, 525600);
        // Cookie::make('password', $request->password, 525600);
    }

    protected function sendFailedLoginResponse(Request $request){
        $user = User::where('no_ic', $request->no_ic)->first();

        if($user){
            $user->login_failed_counter += 1;

            if($user->login_failed_counter >= 5){
                $user->is_blocked = true;
                $user->save();
            }
            if ($user->is_blocked) {
                auth()->logout();
                return redirect()->route('login')->withErrors(["active" => "Akaun anda telah disekat"]);
            }

            $user->save();

        }
        return redirect()->route('login')->withErrors(["active" => "Kata Laluan Salah"]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

   /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        $cookieName = Cookie::get('no_ic');
        $cookiePassword = Cookie::get('password');
        return view('auth.login', compact('cookieName', 'cookiePassword'));
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            // $user->last_logout_date = Carbon::now();
            //$user->save();
        }

        $log = new LogSystem;
        $log->module_id = 1;
        $log->activity_type_id = 7;
        $log->description = "Log Keluar Pengguna [" . auth()->user()->name . "]";
        $log->data_old = json_encode(auth()->user());
        $log->url = $request->fullUrl();
        $log->method = strtoupper($request->method());
        $log->ip_address = $request->ip();
        $log->created_by_user_id = auth()->id();
        $log->save();

        auth()->logout();
        return redirect()->route('login');
    }

    /**
    * Redirect the user to the Google authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // only allow people with @company.com to login
        // can add condition to only certain things
        // if(explode("@", $user->email)[1] !== 'company.com'){
        //     return redirect()->to('/');
        // }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            return abort('404', 'User not exists in the system');
        }
        return redirect()->to('/home');
    }
}
