<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequest extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Новая заявка с сайта')
            ->view('emails.contact_request')
            ->with(['data' => $this->data]);
    }
}
