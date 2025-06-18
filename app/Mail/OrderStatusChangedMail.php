<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Cart;

class OrderStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function build()
    {
        return $this->subject('Статус вашего заказа изменился')
            ->view('emails.order_status_changed');
    }
}
