<?php

namespace App\Mail\Auth;

use Illuminate\Mail\Mailable;
use App\Models\User;

class ResetPasswordUser extends Mailable
{
    public $user;
    public $subject;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $email)
    {   
        $this->subject = 'Pertukaran Kata Laluan Baharu Sistem Perkhidmatan Pengambilan Bersepadu (IRIS)';
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->email,
        ], false));
        return $this->subject($this->subject)->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('auth.email.email_password', compact('url'));
    }
}
