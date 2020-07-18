<?php
ob_start();
include '../db/mysql_baglan.php';
if(isset($_POST["firma"])){
	if($_POST["firma"]==""){
		echo "<img src='images/error.png'/>Lütfen Firma Adını Giriniz !";
		return 0;
	}
} else {
	echo "<img src='images/error.png'/>Hatalı Bir İşlem Yaptınız";
	return 0;
}

$sql_insert_firmalar="INSERT INTO firmalar
			( firma, adres, telefon, web)
			VALUES 
				('".$_POST["firma"]."', '".$_POST["adres"]."', '".$_POST["telefon"]."', '".$_POST["web"]."');";


$sql_insert_firmalar=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_firmalar);

if (!mysql_query($sql_insert_firmalar,$link)) {
	echo "<img src='images/error.png'/>Yeni Firma Ekleme Başarısız!...". mysql_error();
	
}
echo "<img src='images/success.png'/> Yeni Firma Ekleme Başarılı!...";
logall("Yeni Firma",$_POST["firma"], "1");

include '../db/mysql_baglanma.php';
ob_end_flush();