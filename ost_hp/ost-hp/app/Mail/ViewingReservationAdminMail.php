<?php

namespace App\Mail;

use App\Models\ViewingReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ViewingReservationAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $completeUrl;

    public function __construct(public ViewingReservation $reservation)
    {
        $this->completeUrl = route('property.viewing.complete', $reservation->property->viewing_token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: '【内見予約通知】' . $this->reservation->property->title);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.viewing_reservation_admin');
    }
}
