<?php

namespace App\Helpers;

class GeneralHelpers
{

    /**
     * build child menu
     * @param $child
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public static function dates($tgl, $hari_tampil = true)
    {

        $bulan  = array(
            "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        );
        $hari   = array(
            "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu"
        );
        $tahun_split    = substr($tgl, 0, 4);
        $bulan_split    = substr($tgl, 5, 2);
        $hari_split     = substr($tgl, 8, 2);
        $tmpstamp       = mktime(0, 0, 0, $bulan_split, $hari_split, $tahun_split);
        $bulan_jadi     = $bulan[date("n", $tmpstamp) - 1];
        $hari_jadi      = $hari[date("N", $tmpstamp) - 1];
        if (!$hari_tampil)
            $hari_jadi = "";
        return $hari_jadi . ", " . $hari_split . " " . $bulan_jadi . " " . $tahun_split;
    }

    public static function tanggal_indo($tanggal = null, $time = true, $day = true)
    {

        $date = strtotime($tanggal);

        $hari = date('w', $date);
        $tgl = date('d', $date);
        $bln = date('m', $date);
        $thn = date('Y', $date);

        switch ($hari) {
            case 0:
                $hari = 'Minggu';
                break;
            case 1:
                $hari = 'Senin';
                break;
            case 2:
                $hari = 'Selasa';
                break;
            case 3:
                $hari = 'Rabu';
                break;
            case 4:
                $hari = 'Kamis';
                break;
            case 5:
                $hari = "Jum'at";
                break;
            case 6:
                $hari = 'Sabtu';
                break;
            default:
                $hari = 'UnKnown';
                break;
        }

        switch ($bln) {
            case 1:
                $bln = 'Januari';
                break;
            case 2:
                $bln = 'Februari';
                break;
            case 3:
                $bln = 'Maret';
                break;
            case 4:
                $bln = 'April';
                break;
            case 5:
                $bln = 'Mei';
                break;
            case 6:
                $bln = "Juni";
                break;
            case 7:
                $bln = 'Juli';
                break;
            case 8:
                $bln = 'Agustus';
                break;
            case 9:
                $bln = 'September';
                break;
            case 10:
                $bln = 'Oktober';
                break;
            case 11:
                $bln = 'November';
                break;
            case 12:
                $bln = 'Desember';
                break;
            default:
                $bln = 'UnKnown';
                break;
        }

        if ($time) {
            $day = ($day == true) ? $hari . ', ' : '';
            $format = $day . $tgl . " " . $bln . " " . $thn . ' | ' . strftime('%H:%M', $date) . ' WIB';
        } else {
            $day = ($day == true) ? $hari . ', ' : '';
            $format = $day . $tgl . " " . $bln . " " . $thn;
        }

        return $format;
    }

    public static function urlRegex()
    {
        return "/^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/";
    }

    public  function excuteFileSh($params)
    {

        $data = isset($params['data']) ? $params['data'] : '';
        @exec('sh ' . base_path('sh/' . $params['file']) . ' ' . $params['path'] . ' ' . $data, $output, $return);

        // echo "<br />----------------<br />";
        // if(function_exists('exec')) {
        //     echo "exec is enabled";
        // }
        // echo "<br />----------------<br />";
        // echo '<pre/>'; print_r($output); 
        // echo "<br />----------------<br />";
        // echo '<pre/>'; print_r($return); 
        // echo "<br />----------------<br />";
        // if (!$return) {
        //     echo "Successfully";
        // } else {
        //     echo "failed";
        // }
        // echo "<br />----------------<br />";
        // // shell_exec(base_path('sh/'.$params['file'].' '.$params['path']));
        // echo base_path('sh/'.$params['file']) . ' ' . $params['path'];

        return true;
    }

    public static function  formatNumber($number)
    {
        if (substr($number, 0, 1) === '0') {
            $n = "62" . substr($number, 1);
        } else if (substr($number, 0, 1) === '+') {
            $n = substr($number, 1);
        } else {
            $n = $number;
        }

        $n = str_replace(" ", "", $n);
        $n = str_replace("-", "", $n);
        $n = str_replace('"', "", $n);

        return $n;
    }

    public static function formatRupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

    public static function formatDate($tanggal = null, $time = true, $day = true)
    {

        $date = strtotime($tanggal);
        $tgl = date('d', $date);
        $bln = date('m', $date);
        $thn = date('Y', $date);

        switch ($bln) {
            case 1:
                $bln = 'Januari';
                break;
            case 2:
                $bln = 'Februari';
                break;
            case 3:
                $bln = 'Maret';
                break;
            case 4:
                $bln = 'April';
                break;
            case 5:
                $bln = 'Mei';
                break;
            case 6:
                $bln = "Juni";
                break;
            case 7:
                $bln = 'Juli';
                break;
            case 8:
                $bln = 'Agustus';
                break;
            case 9:
                $bln = 'September';
                break;
            case 10:
                $bln = 'Oktober';
                break;
            case 11:
                $bln = 'November';
                break;
            case 12:
                $bln = 'Desember';
                break;
            default:
                $bln = 'UnKnown';
                break;
        }

        $format = $tgl . " " . $bln . " " . $thn;
        return $format;
    }

    public static function formatExcel($tgl, $hari_tampil = true)
    {

        $tahun_split    = substr($tgl, 0, 4);
        $bulan_split    = substr($tgl, 5, 2);
        $hari_split     = substr($tgl, 8, 2);
        $tmpstamp       = mktime(0, 0, 0, $bulan_split, $hari_split, $tahun_split);
        return date('d/m/Y', $tmpstamp);
    }

    public static function  timeAgo($tanggal)
    {
        $dify = strtotime($tanggal);

        $diff     = time() - $dify;
        $sec     = $diff;
        $min     = round($diff / 60);
        $hrs     = round($diff / 3600);
        $days     = round($diff / 86400);
        $weeks     = round($diff / 604800);
        $mnths     = round($diff / 2600640);
        $yrs     = round($diff / 31207680);


        if ($sec <= 60) {
            return "$sec seconds ago";
        } else if ($min <= 60) {
            if ($min == 1) {
                return "one minute ago";
            } else {
                return "$min minutes ago";
            }
        } else if ($hrs <= 24) {
            if ($hrs == 1) {
                return "an hour ago";
            } else {
                return "$hrs hours ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "Yesterday";
            } else {
                return "$days days ago";
            }
        } else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        } else if ($mnths <= 12) {
            if ($mnths == 1) {
                return "a month ago";
            } else {
                return "$mnths months ago";
            }
        } else {
            if ($yrs == 1) {
                return "one year ago";
            } else {
                return "$yrs years ago";
            }
        }
    }
}
