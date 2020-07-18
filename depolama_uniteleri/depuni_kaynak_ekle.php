<?php
	
ob_start();
include '../db/mysql_baglan.php';
session_start();
// EĞER BİR SUNUCU İSE 
$dokuman_tip=3;
$dokuman_tip_id=0;
if(!isset($_POST["t"])||$_POST["t"]=="")
{
//	echo "sid-->  ".$_POST["sid"]."<br>";
//$where="";
//$sql_sunucular="SELECT sunucuID ,sunucu ,ip_adresi1 ,isletim_sistemi ,lokasyon
// ,sunucu_turu FROM sunucular where 1=1 ";
////Eğer Fiziksel, Sanallaştırma veya Sanal Seçilmiş ise
//if (isset($_POST["t"]))
//{
//	$where ="AND sunucu_tur_id='".$_POST["t"]."'";
//	
//}
//$sql_sunucular.=" ".$where;
//echo $sql_sunucular."<br>";
//$result=mysql_query($sql_sunucular,$link);
//$row=mysql_fetch_array($result,MYSQL_BOTH);
//$sid=$row['sunucuID'];	
//$dokuman_tip=1;
//echo "sunucu ıd--------->".$sid."<br>";
header('Content-Type: text/html; charset=ISO-8859-9');
die( "Depolama Unitesi Seçiniz !");

}
else{
$dokuman_tip=3;
$did=$_POST['t'];

}

$baslik=$_POST['baslik'];
$aciklama=$_POST['aciklama'];
$kisi_id=$_SESSION['sicilno'];
$anahtar_kelime=$_POST['anahtar_kelime'];
$UploadDirectory	= '../dokumanlar/depolamauniteleri/'; //Upload Directory, ends with slash & make sure folder exist







if (!@file_exists($UploadDirectory)) {
	//destination folder does not exist
		die("Dizin Bulunumadı !");
	
}

if($_POST)
{	
//	if(!isset($_POST['mName']) || strlen($_POST['mName'])<1)
//	{
//		//required variables are empty
//		die("Title is empty!");
//	}
	
	if(!isset($_FILES['file']))
	{
		header('Content-Type: text/html; charset=ISO-8859-9');
		//required variables are empty
		die("Dosya seçiniz !");
		
	}

	
	if($_FILES['file']['error'])
	{
		
		die("Dosya Hatası !");
		
	}

	$FileName			= strtolower($_FILES['file']['name']); //uploaded file name
	$FileTitle			= mysql_real_escape_string($_POST['baslik']); // file title
	$ImageExt			= substr($FileName, strrpos($FileName, '.')+1); //file extension
	$FileType			= $_FILES['file']['type']; //file type
	$FileSize			= $_FILES['file']["size"]; //file size
	$RandNumber   		= rand(0, 9999999999); //Random number to make each filename unique.
	$uploaded_date		= date("Y-m-d H:i:s");
	if($baslik=="")
	{
		$baslik=$FileName;
	
	}

//	switch(strtolower($FileType))
//	{
//		//allowed file types
//		case 'image/png': //png file
//		case 'image/gif': //gif file 
//		case 'image/jpeg': //jpeg file
//		case 'application/pdf': //PDF file
//		case 'application/msword': //ms word file
//		case 'application/vnd.ms-excel': //ms excel file
//		case 'application/x-zip-compressed': //zip file
//		case 'text/plain': //text file
//		case 'text/html': //html file
//		break;
//		default:
//	
//		die();  //output error
//	} 
	//File Title will be used as new File name
//	if(!$FileTitle==""){
//		$NewFileName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), strtolower($FileTitle));
//		$NewFileName = $NewFileName.'_'.$ImageExt;
//	}
//	else{
//		$NewFileName=$FileName;
//	}

	if (@file_exists($UploadDirectory.$FileName)) {
	//destination folder does not exist
	$FileName=$RandNumber."_".$FileName;
		
}	
	
   //Rename and save uploded file to destination folder.
   if(move_uploaded_file($_FILES['file']["tmp_name"], $UploadDirectory . iconv('UTF-8', 'ISO-8859-9', $FileName) ))
   {

	
   		$sql_insert_dokumanlar='INSERT INTO dokumanlar
	( dokuman_tip, dokuman_tip_id, baslik, aciklama, kisiID, dosya_tipi, anahtar_kelimeler, eklenme_tarihi, okunma_sayisi,  dosya_adi, link)
		VALUES 
		( '.$dokuman_tip.','.$did.' , "'.$baslik.'","'.$aciklama.'", "'.$kisi_id.'", "'.$ImageExt.'", "'.$anahtar_kelime.'","'.date("Y-m-d").'" ,0, "'.$FileName.'", "'.$UploadDirectory.'")';
   			
		
		$sql_insert_dokumanlar=iconv('UTF-8', 'ISO-8859-9', $sql_insert_dokumanlar);
		   if (!mysql_query($sql_insert_dokumanlar,$link))
		  {
		 	 die('Error: ' . mysql_error());
		  }
		  else{
	  header('Content-Type: text/html; charset=ISO-8859-9');
	  $_FILES['file']="";
	  echo "Dokuman Ekleme Başarılı...";
		  }
	
   }else{
  	
		//die("");
		echo "Dosya Yüklenemedi!";
   }
}

function upload_errors($err_code) {
	switch ($err_code) { 
        case UPLOAD_ERR_INI_SIZE: 
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini'; 
        case UPLOAD_ERR_FORM_SIZE: 
            return 'Dosya Boyutu Hatalı'; 
        case UPLOAD_ERR_PARTIAL: 
            return 'The uploaded file was only partially uploaded'; 
        case UPLOAD_ERR_NO_FILE: 
            return 'No file was uploaded'; 
        case UPLOAD_ERR_NO_TMP_DIR: 
            return 'Missing a temporary folder'; 
        case UPLOAD_ERR_CANT_WRITE: 
            return 'Failed to write file to disk'; 
        case UPLOAD_ERR_EXTENSION: 
            return 'File upload stopped by extension'; 
        default: 
            return 'Unknown upload error'; 
    } 
} 



include '../db/mysql_baglanma.php';
ob_end_flush();


?>