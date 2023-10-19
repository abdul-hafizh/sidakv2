<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PerencanaanMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $url;
    public $periode;
    public $daerah_name;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$url,$periode,$daerah_name,$judul,$kepada,$subject,$pesan)
    {
        $this->username = $username;
        $this->url = $url;
        $this->periode = $periode;
        $this->daerah_name = $daerah_name;
        $this->judul = $judul;
        $this->kepada = $kepada;
        $this->subject = $subject;
        $this->pesan = $pesan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME', 'SIDAK BKPM'))->subject('Permohonan Persetujuan/Approval Perencanaan DAK tahun ' . $this->periode . ' Kab/Prop ' . $this->daerah_name)->view('mail.perencanaan');

    }
}
