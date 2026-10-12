<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class EmailOtpMail extends Mailable
{
    public function __construct(public string $code, public int $minutes = 10) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Kode Verifikasi Email Anda');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.otp');
    }
}
