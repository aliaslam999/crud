<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $credentials;
    /**
     * Create a new message instance.
     */
    public function __construct(public Request $user)
    {
        // $this->credentials = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $data = [
            'name' => $this->credentials['name'] ?? '',
            'email' => $this->credentials['email'] ?? '',
            'des' => $this->credentials['des'] ?? '',
        ];
    

        return new Content(
            view: 'email.email',
            // with: $data
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
