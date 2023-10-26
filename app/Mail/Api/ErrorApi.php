<?php

namespace App\Mail\Api;

use Illuminate\Mail\Mailable;

class ErrorApi extends Mailable
{
    public $urlApi;
    public $subject;
    public $error;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($urlApi, $error = null)
    {
        $this->urlApi = $urlApi;
        $this->subject = 'API Ralat Sistem Pengambilan Bersepadu (IRIS)';
        $this->error = $error;
    }

     /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $urlApi = $this->urlApi;
        $error = $this->error;
        return $this->subject($this->subject)->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('email.api.error_api', compact('urlApi', 'error'));
    }
}
