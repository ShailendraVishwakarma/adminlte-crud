<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RemainingProductsNotification extends Notification
{
    use Queueable;

    public $totalProducts;

    public function __construct($totalProducts)
    {
        $this->totalProducts = $totalProducts;
    }

    // Channels
    public function via($notifiable)
    {
        return ['mail', 'database']; // mail + db
    }

    // Mail notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Remaining Products Alert')
            ->greeting('Hello '.$notifiable->name)
            ->line('You have '.$this->totalProducts.' products remaining.')
            ->line('Please review your products.')
            ->salutation('Thank you');
    }

    // Database notification
    public function toArray($notifiable)
    {
        return [
            'message' => 'You have '.$this->totalProducts.' products remaining.'
        ];
    }
}

