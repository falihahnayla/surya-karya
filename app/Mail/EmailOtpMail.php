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
        $company = Setting::first()?->company ?? 'Surya Karya';
        return new Envelope(subject: 'Kode Verifikasi Email - ' . $company);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.otp');
    }
}
