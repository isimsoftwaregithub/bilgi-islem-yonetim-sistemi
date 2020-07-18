<?php
ob_start();
include '../db/mysql_baglan.php';
if(isset($_POST["adi_soyadi"])){
if($_POST["adi_soyadi"]==""){
	echo "<img src='images/error.png'/>Lütfen Firma Çalışan Adını Giriniz!..." ;
	return 0;
}
}
else{
	echo "<img src='images/error.png'/> Hatalı Bir İşlem Yaptınız!...";
	die();
}
if(isset($_POST["firma"])){
if($_POST["firma"]==""||$_POST["firma"]==null){
	echo "<img src='images/error.png'/> Lütfen Firma Adını Giriniz!...";
	return 0;
}
}
else{
	echo "<img src='images/error.png'/> Hatalı Bir İşlem Yaptınız!...";
	die();
}



   
$sql_insert_firmacal="
					INSERT INTO firma_calisanlari
						( firma_id, adi_soyadi, telefon, eposta)
					VALUES 
						(".$_POST["firma"]." , '".$_POST["adi_soyadi"]."', '".$_POST["telefon"]."', '".$_POST["eposta"]."');";


$sql_insert_firmacal=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_firmacal);

if (!mysql_query($sql_insert_firmacal,$link))
		  {
			 	 echo "Yeni Firma Ekle ->". mysql_error();
			 	 return 0;
		  }


include '../db/mysql_baglanma.php';
ob_end_flush();