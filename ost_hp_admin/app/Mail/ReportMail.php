<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Report $report) {}

    public function envelope(): Envelope
    {
        $from = $this->report->date_from->format('Y/m/d');
        $to   = $this->report->date_to->format('Y/m/d');

        return new Envelope(
            subject: "【報告】{$from} ～ {$to} 掲載承諾・内見申請レポート",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.report',
        );
    }
}
