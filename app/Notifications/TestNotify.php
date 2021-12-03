<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class TestNotify extends Notification
{
    use Queueable;

    public $fromName;
    public $fromEmail;
    public $subject;

    /**
     * Create a new notification instance.
     *x
     * @return void
     */
    public function __construct($fromName, $fromEmail, $subject)
    {
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

//    /**
//     * Get the mail representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     * @return \Illuminate\Notifications\Messages\SlackMessage
//     */
//    public function toSlack($notifiable)
//    {
//        return (new SlackMessage)
//            ->to(config('slack.channel'))
//            ->content('New invoice is created');
//    }

     public function toMail($notifiable)
     {
         return (new MailMessage)
             ->subject($this->subject)
             ->with('Invoice is created')
             ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
     }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
