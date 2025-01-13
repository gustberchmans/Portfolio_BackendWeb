<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $response;

    /**
     * Create a new message instance.
     */
    public function __construct($contact, $response)
    {
        $this->contact = $contact;
        $this->response = $response;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Response to Your Inquiry')
            ->view('emails.contact_reply')
            ->with([
                'contact' => $this->contact,  // Pass the contact object
                'response' => $this->response,  // Pass the response text
            ]);
    }
}
