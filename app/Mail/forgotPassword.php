<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class forgotPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $url;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$url)
    {
        $this->username = $username;
        $this->url = $url;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME', 'SIDAK BKPM'))->subject('Forgot Password')->view('mail.forgotPassword');

    }
}
