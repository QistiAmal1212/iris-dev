<?php

namespace App\Mail\Auth;

use Illuminate\Mail\Mailable;

class NewPasswordMail extends Mailable
{
    public $newPassword;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
        $this->subject = 'Kata Laluan Baru Akaun Sistem Pengambilan Bersepadu (IRIS)';
    }

     /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $newPassword = $this->newPassword;
        return $this->subject($this->subject)->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('auth.email.email_new_password', compact('newPassword'));
    }
}
