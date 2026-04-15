<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


// Ini adalah file PaymentSetujui yang dimana jika admin sudah menyetujui pembayaran maka email ini akan dikirim ke customer

class PaymentSetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // method build untuk mengirim email
    public function build()
    {
        return $this->subject('Pembayaran Berhasil')
            ->view('components.invoice')
            ->attach(storage_path('app/public' . $this->booking->bukti_bayar));
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