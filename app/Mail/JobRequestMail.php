<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        // Attach resume from public storage if exists (use Storage helpers and normalize path)
        if (!empty($this->data['resume'])) {
            $resumeRelative = ltrim($this->data['resume'], '/');
            $disk = 'public';

            if (Storage::disk($disk)->exists($resumeRelative)) {
                // Determine MIME type using the local file path to avoid calling a method
                // that may not exist on the filesystem contract.
                $mime = 'application/octet-stream';
                try {
                    // path() is available for local disks (like 'public') and gives an absolute path.
                    $filePath = Storage::disk($disk)->path($resumeRelative);
                    if (is_file($filePath)) {
                        if (function_exists('finfo_open')) {
                            $finfo = finfo_open(FILEINFO_MIME_TYPE);
                            $detected = $finfo ? finfo_file($finfo, $filePath) : false;
                            if ($finfo) {
                                finfo_close($finfo);
                            }
                            if ($detected) {
                                $mime = $detected;
                            }
                        } elseif (function_exists('mime_content_type')) {
                            $detected = @mime_content_type($filePath);
                            if ($detected) {
                                $mime = $detected;
                            }
                        }
                    }
                } catch (\Throwable $e) {
                    Log::warning('Failed to detect MIME type for resume', ['path' => $resumeRelative, 'error' => $e->getMessage()]);
                }

                $this->attachFromStorageDisk($disk, $resumeRelative, basename($resumeRelative), [
                    'mime' => $mime,
                ]);
            } else {
                // Log full intended path for debugging
                $resumeFull = storage_path('app/' . $disk . '/' . $resumeRelative);
                Log::warning('Resume not found for email attach', ['relative' => $resumeRelative, 'full' => $resumeFull]);
            }
        }

        return $this->markdown('emails.jobRequest', [
            'data' => $this->data,
            'logoUrl' => $logoUrl
        ]);
    }
}
