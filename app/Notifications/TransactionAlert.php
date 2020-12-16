<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionAlert extends Notification
{
    use Queueable;

    protected $amount, $type, $narration, $ref, $balance, $date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, $type, $narration, $ref, $balance, $date)
    {
        $this->amount = $amount;
        $this->type = $type;
        $this->narration = $narration;
        $this->ref = $ref;
        $this->balance = $balance;
        $this->date = $date;
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
            ->subject('Transaction Alert ['. ucfirst($this->type).': '.number_format($this->balance, 2).' NGN]')
            ->line('Your account has been '. ucfirst($this->type).' NGN '.number_format($this->amount, 2))
            ->line('Transaction Summary')
            ->line('Account Name: '. ucwords($notifiable->name))
            ->line('Description: '.$this->narration)
            ->line('Reference Number: '.str_pad($this->ref, 6, 0))
            ->line('Transaction Date: '.$this->date->format('d F Y'))
            ->line('Available Balance: '.number_format($this->balance, 2))
            ->action('View Transaction History', route('user.wallet.index'))
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
