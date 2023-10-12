<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PeriodeExtension extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $url;
    public $year;
    public $semester;
    public $description;
    public $daerah_name;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$url,$year, $semester,$description,$daerah_name)
    {
        $this->username = $username;
        $this->url = $url;
        $this->year = $year;
        $this->semester = $semester;
    
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
         return $this->from(env('MAIL_USERNAME', 'SIDAK BKPM'))->subject('Permohonan perpanjangan periode tahun '.$this->year.' Kab/Prop '. $this->daerah_name.'')->view('mail.periodeextension');

    }
}
