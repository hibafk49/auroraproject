<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Facture;

class FactureEnvoyee extends Mailable
{
    use Queueable, SerializesModels;

    public $facture;

    public function __construct(Facture $facture)
    {
        $this->facture = $facture;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre Facture',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.facture',
            with: ['facture' => $this->facture]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
