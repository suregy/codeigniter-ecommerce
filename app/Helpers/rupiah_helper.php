<?php

if ( ! function_exists('rupiah')){
    function rupiah($nominal){
       $hasil = number_format($nominal,2,',','.');
       return $hasil;
    }
}