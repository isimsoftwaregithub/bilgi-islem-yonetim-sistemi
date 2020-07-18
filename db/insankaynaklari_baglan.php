<?php
  ob_start(); 
    //global $link; 
    $link_ase = odbc_connect("ase", "ycalik", "ycalik2013"); 
    if (!$link_ase) { 
        echo "Veritabanı bağlantısında bir hata oluştu!"; 
        exit; 
    } else { 
        //echo "Veritabanı bağlantı tamam!"; 
    } 
    ob_end_flush(); 
    ?>