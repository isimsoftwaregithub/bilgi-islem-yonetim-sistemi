<?php
session_start();
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']==1){	
	ob_start();


if($_POST["ad"]==""||$_POST["soyad"]==""){
			echo "<img src='images/error.png'/> Lütfen Ad Soyad Bilgisini Giriniz!...<br/> ";
			return 0;

}
if($_POST["sicilno"]==""){
	echo "<img src='images/error.png'/> Sicil No Bilgisini Giriniz!...<br/> ";
			return 0;

}
if($_POST["email"]==""){
	echo "<img src='images/error.png'/> Email Bilgisini Giriniz!...<br/> ";
			return 0;
}
if($_POST["ip1"]==""){
	echo "<img src='images/error.png'/> IP-1  Bilgisini Giriniz!...<br/> ";
			return 0;
}
if($_POST["sifre"]==""){
	echo "<img src='images/error.png'/> Şifre Bilgisini Giriniz!...<br/> ";
			return 0;
}
include '../db/mysql_baglan.php';
include '../log/log.php';
$ad=addslashes($_POST["ad"]);
$soyad=addslashes($_POST["soyad"]);
$IP1=addslashes($_POST["ip1"]);
$IP2="";
if(isset ($_POST["IP2"])){
$IP2=$_POST["IP2"];
}
$yetki="2";
if(isset ($_POST["yetki"])){
$yetki=$_POST["yetki"];
}
$aktif="1";
if(isset ($_POST["aktif"])){
$aktif=$_POST["aktif"];
}
$email=addslashes($_POST["email"]);
$sicilno=$_POST["sicilno"];
$sifre=$_POST["sifre"];
$gorev=$_POST["gorev"];
$tel=$_POST["tel"];
$resim_link="http://pdks.mgm.gov.tr:8080/smartcard/kisiResimler/";
$sql_insert_personel="
		INSERT INTO uyeler
		(sicilno, ad, soyad, email, sifre, ip1,ip2, yetki_id, aktif, resim_link, resim_ad,gorev,tel)
		VALUES 
		('".$sicilno."', '".$ad."', '".$soyad."', '".$email."', '".$sifre."', '".$IP1."','".$IP2."','.$yetki.' ,'.$aktif.' , '".$resim_link."', '".$sicilno.".jpg','".$gorev."','".$tel."');";


if (!mysql_query($sql_insert_personel,$link))
  {
		echo "<img src='images/error.png'/> Personel Ekleme Başarısız!...<br/> Sql Hatası".mysql_error();
		include '../db/mysql_baglanma.php';
		return 0;
  }



logall("Yeni Personel",$ad." ".$soyad."", "1");
 echo "<img src='images/success.png'/> Yeni Personel Ekleme Başarılı!...";
 include '../db/mysql_baglanma.php';
ob_end_flush();
	}
}