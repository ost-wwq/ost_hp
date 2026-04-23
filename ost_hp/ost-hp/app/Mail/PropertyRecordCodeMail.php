<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyRecordCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $code,
        public string $propertyTitle
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '【認証コード】内見予約・広告掲載許可申請の確認');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.property_record_code');
    }
}
