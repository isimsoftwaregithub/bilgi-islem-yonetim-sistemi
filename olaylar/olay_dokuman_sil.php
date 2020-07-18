
<?php
session_start();
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']==1){	
ob_start();
include '../db/mysql_baglan.php';

$olay_dokuman_id=$_GET["odid"];
$sql_olay_dokuman_info="SELECT ek_adi,ek_link FROM olay_dokumanlar WHERE olay_dokuman_id=".$olay_dokuman_id;
$result=mysql_query($sql_olay_dokuman_info,$link);
$row_sql_info=mysql_fetch_array($result,MYSQL_BOTH);
$path=$row_sql_info["ek_link"].$row_sql_info["ek_adi"];
echo $path;
if (is_file($path))
{
    unlink($path);
}
else{
	
	die("Dosya Bulunamadı !");  
}


$sql_olay_dokuman_sil="DELETE FROM olay_dokumanlar WHERE olay_dokuman_id=".$olay_dokuman_id;
mysql_query($sql_olay_dokuman_sil) 
or 
die("Silme Hatası!".mysql_error());  

include '../db/mysql_baglanma.php';
ob_end_flush();
	}
}
?>