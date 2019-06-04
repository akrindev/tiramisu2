<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailTo extends Mailable
{
    use Queueable, SerializesModels;

  	public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->msg['subject'])
          ->markdown('emails.send-mail');
    }
}