<?php

namespace Aridez\MailBuilder\Core;

use Illuminate\Contracts\Mail\Attachable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Mail\Attachment;

class BaseMailMessage
{
    /**
     * The view to be rendered.
     *
     * @var string
     */
    public string $view;

    /**
     * The subject of the notification.
     *
     * @var string
     */
    public string $subject = "";

    /**
     * The attachments for the message.
     *
     * @var array
     */
    public array $attachments = [];

    /**
     * The raw attachments for the message.
     *
     * @var array
     */
    public array $rawAttachments = [];

    /**
     * Priority level of the message.
     *
     * @var int
     */
    public ?int $priority = null;

    /**
     * The tags for the message.
     *
     * @var array
     */
    public array $tags = [];

    /**
     * The metadata for the message.
     *
     * @var array
     */
    public array $metadata = [];

    /**
     * The callbacks for the message.
     *
     * @var array
     */
    public array $callbacks = [];

    /**
     * The "from" information for the message.
     *
     * @var array
     */
    public array $from = [];

    /**
     * The "reply to" information for the message.
     *
     * @var array
     */
    public array $replyTo = [];

    /**
     * The "cc" information for the message.
     *
     * @var array
     */
    public array $cc = [];

    /**
     * The "bcc" information for the message.
     *
     * @var array
     */
    public array $bcc = [];

    /**
     * The data passed to the view
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Set the from address for the mail message.
     *
     * @param  string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function from($address, $name = null)
    {
        $this->from = [$address, $name];

        return $this;
    }

    /**
     * Set the "reply to" address of the message.
     *
     * @param  array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function replyTo($address, $name = null)
    {
        if ($this->arrayOfAddresses($address)) {
            $this->replyTo += $this->parseAddresses($address);
        } else {
            $this->replyTo[] = [$address, $name];
        }

        return $this;
    }

    /**
     * Parse the multi-address array into the necessary format.
     *
     * @param  array  $value
     * @return array
     */
    protected function parseAddresses($value)
    {
        return collect($value)->map(function ($address, $name) {
            return [$address, is_numeric($name) ? null : $name];
        })->values()->all();
    }

    /**
     * Determine if the given "address" is actually an array of addresses.
     *
     * @param  mixed  $address
     * @return bool
     */
    protected function arrayOfAddresses($address)
    {
        return is_iterable($address) || $address instanceof Arrayable;
    }

    /**
     * Set the cc address for the mail message.
     *
     * @param  array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function cc($address, $name = null)
    {
        if ($this->arrayOfAddresses($address)) {
            $this->cc += $this->parseAddresses($address);
        } else {
            $this->cc[] = [$address, $name];
        }

        return $this;
    }

    /**
     * Set the bcc address for the mail message.
     *
     * @param  array|string  $address
     * @param  string|null  $name
     * @return $this
     */
    public function bcc($address, $name = null)
    {
        if ($this->arrayOfAddresses($address)) {
            $this->bcc += $this->parseAddresses($address);
        } else {
            $this->bcc[] = [$address, $name];
        }

        return $this;
    }

    /**
     * Get the data array for the mail message.
     *
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * Set the view for the mail message.
     *
     * @param  string  $view
     * @return $this
     */
    public function view(string $view, array $data = [])
    {
        $this->view = $view;
        $this->data = $data;

        return $this;
    }

    /**
     * Set the priority of this message.
     *
     * The value is an integer where 1 is the highest priority and 5 is the lowest.
     *
     * @param  int  $level
     * @return $this
     */
    public function priority($level)
    {
        $this->priority = $level;

        return $this;
    }

    /**
     * Set the subject of the notification.
     *
     * @param  string  $subject
     * @return $this
     */
    public function subject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Attach in-memory data as an attachment.
     *
     * @param  string  $data
     * @param  string  $name
     * @param  array  $options
     * @return $this
     */
    public function attachData($data, $name, array $options = [])
    {
        $this->rawAttachments[] = compact('data', 'name', 'options');

        return $this;
    }

    /**
     * Add a tag header to the message when supported by the underlying transport.
     *
     * @param  string  $value
     * @return $this
     */
    public function tag($value)
    {
        array_push($this->tags, $value);

        return $this;
    }

    /**
     * Add a metadata header to the message when supported by the underlying transport.
     *
     * @param  string  $key
     * @param  string  $value
     * @return $this
     */
    public function metadata($key, $value)
    {
        $this->metadata[$key] = $value;

        return $this;
    }

    /**
     * Register a callback to be called with the Symfony message instance.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function withSymfonyMessage($callback)
    {
        $this->callbacks[] = $callback;

        return $this;
    }

    /**
     * Attach a file to the message.
     *
     * @param  string|\Illuminate\Contracts\Mail\Attachable|\Illuminate\Mail\Attachment  $file
     * @param  array  $options
     * @return $this
     */
    public function attach($file, array $options = [])
    {
        if ($file instanceof Attachable) {
            $file = $file->toMailAttachment();
        }

        if ($file instanceof Attachment) {
            return $file->attachTo($this);
        }

        $this->attachments[] = compact('file', 'options');

        return $this;
    }

}
