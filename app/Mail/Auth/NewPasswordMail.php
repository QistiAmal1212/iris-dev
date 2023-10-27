<?php

namespace App\Mail\Auth;

use Illuminate\Mail\Mailable;

class NewPasswordMail extends Mailable
{
    public $newPassword;
    public $name;
    public $no_ic;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($newPassword, $name, $no_ic)
    {
        $this->newPassword = $newPassword;
        $this->name = $name;
        $this->no_ic = $no_ic;
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
        $name = $this->name;
        $no_ic = $this->no_ic;
        return $this->subject($this->subject)->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('auth.email.email_new_password', compact('newPassword', 'name', 'no_ic'));
    }
}
