<?php
ob_start();
include '../db/mysql_baglan.php';
header('Content-Type: text/html; charset=ISO-8859-9');
$olay_id=$_GET["oid"];
$sql_olay_ek="SELECT ek_adi,ek_link FROM olay_dokumanlar WHERE olay_id=".$olay_id;
$result_ek=mysql_query($sql_olay_ek,$link);
$ekcount=0;
while($row_ek=mysql_fetch_array($result_ek,MYSQL_BOTH))
{
	$ekcount=$ekcount+1;

	echo '<a href="'.$row_ek["ek_link"].$row_ek["ek_adi"].'" target="_blank" title="Tıklayınız...">'.substr(strrchr($row_ek["ek_adi"], '_'), 1).' </a><br>';
}
if($ekcount==0)
{
	echo "Henüz bir doküman eklenmemiş...!";
}

include '../db/mysql_baglanma.php';
ob_end_flush();
?>