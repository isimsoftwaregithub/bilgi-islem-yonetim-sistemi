<?php
if(!isset($_POST["agele_adi"])){
	echo "<img src='images/success.png'/> Ağ Elemanı Adını Giriniz!...";
	return 0;
}

if(!isset($_POST["agele_port_sayisi"])){
	echo "<img src='images/success.png'/> Lütfen Port Sayısı Giriniz!...";
	return 0;
}
ob_start();
include '../db/mysql_baglan.php';



$sql_select="SELECT agele_port_sayisi FROM ag_elemanlari WHERE agele_id = ".$_POST["agele_id"].";";
$result=mysql_query($sql_select);
$row=mysql_fetch_array($result);
$port_sayisi=$row["agele_port_sayisi"];


$sql_insert_ag_elemani="UPDATE ag_elemanlari

	SET
	agele_adi = '".$_POST["agele_adi"]."',
	agele_serino = '".$_POST["agele_serino"]."',
	agele_marka = '".$_POST["agele_marka"]."',
	agele_ip = '".$_POST["agele_ip"]."',
	agele_notlar = '".$_POST["agele_notlar"]."',
	agele_demirbasno = '".$_POST["agele_demirbasno"]."',
	agele_port_sayisi = ".$_POST["agele_port_sayisi"].",
	agele_hizi = '".$_POST["agele_hizi"]."',
	agele_turu =".$_POST["agele_turu"]."
	WHERE agele_id = ".$_POST["agele_id"].";";
	

if(!mysql_query($sql_insert_ag_elemani,$link))
{
	echo "<img src='images/success.png'/> Ağ Elemanı Ekleme Başarısız!...".mysql_error();
	include '../db/mysql_baglanma.php';
	ob_end_flush();
}
else{
	if($port_sayisi<$_POST["agele_port_sayisi"]){
		for ($j=$port_sayisi+1;$j<=$_POST["agele_port_sayisi"];$j++)
		{
			$sql_insert_agele_detay="INSERT INTO agele_port_bilgileri
			(agele_id, agele_port_number)
			VALUES 
			(".$_POST["agele_id"].",".$j." );";
			if(!mysql_query($sql_insert_agele_detay,$link))
			{
				echo "<img src='images/success.png'/> Ağ elemanı Ekleme Başarısız!...".mysql_error();
			}
		}
	}
	elseif($port_sayisi>$_POST["agele_port_sayisi"]){
		for ($j=$_POST["agele_port_sayisi"]+1;$j<=$port_sayisi;$j++){
		$sql_del_agele_detay="DELETE FROM agele_port_bilgileri WHERE agele_id=".$_POST["agele_id"]." AND  agele_port_number=".$j."";
		if(!mysql_query($sql_del_agele_detay,$link))
			{
				echo "<img src='images/success.png'/> Ağ elemanı Ekleme Başarısız!...".mysql_error();
			}
		}
	}
	
	
	

	
}

include '../db/mysql_baglanma.php';
ob_end_flush();