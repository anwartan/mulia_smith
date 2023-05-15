<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;

    public $name;
    public $email;
    public $messageEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $name, string $email, string $message)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->messageEmail = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.contact-form')
        ->from($this->email, $this->name)
        ->to('noreply@muliasmith.com');
    }
}
