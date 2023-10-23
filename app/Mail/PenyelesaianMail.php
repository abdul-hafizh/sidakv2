<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PenyelesaianMail extends Mailable
{
    use Queueable, SerializesModels;
    public $username;
    public $url;
    public $periode;
    public $semester;
    public $daerah_name;
    public $sub_kegiatan;
    public $judul;
    public $kepada;
    public $subject;
    public $pesan;
    public $type;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$url,$periode,$semester,$daerah_name,$sub_kegiatan,$judul,$kepada,$subject,$pesan,$type)
    {
        $this->username = $username;
        $this->url = $url;
        $this->periode = $periode;
        $this->semester = $semester;
        $this->daerah_name = $daerah_name;
        $this->sub_kegiatan = $sub_kegiatan;
        $this->judul = $judul;
        $this->kepada = $kepada;
        $this->subject = $subject;
        $this->pesan = $pesan;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = env('MAIL_USERNAME', 'SIDAK BKPM');
        $daerah_name = $this->daerah_name;
        $subject = '';

        if ($this->type == 'kirim') {
            $subject = 'Permohonan Approval Penyelesaian Masalah (' . ucwords($this->sub_kegiatan) . ') Tahun ';
        } elseif ($this->type == 'request_edit') {
            $subject = 'Permohonan Approval Request Edit Penyelesaian Masalah (' . ucwords($this->sub_kegiatan) . ') Tahun ';
        } elseif ($this->type == 'revisi') {
            $subject = 'Permohonan Perbaikan Penyelesaian Masalah (' . ucwords($this->sub_kegiatan) . ') Tahun ';
        }

        $subject .= $this->periode . ' Semester ' . $this->semester . ', Kab/Prop ' . $daerah_name;

        return $this->from($from)->subject($subject)->view('mail.penyelesaian');
    }
}
