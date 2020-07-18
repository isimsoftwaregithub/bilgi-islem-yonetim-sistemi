<?php
session_start();
if($_POST["baslik"]==""){
		echo "<img src='images/error.png'/> Başlık Giriniz!...";
	exit();

}
if($_POST["aciklama"]==""){
	echo "<img src='images/error.png'/> Açıklama Giriniz!...";
	
	exit();
}
$olay_tip=$_POST["olay_tip"];
$olay_tip_id=0;
if(isset($_POST['olay_tip_id2']))
{
	$olay_tip_id=$_POST['olay_tip_id2'];
}
$baslik=addslashes($_POST["baslik"]);
$aciklama=$_POST["aciklama"];
$anahtar_kelimeler=addslashes($_POST["anahtar_kelime"]);
$kisi_id=$_SESSION['sicilno'];
$UploadDirectory	= '../olay_ekler/';
if (!@file_exists($UploadDirectory)) {
				//destination folder does not exist
		  		echo "<img src='images/error.png'/> Dizin Bulunamadı!...";
				return 0;
	
}
ob_start();


include '../db/mysql_baglan.php';
include '../log/log.php';

$sql_insert_olaylar="
		INSERT INTO olaylar
			( olay_tip, olay_tip_id, baslik, icerik, kisi_id, anahtar_kelimeler, okunma_sayisi, eklenme_tarihi)
		VALUES 
			(".$olay_tip." ,".$olay_tip_id." , '".$baslik."', '".$aciklama."',".$kisi_id." , '".$anahtar_kelimeler."',0,'".date('Y-m-d')."' );";
$sql_insert_olaylar=iconv('UTF-8', 'ISO-8859-9', $sql_insert_olaylar);

if (!mysql_query($sql_insert_olaylar,$link))
  {		
  	
  		echo "<img src='images/error.png'/> Olay Ekleme Başarısız!...<br/> Sql Hatası".mysql_error();
		include '../db/mysql_baglanma.php';
		return 0;
  }
else
  {	
  			
  			
	
  			 header('Content-Type: text/html; charset=ISO-8859-9');
			 echo "<img src='images/success.png'/> Yeni Olay Ekleme Başarılı!...";
		   	 logall("Yeni Olay", $baslik, "1");
  	if(isset($_FILES['files']))
	{
		$sql_get_olay_id="SELECT MAX(olay_id)as olay_id FROM olaylar";
		$result=mysql_query($sql_get_olay_id,$link);
		$row=mysql_fetch_array($result,MYSQL_BOTH);

		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
		{
			$RandNumber= rand(0, 9999999999); //Random number to make each filename unique.
			$file_name = $_FILES['files']['name'][$key];	
			$file_name=$RandNumber."_".addslashes($file_name);
			
			$extention= substr($file_name, strrpos($file_name, '.')+1); //file extension
			 if(move_uploaded_file($_FILES['files']['tmp_name'][$key], $UploadDirectory . iconv('UTF-8', 'ISO-8859-9', $file_name) ))
   			{
			
				$sql_olay_dokumanlar="INSERT INTO olay_dokumanlar
									  ( olay_id, ek_adi, ek_link, ek_tip)
									  VALUES 
									  (".$row['olay_id'].", '".$file_name."', '".$UploadDirectory."', '".$extention."');";
				$sql_olay_dokumanlar=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_olay_dokumanlar);
				
	   			if (!mysql_query($sql_olay_dokumanlar,$link))
	  			{
					echo "<img src='images/error.png'/> Dokuman Ekleme Başarısız!...<br/> Sql Hatası".mysql_error();
					
	  			}
   			
		}
	} 
  }
  }

		

include '../db/mysql_baglanma.php';
ob_end_flush();