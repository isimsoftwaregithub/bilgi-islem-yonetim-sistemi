<?php
if(isset($_POST["agele_adi"])){
	if($_POST["agele_adi"]==""||$_POST["agele_adi"]==null){
	echo "<img src='images/error.png'/> Lütfen Ağ Elemanı Adını Giriniz!...";
	return 0;
	}
}
else{
	echo "<img src='images/error.png'/> Lütfen Ağ Elemanı Adını Giriniz !";
	return 0;
}

if(isset($_POST["agele_port_sayisi"])){
	
if($_POST["agele_port_sayisi"]==""||$_POST["agele_port_sayisi"]==null){
	echo "<img src='images/error.png'/> Lütfen Port Sayısı Giriniz !";
	return 0;
	}
	
}
else{
	echo "<img src='images/error.png'/> Lütfen Port Sayısı Giriniz !";
	return 0;
}
ob_start();
include '../db/mysql_baglan.php';

$sql_insert_ag_elemani="INSERT INTO ag_elemanlari
	( agele_adi, agele_serino, agele_marka, agele_ip, agele_notlar, agele_demirbasno, agele_port_sayisi, agele_hizi,agele_turu)
VALUES 
	('".$_POST["agele_adi"]."', '".$_POST["agele_serino"]."', 
	'".$_POST["agele_marka"]."', '".$_POST["agele_ip"]."', 
	'".$_POST["agele_notlar"]."', '".$_POST["agele_demirbasno"]."',
	".$_POST["agele_port_sayisi"]." , '".$_POST["agele_hizi"]."',".$_POST["agele_turu"].");";

if(!mysql_query($sql_insert_ag_elemani,$link))
{
	echo "<img src='images/error.png'/> Ağ Elemanı Ekleme Başarısız".mysql_error();
	include '../db/mysql_baglanma.php';
	ob_end_flush();
}
else{
	$sql_select_max="select max(agele_id) as id,agele_port_sayisi from ag_elemanlari";
	$row_max_id=mysql_fetch_array(mysql_query($sql_select_max,$link));
	for ($j=1;$j<=$row_max_id['agele_port_sayisi'];$j++){
	$sql_insert_agele_detay="INSERT INTO agele_port_bilgileri
	(agele_id, agele_port_number)
	VALUES 
	(".$row_max_id['id'].",".$j." );";
	if(!mysql_query($sql_insert_agele_detay,$link))
	{
		echo "<img src='images/error.png'/> Ağ Elemanı Port Bilgileri Girme Başarısız!..." .mysql_error();
	}
	}
	
}
logall("Yeni Ağ Elemanı",$_POST["agele_adi"]."( ".$_POST["agele_port_sayisi"].")" , $oncelik);
echo "<img src='images/success.png'/> Yeni Ağ Elemanı Ekleme Başarılı!...";

include '../db/mysql_baglanma.php';
ob_end_flush();