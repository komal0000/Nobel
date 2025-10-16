<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Job Request Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.jobRequest',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        $this->subject('New Job Request Received');

        // get logo if available (for inline use or header)
        $favicon = \App\Helper::getSetting('top_favicon', true);
        $logoUrl = $favicon ? asset('storage/' . ltrim($favicon, '/')) : null;

        // Attach resume from public storage if exists
        if (!empty($this->data['resume'])) {
            $resumeRelative = $this->data['resume'];
            $resumeFull = storage_path('app/public/' . ltrim($resumeRelative, '/'));
            if (file_exists($resumeFull)) {
                $this->attach($resumeFull, [
                    'as' => basename($resumeFull),
                    'mime' => mime_content_type($resumeFull) ?: 'application/octet-stream'
                ]);
            }
        }

        return $this->markdown('emails.jobRequest', [
            'data' => $this->data,
            'logoUrl' => $logoUrl
        ]);
    }
}
