<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ColocationInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitationLink;
    public $colocationName;

    /**
     * Create a new message instance.
     */
    public function __construct($colocationName, $invitationLink)
    {
        $this->colocationName = $colocationName;
        $this->invitationLink = $invitationLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Invitation to join {$this->colocationName}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.colocation_invitation'
        );
    }

    public function attachments(): array
    {
        return [];
    }
}