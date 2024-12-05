<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RentDueNotification extends Notification
{
    use Queueable;

    public $tenant;

    // Pass tenant data to the notification
    public function __construct($tenant)
    {
        $this->tenant = $tenant;
    }

    // The "via" method determines the notification channels (e.g., email)
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Build the mail message
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Rent Due Notification')
                    ->greeting('Hello ' . $this->tenant->firstName . ' ' . $this->tenant->lastName)
                    ->line('This is a reminder that your rent payment is overdue.')
                    ->line('Please make sure to pay your rent as soon as possible.')
                    ->line('If you have already paid, please disregard this message.')
                    ->action('Pay Now', url('/pay-rent/' . $this->tenant->id)) // Link to payment page
                    ->line('Thank you for your prompt attention to this matter.');
    }
}
