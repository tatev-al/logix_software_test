<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class EmailChangeVerification extends Mailable
{
    protected $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function build()
    {
        return $this->view('emails.email-change-verification')
            ->with(['verificationCode' => $this->verificationCode['verificationCode']]);
    }
}
