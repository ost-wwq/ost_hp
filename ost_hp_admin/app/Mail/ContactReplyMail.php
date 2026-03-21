<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\ContactReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Contact $contact,
        public ContactReply $reply
    ) {}

    public function envelope(): Envelope
    {
        $originalSubject = $this->contact->subject ?: 'お問い合わせについて';
        $subject = 'Re: ' . $originalSubject;

        // Use a unique reply-to address so inbound replies can be matched back
        $inboundEmail = config('mail.inbound_address');
        $replyToAddress = $inboundEmail
            ? str_replace('@', '+' . $this->reply->reply_token . '@', $inboundEmail)
            : config('mail.from.address');

        return new Envelope(
            replyTo: [new Address($replyToAddress, config('mail.from.name'))],
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
        );
    }
}
