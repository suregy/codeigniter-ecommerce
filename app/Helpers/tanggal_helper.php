<?php

if ( ! function_exists('tanggal')){
    function tanggal($tgl){
        $konv = gmdate($tgl, time()+60*60*8);
        $trim = explode("-",$konv);
        $tgl = $trim[2];
        $bln = bulan($trim[1]); //bulan ambil dr func bulan
        $thn = $trim[0];
        return $tgl.' '.$bln.' '.$thn;
    }
}

if ( ! function_exists('bulan')){
    function bulan($bln){
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
            
            default:
                # code...
                break;
        }
    }
}

if ( ! function_exists('mediumdate_indo')){
    function mediumdate_indo($tgl){
        $konv = gmdate($tgl, time()+60*60*8);
        $trim = explode("-",$konv);
        $tgl = $trim[2];
        $bln = medium_bulan($trim[1]); //bulan ambil dr func bulan
        $thn = $trim[0];
        return $tgl.' '.$bln.' '.$thn;
    }
}

if ( ! function_exists('medium_bulan')){
    function medium_bulan($bln){
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Ags";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
            
            default:
                # code...
                break;
        }
    }
}