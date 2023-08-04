<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //tutorial cache https://stackoverflow.com/questions/32824781/laravel-load-settings-from-database jawapan from kjdion84
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $system_name = Helpers::settings('system_name');
        $background_login_page = Helpers::settings('background_login_page');
        $logo_header = Helpers::settings('logo_header');
        $favicon = Helpers::settings('favicon');
        $copyright = Helpers::settings('copyright');

        return view('admin.settings.index', compact(['system_name', 'background_login_page', 'logo_header', 'favicon', 'copyright']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {

        if ($request->system_name) {
            Settings::where('key', 'system_name')->update(['value' => $request->system_name]);
        }

        if ($request->copyright) {
            Settings::where('key', 'copyright')->update(['value' => $request->copyright]);
        }

        if ($request->logo_header) {
            $name_logo_header = "favicon." . $request->logo_header->extension();
            $request->logo_header->move(public_path('/storage/settingspicture'), $name_logo_header);
            Settings::where('key', 'logo_header')->update(['value' => 'storage/settingspicture/' . $name_logo_header]);
        }

        if ($request->favicon) {
            $name_favicon = "favicon." . $request->favicon->extension();
            $request->favicon->move(public_path('/storage/settingspicture'), $name_favicon);
            Settings::where('key', 'favicon')->update(['value' => 'storage/settingspicture/' . $name_favicon]);
        }

        if ($request->background_login_page) {
            $name_bg = "bg." . $request->background_login_page->extension();
            $request->background_login_page->move(public_path('/storage/settingspicture'), $name_bg);
            Settings::where('key', 'background_login_page')->update(['value' => 'storage/settingspicture/' . $name_bg]);
        }

        return response()->json(['status' => 'success', 'title' => 'Berjaya!', 'message' => 'Data telah dikemaskini.']);
    }
}
