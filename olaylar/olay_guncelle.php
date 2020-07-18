<form>
<input type="button" value="Geri Dön" 
onClick="javascript: history.go(-1)">
</form>
<?php



ob_start();
session_start();
include '../db/mysql_baglan.php';
include '../log/log.php';

if($_POST["baslik"]==""){
	echo "<img src='../images/error.png'/> Lütfen Başlık Bilgisini Giriniz !";
	exit();

}
if($_POST["aciklama"]==""){
	echo  "<img src='../images/error.png'/> Lütfen İçerik Giriniz !";
	exit();
}
if(isset($_GET["oid"]))
{
	$oid=$_GET["oid"];
}
else{
	
}

$olay_tip=$_POST["olay_tip"];
$olay_tip_id=0;
if(isset($_POST['olay_tip_id2']))
{
	$olay_tip_id=$_POST['olay_tip_id2'];
}
$baslik=addslashes($_POST["baslik"]);
$aciklama=addslashes($_POST["aciklama"]);
$anahtar_kelimeler=addslashes($_POST["anahtar_kelime"]);
$kisi_id=$_SESSION['sicilno'];

$UploadDirectory	= '../olay_ekler/';
if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
		echo  "<img src='../images/error.png'/> Dizin Bulunamadı!";
	die();
	
}


$sql_update_olaylar="UPDATE
	olaylar
	SET
	olay_tip =".$olay_tip." ,
	olay_tip_id =".$olay_tip_id." ,
	baslik = '".$baslik."',
	icerik = '".$aciklama."',
	kisi_id = ".$kisi_id.",
	anahtar_kelimeler = '".$anahtar_kelimeler."',
	eklenme_tarihi ='".date('Y-m-d')."'
	WHERE olay_id = ".$oid." ;";


//$sql_update_olaylar=iconv('UTF-8', 'ISO-8859-9', $sql_update_olaylar);
if (!mysql_query($sql_update_olaylar,$link))
  {
		echo "olay_update ->". mysql_error();
		return 0;
  }
else
  {
  
  	logall("Olay Guncelle", $baslik, "1");
	if(isset($_FILES['files']))
	{


		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
		{	
			$RandNumber= rand(0, 9999999999);
			$file_name = $_FILES['files']['name'][$key];	
			$file_name=$RandNumber."_".addslashes($file_name);
			$extention= substr($file_name, strrpos($file_name, '.')+1); //file extension
			 if(move_uploaded_file($_FILES['files']['tmp_name'][$key], $UploadDirectory . iconv('UTF-8', 'ISO-8859-9', $file_name) ))
   			{
				
				$sql_olay_dokumanlar="INSERT INTO olay_dokumanlar
									  ( olay_id, ek_adi, ek_link, ek_tip)
									  VALUES 
									  (".$oid.", '".$file_name."', '".$UploadDirectory."', '".$extention."');";
				$sql_olay_dokumanlar=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_olay_dokumanlar);
				
	   			if (!mysql_query($sql_olay_dokumanlar,$link))
	  			{
					echo "<img src='../images/error.png'/> ". mysql_error();
					return 0;
	  			}
			}
		}
	} 
  }


		

echo "<img src='../images/success.png'/> Güncelleme Başarılı !";
include '../db/mysql_baglanma.php';
ob_end_flush();
	
