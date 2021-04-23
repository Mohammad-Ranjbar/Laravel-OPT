<?php

namespace App\Notifications;

use App\Mail\OTPMail as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class OTPNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $via;
    protected $otp;
    protected $email;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($via, $otp,$email)
    {
        $this->via = $via;
        $this->otp = $otp;
        $this->email = $email;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new Mailable($this->otp,$this->email));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

        ];
    }
}
