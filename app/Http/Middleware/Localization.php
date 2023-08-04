<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
    **/

    protected $availableLocale = ['en', 'ms'];

    public function handle($request, Closure $next)
    {
        if (Session::has('locale') && in_array(Session::get('locale'),$this->availableLocale) ) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
