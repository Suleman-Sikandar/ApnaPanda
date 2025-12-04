<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;


class EmailQueueTest extends TestCase
{
    /** @test */
    public function it_sends_email_immediately()
    {
        Mail::fake();
        
        // Call the helper
        $result = \sendEmail('test@example.com', 'Test Subject', 'Test Body', []);

        $this->assertTrue($result);
        Mail::assertSent(SendEmail::class, function ($mail) {
            return $mail->hasTo('test@example.com') &&
                   $mail->subjectText === 'Test Subject';
        });
    }
}
