<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

/**
 * Global Email Helper
 *
 * @param string $to
 * @param string $subject
 * @param string $message
 * @param array  $options  Optional settings (heading, action_text, action_url, attachments)
 *
 * @return bool
 */
function sendEmail(string $to, string $subject, string $message, array $options = []): bool
{
    try {
        Mail::to($to)->send(new SendEmail($subject, $message, $options));
        logger()->info("Sent email to {$to} with subject '{$subject}'.");
        return true;
    } catch (\Exception $e) {
        logger()->error("Email failed: " . $e->getMessage());
        return false;
    }
}
