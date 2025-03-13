<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SoumissionsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $employe;

    /**
     * Create a new message instance.
     */
    public function __construct($demande)
    {
        $this->demande = $demande;
        $this->employe = $demande->user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande en attente d\'examen : ' . $this->demande->typeDemande->libelle,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.soumissions',
            with: [
                'demande' => $this->demande,
                'employe' => $this->employe,
                'acceptUrl' => route('demande.accepter', ['id' => $this->demande->id]),
                'rejectUrl' => route('demande.rejeter', ['id' => $this->demande->id]),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
