<?php

namespace App\Mail;

use App\Models\PropertyConsent;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyConsentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public PropertyConsent $consent) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '【通知】物件広告掲載の承認が完了いたしました');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.property_consent');
    }
}
