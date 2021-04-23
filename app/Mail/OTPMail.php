<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $opt ;
    public $email ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($opt,$email)
    {
        $this->opt = $opt;
        $this->email = $email;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('OTP')
            ->to($this->email)
            ->with(['opt' => $this->opt]);
    }
}
