<?php

namespace App\Console\Commands;

use App\Mail\Auth\NewPasswordMail;
use App\Mail\Auth\RegisterUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;

class UpdatePasswordsCommand extends Command
{
    protected $signature = 'update:newpassword';
    protected $description = 'Reset user password every six month';
    public function handle()
{
    $users = User::where('time_to_change_password', '<', Carbon::now()->subMonths(6))
            ->where('is_active', true)
            ->where('is_blocked', false)
            ->get();

    // $users = User::where('time_to_change_password', '<', Carbon::now()->subMinutes(6))
    //         ->where('is_active', true)
    //         ->where('is_blocked', false)
    //         ->get();

    foreach ($users as $user) {
        $newPassword = Str::random(12);
        $user->password = Hash::make($newPassword);
        $user->time_to_change_password = now();
        $user->last_change_password = now();
        $user->save();
        Mail::to($user->email)->send(new NewPasswordMail($newPassword));
    }


    $this->info('Passwords updated and emails sent successfully.');
}

}
