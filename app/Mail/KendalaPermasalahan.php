<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KendalaPermasalahan extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $url;
    public $permasalahan;
    public $description;
    public $daerah_name;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$url,$permasalahan,$description,$daerah_name)
    {
        $this->username = $username;
        $this->url = $url;
        $this->permasalahan = $permasalahan;
        $this->description = $description;
        $this->daerah_name = $daerah_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME', 'SIDAK BKPM'))->subject('Kab/Prop '. $this->daerah_name.' meminta tanggapan atas kendala '. $this->permasalahan.'')->view('mail.kendala');

    }
}
