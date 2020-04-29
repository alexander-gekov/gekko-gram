<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewUserWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('emails.welcome-email');
        return $this->markdown('emails.welcome-email')
            ->from('alexander.gekov00@gmail.com', 'GekkoGram App')
            ->subject('Hello & Welcome!')
            ->replyTo('alexander.gekov00@gmail.com', 'Aleksandar Gekov');
    }
}
