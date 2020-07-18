<?php
  ob_start(); 
    //global $link; 
    $link_mssql = odbc_connect("vcentermssql", "gakdag", "gak*2013"); 
    if (!$link_mssql) { 
        echo "Veritabanı bağlantısında bir hata oluştu!"; 
        exit; 
    } else { 
      // echo "Veritabanı bağlantı tamam!"; 
    } 
    ob_end_flush(); 
    ?>