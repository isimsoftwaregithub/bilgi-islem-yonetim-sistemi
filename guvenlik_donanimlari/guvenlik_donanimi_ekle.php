<?php

$port_sayisi_san=0;
$eth_port_sayisi=0;
$controller_basina_dusen_port_sayisi_san=0;
$controller_sayisi_san=0;
$eth_controller_sayisi=0;
$eth_controller_basina_dusen_port_sayisi=0;
if(isset($_POST["san"])){
	if(isset($_POST["cnt_var"])){
		if($_POST["cnt_var"]=="2"){
		$controller_sayisi_san=$_POST["controller_sayisi"];
		$controller_basina_dusen_port_sayisi_san=$_POST["controller_basina_dusen_port_sayisi"];
			if($controller_sayisi_san=="" || $controller_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Controller Sayısı Giriniz !";
				return 0;
			}
			if($controller_basina_dusen_port_sayisi_san=="" || $controller_basina_dusen_port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Controller Başına Düşen Port Sayısı Giriniz !";
				return 0;
			}
		}
		else{
			$port_sayisi_san=$_POST["port_sayisi"];
			if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Port Sayısı Giriniz !";
				return 0;
			}
			
		}
		
	}
	else{
		$port_sayisi_san=$_POST["port_sayisi"];
		if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Port Sayısı Giriniz !";
				return 0;
			}
	}

	
}

if(isset($_POST["eth_sw"])){
		if(isset($_POST["eth_cnt_var"])){
				if($_POST["eth_cnt_var"]=="2"){
		
			$eth_controller_sayisi=$_POST["eth_controller_sayisi"];
			$eth_controller_basina_dusen_port_sayisi=$_POST["eth_controller_basina_dusen_port_sayisi"];
		if($eth_controller_sayisi=="" || $eth_controller_sayisi=="0")
			{
				echo "<img src='images/error.png'/> Ethernet Controller Sayısı Giriniz !";
				return 0;
			}
			if($eth_controller_basina_dusen_port_sayisi=="" || $eth_controller_basina_dusen_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/>Ethernet Controller Başına Düşen Port Sayısı Giriniz !";
				return 0;
			}
		}
		else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/>Ethernet Port Sayısı Giriniz !";
				return 0;
			}
		}
		
	}
	else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/> Ethernet Port Sayısı Giriniz !";
				return 0;
			}
	}
}






if(isset($_POST["guvdon_adi"])){
	if($_POST["guvdon_adi"]=="" ||$_POST["guvdon_adi"]==null ){
	echo "<img src='images/error.png'/> Lütfen Güvenlik Donanımı Adını Giriniz !";
	return 0;
	}
}else{
	echo "<img src='images/error.png'/> Lütfen Güvenlik Donanımı Adını Giriniz !";
	return 0;
	
}

ob_start();
include '../db/mysql_baglan.php';
include '../log/log.php';


$sql_insert_guvdon="INSERT INTO guvenlik_donanimlari
	(guvdon_adi, guvdon_serino, guvdon_ip, guvdon_notlar, guvdon_demirbasno)
VALUES 
	('".$_POST['guvdon_adi']."', '".$_POST['guvdon_serino']."', '".$_POST['guvdon_ip']."', '".$_POST['guvdon_notlar']."', '".$_POST['guvdon_demirbasno']."');";
if(!mysql_query($sql_insert_guvdon,$link))
{
	echo "Güvenlik Donanımı Ekleme Başarısız".mysql_error();
	include '../db/mysql_baglanma.php';
	ob_end_flush();
}
else{
	
	
	logall("Yeni Güvenlik Donanımı",$_POST['guvdon_adi'] , "1");
	$sql_get_last_dep_id="SELECT MAX(guvdon_id)as id from guvenlik_donanimlari";
	$result=mysql_query($sql_get_last_dep_id,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	
	
	if(isset($_POST["eth_sw"])){
	$sql_eth="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(2,9,".$row['id']." ,".$eth_controller_sayisi." ,".$eth_controller_basina_dusen_port_sayisi.",".$eth_port_sayisi.");";
	if (!mysql_query($sql_eth,$link))
	{
		echo "<img src='images/error.png'/> Ethernet Bilgisi Girişi Başarısız.". mysql_error();
		return 0;
	}
	else{
		if($eth_controller_sayisi>0){
		for($i=1;$i<=$eth_controller_sayisi;$i++){
		for($j=1;$j<=$eth_controller_basina_dusen_port_sayisi;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(2,9,".$row['id']." ,'".$_POST["guvdon_adi"]."_cnt".$i."', 'P".$j."', '');";
		if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
		}
			
		}
		}else{
			if($eth_port_sayisi>0)
			{
					for($i=1;$i<=$eth_port_sayisi;$i++)
					{
						$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
						(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
						VALUES 
						(2,9,".$row['id']." ,'', '',  '".$_POST["guvdon_adi"]."-P".$i."');";
					if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
	}
		}
	if(isset($_POST["san"])){
	$sql_san="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(1,9,".$row['id']." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
	if (!mysql_query($sql_san,$link))
	{
			 	echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız!... ". mysql_error();
			 	
	}else{
		
	if($controller_sayisi_san>0){
		for($i=1;$i<=$controller_sayisi_san;$i++){
		for($j=1;$j<=$controller_basina_dusen_port_sayisi_san;$j++){
			$sql_insert_san_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(1,9,".$row['id']." , '".$_POST["guvdon_adi"]."_cnt".$i."', 'P".$j."', '');";
			if(!mysql_query($sql_insert_san_detay,$link)){
				echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız!...".mysql_error();
			}
		}
			
		}
		}else{
			if($port_sayisi_san>0)
			{
				for($i=1;$i<=$port_sayisi_san;$i++)
					{
						$sql_insert_san_detay="INSERT INTO donanim_ag_bilesenleri_detay
						(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
						VALUES 
						(1,9,".$row['id']." ,'', '',  '".$_POST["guvdon_adi"]."-P".$i."');";
						if(!mysql_query($sql_insert_san_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
		
		
	}
	}
	
} 
echo "<img src='images/success.png'/> Başarılı!...";
include '../db/mysql_baglanma.php';
ob_end_flush();