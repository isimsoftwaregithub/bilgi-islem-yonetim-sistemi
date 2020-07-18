<?php
ob_start();
include '../db/mysql_baglan.php';
include '../log/log.php';
$sql_yazilim_ekle="";
$yazilim_turu="";
$yazilim_adi="";
if(isset($_POST['yazturid']))
{
	//echo $_POST['yazturid'];
	if($_POST['yazturid']==5)
	{
		
		$yazilim_turu="Firma Yazımlım";
		if(isset($_POST['metyaz_adi']))
		{
			if($_POST['metyaz_adi']=="" ||$_POST['metyaz_adi']==null)
			{
				echo "<img src='images/error.png'/> Yazılım Adı Giriniz!...";
				include '../db/mysql_baglanma.php';
				return 0;
			}
		}
		$metyaz_aciklama="";
		if(isset($_POST['metyazaciklama']))
		{
			$metyaz_aciklama=$_POST['metyazaciklama'];
		}
		$sql_yazilim_ekle="INSERT INTO firma_yazilimlar ( metyaz_adi, metyaz_aciklama) 
		VALUES ('".$_POST['metyaz_adi']."','".$metyaz_aciklama."')";
		$sql_yazilim_ekle=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_yazilim_ekle);
		//echo $sql_yazilim_ekle;
		$yazilim_adi=$_POST['metyaz_adi'];
	}
	elseif($_POST['yazturid']==6)
	{
		$yazilim_turu="Kurumsal Yazımlım";
		if(isset($_POST['kuryazadi']))
		{
			if($_POST['kuryazadi']=="" ||$_POST['kuryazadi']==null)
			{
				echo "<img src='images/error.png'/> Yazılım Adı Giriniz!...";
				include '../db/mysql_baglanma.php';
				return 0;
				
			}
		}
		$kuryaz_programlama_dili="";
		if(isset($_POST['kuryazprgdili']))
		{
			$kuryaz_programlama_dili=$_POST['kuryazprgdili'];
		}
	   $kuryaz_aciklama="";
		if(isset($_POST['kuryazaciklama']))
		{
			$kuryaz_aciklama=$_POST['kuryazaciklama'];
		}
	   $programlayan="";
		if(isset($_POST['kuryazprog']))
		{
			$programlayan=$_POST['kuryazprog'];
		}
	   $sorumlu="";
		if(isset($_POST['kuryazsorumlu']))
		{
			$sorumlu=$_POST['kuryazsorumlu'];
		}
		$sql_yazilim_ekle="INSERT INTO kurumsal_yazilimlar ( kuryaz_adi, kuryaz_programlama_dili,kuryaz_aciklama,programlayan,sorumlu) 
		VALUES ('".$_POST['kuryazadi']."','".$kuryaz_programlama_dili."','".$kuryaz_aciklama."','".$programlayan."','".$sorumlu."')";
		$sql_yazilim_ekle=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_yazilim_ekle);
		//echo $sql_yazilim_ekle;
			$yazilim_adi=$_POST['kuryazadi'];
	}
elseif($_POST['yazturid']==7)
	{
		$yazilim_turu="Paket Yazımlım";
		if(isset($_POST['pakyaz']))
		{
			if($_POST['pakyazadi']==""||$_POST['pakyazadi']==null)
			{
				echo "<img src='images/error.png'/> Yazılım Adı Giriniz!...";
				include '../db/mysql_baglanma.php';
				return 0;
				
			}
		}
		$pakyaz_programlama_dili="";
		if(isset($_POST['pakyazprgdili']))
		{
			$pakyaz_programlama_dili=$_POST['pakyazprgdili'];
		}
	   $pakyaz_aciklama="";
		if(isset($_POST['pakyazaciklama']))
		{
			$pakyaz_aciklama=$_POST['pakyazaciklama'];
		}
	   $sorumlu1="";
		if(isset($_POST['sorumlu1']))
		{
			$sorumlu1=$_POST['sorumlu1'];
		}
	   $sorumlu2="";
		if(isset($_POST['sorumlu2']))
		{
			$sorumlu2=$_POST['sorumlu2'];
		}
		$sql_yazilim_ekle="INSERT INTO paket_yazilimlar ( pakyaz_adi, programlama_dili,pakyaz_aciklama,sorumlu1,sorumlu2) 
		VALUES ('".$_POST['pakyazadi']."','".$pakyaz_programlama_dili."','".$pakyaz_aciklama."','".$sorumlu1."','".$sorumlu2."')";
		$sql_yazilim_ekle=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_yazilim_ekle);
		//echo $sql_yazilim_ekle;
	$yazilim_adi=$_POST['pakyazadi'];
	}
	
}
else{
	echo "<img src='images/error.png'/> Yazılım Türü Seçiniz";
	return 0;
}
	if(!mysql_query($sql_yazilim_ekle))
		{
			echo "<img src='images/error.png'/> Hata Oluştu!...<br/> Sql Hatası".mysql_error();
			include '../db/mysql_baglanma.php';
				return 0;
		}
logall("Yeni Yazılım","(".$yazilim_turu.") ".$yazilim_adi."", "1");
echo "<img src='images/success.png'/> Yeni Yazılım Ekleme Başarılı!...";
include '../db/mysql_baglanma.php';
ob_end_flush();