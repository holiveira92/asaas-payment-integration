<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentNotification extends Notification
{
    use Queueable;

    protected $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Payment Generated')
            ->line('A new payment has been generated:')
            ->line('Name: ' . $this->payment->customer->name)
            ->line('Email: ' . $this->payment->customer->email)
            ->line('Valor: ' . $this->payment->amount)
            ->line('Status: ' . $this->payment->status->name)
            ->line('Numero do Pedido: ' . $this->payment->order_number)
            ->line('Forma de Pagamento: ' . $this->payment->method->name)
            ->line('Url Pagamento: ' . $this->payment->url)
            ->line('Pix copia cola: ' . $this->payment->copia_cola);
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
