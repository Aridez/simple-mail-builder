<?php

namespace Aridez\MailBuilder\Tests\Unit\Core;

use Aridez\MailBuilder\Core\BaseMailMessage;
use Illuminate\Mail\Attachment;
use PHPUnit\Framework\TestCase;

class BaseMailMessageTest extends TestCase
{
    public function test_set_from()
    {
        $message = new BaseMailMessage();
        $message->from('example@example.com', 'John Doe');

        $this->assertEquals(['example@example.com', 'John Doe'], $message->from);
    }

    public function test_set_reply_to()
    {
        $message = new BaseMailMessage();
        $message->replyTo('reply@example.com', 'Reply Person');

        $this->assertEquals([['reply@example.com', 'Reply Person']], $message->replyTo);
    }

    public function test_set_cc()
    {
        $message = new BaseMailMessage();
        $message->cc('cc@example.com', 'CC Person');

        $this->assertEquals([['cc@example.com', 'CC Person']], $message->cc);
    }

    public function test_set_bcc()
    {
        $message = new BaseMailMessage();
        $message->bcc('bcc@example.com', 'BCC Person');

        $this->assertEquals([['bcc@example.com', 'BCC Person']], $message->bcc);
    }

    public function test_set_view()
    {
        $message = new BaseMailMessage();
        $message->view('emails.test', ['key' => 'value']);

        $this->assertEquals('emails.test', $message->view);
        $this->assertEquals(['key' => 'value'], $message->data());
    }

    public function test_set_priority()
    {
        $message = new BaseMailMessage();
        $message->priority(1);

        $this->assertEquals(1, $message->priority);
    }

    public function test_set_subject()
    {
        $message = new BaseMailMessage();
        $message->subject('Test Subject');

        $this->assertEquals('Test Subject', $message->subject);
    }

    public function test_attach_data()
    {
        $message = new BaseMailMessage();
        $message->attachData('file data', 'file.txt', ['mime' => 'text/plain']);

        $this->assertEquals([['data' => 'file data', 'name' => 'file.txt', 'options' => ['mime' => 'text/plain']]], $message->rawAttachments);
    }

    public function test_add_tag()
    {
        $message = new BaseMailMessage();
        $message->tag('Important');

        $this->assertEquals(['Important'], $message->tags);
    }

    public function test_add_metadata()
    {
        $message = new BaseMailMessage();
        $message->metadata('key1', 'value1');
        $message->metadata('key2', 'value2');

        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'], $message->metadata);
    }

    public function test_with_symfony_message()
    {
        $message = new BaseMailMessage();
        $message->withSymfonyMessage(function ($symfonyMessage) {
            // Do something with the Symfony message
        });

        $this->assertCount(1, $message->callbacks);
        $this->assertIsCallable($message->callbacks[0]);
    }
}
