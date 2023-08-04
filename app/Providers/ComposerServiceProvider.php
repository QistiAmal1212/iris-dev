<?php

namespace App\Providers;

use App\Helpers\Helpers;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        View::composer('*', function ($view) {
            //any code to set $val variable
            $system_name = Helpers::settings("system_name");
            $copyright = Helpers::settings("copyright");
            $background_login_page = Helpers::settings("background_login_page");
            $logo_header = Helpers::settings("logo_header");
            $favicon = Helpers::settings("favicon");
            $view->with('system_name', $system_name)->with('copyright', $copyright)->with('background_login_page',$background_login_page)
            ->with('favicon',$favicon)->with('logo_header',$logo_header);
        });
    }

    public function boot()
    {
        view()->composer('layouts.navbar', 'App\Http\ViewComposers\NavBarComposer');
    }
}
