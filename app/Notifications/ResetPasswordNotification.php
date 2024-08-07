<?php

namespace App\Notifications;


use Ichtrojan\Otp\Otp;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    private $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message='Use the below code for reseting your password';
        $this->subject='Password reseting';
        $this->fromEmail='halaibrahim867@gmail.com';
        $this->mailer='smtp';
        $this->otp=new Otp();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
       $otp=$this->otp->generate($notifiable->email,6, 60);
        return (new MailMessage)
                    ->mailer('smtp')
                    ->subject($this->subject)
                    ->greeting('Hello '.$notifiable->first_name)
                    ->line($this->message)
                    ->line('code '.$otp->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
