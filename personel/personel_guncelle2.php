
<?php

ob_start();

include '../db/mysql_baglan.php';

if($_POST["ad"]==""||$_POST["soyad"]==""){
	echo ("Lütfen Ad Soyad Bilgisini Giriniz !");
	die();
}
if($_POST["sicilno"]==""){
	echo ("Lütfen Sicil No Bilgisini Giriniz !");
	die();

}
if($_POST["email"]==""){
	echo ("Lütfen E-Posta Giriniz !");
	die();
}
if($_POST["ip1"]==""){
	echo ("Lütfen IP1 Giriniz !");
	die();
}
if($_POST["sifre"]==""){
	echo ("Lütfen Şifre Giriniz !");
	die();
}
if($_POST["uyeid"]==""){
	?>
			<script type="text/javascript">
				window.location.href("index.php?s=h_s&hm=2");
			</script>
<?php 
}

$uyeid=$_POST["uyeid"];
$ad=addslashes($_POST["ad"]);
$soyad=addslashes($_POST["soyad"]);
$IP1=addslashes($_POST["ip1"]);
$IP2="";
if(isset ($_POST["ip2"])){
$IP2=$_POST["ip2"];
}
$yetki="2";
if(isset ($_POST["yetki"])){
$yetki=$_POST["yetki"];
}
$aktif="1";
if(isset ($_POST["aktif"])){
$aktif=$_POST["aktif"];
}
$ayrilma_sebebi="";
if(isset ($_POST["ayrilma_sebebi"])){
$ayrilma_sebebi=$_POST["ayrilma_sebebi"];
}
$email=addslashes($_POST["email"]);
$sicilno=$_POST["sicilno"];
$sifre=$_POST["sifre"];

$tel=$_POST["tel"];
$resim_link="http://pdks.mgm.gov.tr:8080/smartcard/kisiResimler/";

$sql_update_personel="UPDATE
	uyeler
	SET
	sicilno = '".$sicilno."',
	ad = '".$ad."',
	soyad = '".$soyad."',
	email = '".$email."',
	sifre = '".$sifre."',
	ip1 = '".$IP1."',
	ip2 = '".$IP2."',
	yetki_id = $yetki,
	aktif = $aktif,
	resim_ad='".$sicilno.".jpg', 
	ayrilma_sebebi ='".$ayrilma_sebebi."',
	";
	if(isset ($_POST["gorev"])){
	$gorev=$_POST["gorev"];
	$sql_update_personel.=" gorev = '".$gorev."', ";
	}
	
	$sql_update_personel.=" tel = '".$tel."' WHERE uye_id=$uyeid;";
	$sql_update_personel=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_update_personel);
if (!mysql_query($sql_update_personel,$link))
  {
		echo "Personel güncelel ->". mysql_error();
		return 0;
  }

$sql_insert_loglar="		
		INSERT INTO loglar
		( ip, islem, uye_ip, uye_email, sicil_no)
		VALUES 
		('".$_SERVER['REMOTE_ADDR']."', 'Üye Bilgi Güncelle', '".$IP1."', '".$email."','".$sicilno."' );";
		mysql_query($sql_insert_loglar,$link);
echo "<img src='images/success.png'/> Personel Güncelleme Başarılı!...";
		

include '../db/mysql_baglanma.php';
ob_end_flush();
