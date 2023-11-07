<?php

namespace App\Notifications;

use App\Models\Invitation;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSupplier extends Notification
{
    use Queueable;

    private $new_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invitation $new_user)
    {
        $this->new_user = $new_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Supplier Account Invitation')
                    ->greeting('Hello,')
                    ->line('Welcome to QED Procurement MIS.')
                    ->line('This is to invite you to register your new supplier account with us')
                    ->action('Register', $this->new_user->getlink())
                    ->line('Thank you for using our application!');
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
