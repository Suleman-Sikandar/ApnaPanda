<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use SerializesModels;

    // Public properties available in the view
    public $subjectText;
    public $heading;      // optional title inside email
    public $bodyText;     // main message (can contain HTML)
    public $actionText;   // optional CTA button text
    public $actionUrl;    // optional CTA URL
    public $footer;       // custom footer text
    public $preheader;    // small preview text
    protected array $attachmentsArr = [];
    protected string $viewPath;

    /**
     * Create a new message instance.
     *
     * @param string $subjectText    Subject of the email (required)
     * @param string $bodyText       Main email body (can contain HTML)
     * @param array  $options        Optional settings:
     *                               - 'heading' => string
     *                               - 'action_text' => string
     *                               - 'action_url' => string
     *                               - 'footer' => string
     *                               - 'preheader' => string
     *                               - 'view' => custom blade view path (default 'emails.send_email')
     *                               - 'attachments' => [
     *                                     ['path' => storage_path('app/file.pdf'), 'name' => 'file.pdf', 'mime' => 'application/pdf'],
     *                                 ]
     */
    public function __construct(string $subjectText, string $bodyText, array $options = [])
    {
        $this->subjectText = $subjectText;
        $this->bodyText    = $bodyText;
        $this->heading     = $options['heading'] ?? null;
        $this->actionText  = $options['action_text'] ?? null;
        $this->actionUrl   = $options['action_url'] ?? null;
        $this->footer      = $options['footer'] ?? config('app.name') . ' Team';
        $this->preheader   = $options['preheader'] ?? '';
        $this->viewPath    = $options['view'] ?? 'admin.emails.send_email';
        $this->attachmentsArr = $options['attachments'] ?? [];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->viewPath,
            with: [
                'heading'    => $this->heading,
                'bodyText'   => $this->bodyText,
                'actionText' => $this->actionText,
                'actionUrl'  => $this->actionUrl,
                'footer'     => $this->footer,
                'preheader'  => $this->preheader,
            ],
        );
    }

    /**
     * Attachments (if any).
     *
     * Each attachment element should be an array containing:
     * ['path' => '/full/path/to/file', 'name' => 'filename.ext', 'mime' => 'mime/type']
     */
    public function attachments(): array
    {
        $attachments = [];

        foreach ($this->attachmentsArr as $att) {
            if (!isset($att['path'])) {
                continue;
            }

            $attachment = Attachment::fromPath($att['path']);

            if (!empty($att['name'])) {
                $attachment = $attachment->as($att['name']);
            }

            if (!empty($att['mime'])) {
                $attachment = $attachment->withMime($att['mime']);
            }

            $attachments[] = $attachment;
        }

        return $attachments;
    }
}
