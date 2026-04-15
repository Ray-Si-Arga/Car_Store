<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// Ini adalah file PaymentKirim yang dimana jika customer sudah membayar maka email ini akan dikirim ke admin


class PaymentKirim extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $booking;
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // method build untuk mengirim email
    public function build()
    {
        return $this->subject('Pembayaran Disetujui')
            ->view('components.disetujui');
    }

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
