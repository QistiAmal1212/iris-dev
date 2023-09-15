<?php

namespace App\Mail\Auth;

use Illuminate\Mail\Mailable;
use App\Models\User;

class RegisterUser extends Mailable
{
    public $user;
    public $subject;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $password=false)
    {
        $this->user = $user;
        $this->subject = 'Pendaftaran Akaun Sistem Pengambilan Bersepadu (IRIS)';
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;
        $password = $this->password;
        return $this->subject($this->subject)->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('auth.email.email_register', compact('user', 'password'));
    }
}
