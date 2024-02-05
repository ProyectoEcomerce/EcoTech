<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Cart;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    /**
     * Create a new message instance.
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function build()
    {
        return $this->view('emails.orderConfirmation')
        ->with([
            'products' => $this->cart->products,
            'user' => $this->cart->user,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    /*public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
