<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NouvelEmploye extends Mailable
{
    use Queueable, SerializesModels;

    public $employe;
    public $password;

    /**
     * Create a new message instance.
     */
    public function __construct($employe, $password)
    {
        $this->employe = $employe;
        $this->password = $password;
    }

 

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Creation de votre Compte sur ' . config('app.name') . ' !',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.nouvel_employe', // Assure-toi que ce fichier existe
            with: [
                'employe' => $this->employe,
                'password' => $this->password,
            ],
        );
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
