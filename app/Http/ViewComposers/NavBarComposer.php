<?php
namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NavBarComposer
{
    public function _construct()
    {

    }

    public function compose(View $view)
    {
        $notifications = [];

        if (Auth::user()) {
            $user = Auth::user();
            $notifications = $user->notifications;
            // dd($notifications = $user->notifications);
            // $notifications = Notification::where('notifiable_type', 'App\Models\User')->where('notifiable_id', $user->id)->orderBy('created_at', 'DESC')->limit(10)->get();
            // foreach ($notifications as $notification) {
            //     $notification->setAttribute('dataObj', json_encode($notification->data));
            // }
            // dd($notifications);
        }

        $view->with(['notifications' => $notifications]);
    }
}
