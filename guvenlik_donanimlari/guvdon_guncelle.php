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
				echo "SAN Controller Sayısı Giriniz !";
				return 0;
			}
			if($controller_basina_dusen_port_sayisi_san=="" || $controller_basina_dusen_port_sayisi_san=="0")
			{
				echo "SAN Controller Başına Düşen Port Sayısı Giriniz !";
				return 0;
			}
		}
		else{
			$port_sayisi_san=$_POST["port_sayisi"];
			if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo  "SAN Port Sayısı Giriniz !";
				return 0;
			}
			
		}
		
	}
	else{
		$port_sayisi_san=$_POST["port_sayisi"];
		if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo "SAN Port Sayısı Giriniz !";
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
				echo "Ethernet Controller Sayısı Giriniz !";
				return 0;
			}
			if($eth_controller_basina_dusen_port_sayisi=="" || $eth_controller_basina_dusen_port_sayisi=="0")
			{
				echo  "Ethernet Controller Başına Düşen Port Sayısı Giriniz !";
				return 0;
			}
		}
		else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo  "Ethernet Port Sayısı Giriniz !";
				return 0;
			}
		}
		
	}
	else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo  "Ethernet Port Sayısı Giriniz !";
				return 0;
			}
	}
}

if(isset($_POST["guvdon_adi"])){
if($_POST["guvdon_adi"]==""){
	echo "Lütfen Depolama Unitesi Adını Giriniz !";
	return 0;
}
}
else{
	echo "Hatalı Bir İşlem Yaptınız";
	die();
}
ob_start();
include '../db/mysql_baglan.php';
if($_POST["guvdon_id"]==""){
	echo "Hata Oluştu (Depolama Unitesi Bulunumadı)!";
	return 0;
}
$guvdon_id=$_POST["guvdon_id"];
$not= iconv('UTF-8','ISO-8859-9',$_POST['guvdon_notlar']);

$sql_update="
UPDATE
	guvenlik_donanimlari
SET

	guvdon_adi = '".$_POST["guvdon_adi"]."',
	guvdon_serino = '".$_POST["guvdon_serino"]."',
	guvdon_ip = '".$_POST["guvdon_ip"]."',
	guvdon_notlar = '".$_POST["guvdon_notlar"]."',
	guvdon_demirbasno = '".$_POST["guvdon_demirbasno"]."',
	aktif =".$_POST["aktif"]."
	WHERE 	guvdon_id = $guvdon_id;
";

mysql_query("BEGIN");
$sql_update=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_update);
$query_update=mysql_query($sql_update,$link);

if (!$query_update)
		  {
			 	 echo "Depuni GUNCELLE ->". mysql_error();
			 	 mysql_query("ROLLBACK");  
			 	 return 0;
		  }
else{
	
	
	
if($_POST['aktif']==1){
if(isset($_POST["eth_sw"])){
$select_donanimag_eth="SELECT controller_sayisi, controller_basina_dusen_port_sayisi,port_sayisi From donanim_ag_bilesenleri 
WHERE port_turu =2 and donanim_tip = 9 and donanim_tip_id =".$guvdon_id." ;";
$row_eth=mysql_fetch_array(mysql_query($select_donanimag_eth));
if($row_eth["controller_sayisi"]>$eth_controller_sayisi)
{
	echo iconv('ISO-8859-9', 'UTF-8', "Yeni Eth. Controller Sayısı Eski Eth. Controller Sayısından küçük olamaz !");
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}
if($row_eth["port_sayisi"]>$eth_port_sayisi)
{
	echo iconv('ISO-8859-9', 'UTF-8', "Yeni Eth. Port Sayısı Eski Eth. Port Sayısından Küçük olamaz !");
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}

if($row_eth["controller_sayisi"]=="")
{
	$ii=1;
}
else{
	$ii=$row_eth["controller_sayisi"]+1;
}

if($row_eth["port_sayisi"]=="")
{
	$ii2=1;
	$sql_update_eth_donanim_ag_bilesenleri="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(2,9,".$guvdon_id." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
}
else{
	$ii2=$row_eth["port_sayisi"]+1;
	$sql_update_eth_donanim_ag_bilesenleri ="UPDATE
	donanim_ag_bilesenleri
	SET
	controller_sayisi =".$controller_sayisi_san." ,
	controller_basina_dusen_port_sayisi =".$controller_basina_dusen_port_sayisi_san." ,
	port_sayisi = ".$port_sayisi_san."
	WHERE port_turu =2 and donanim_tip =9 and donanim_tip_id =".$guvdon_id." ;
	";
}

	if (!mysql_query($sql_update_eth_donanim_ag_bilesenleri,$link))
	{
		echo "sql_eth ->". mysql_error();
		return 0;
	}	
	else{
		if($eth_controller_sayisi>0){
		for($i=$ii;$i<=$eth_controller_sayisi;$i++){
		for($j=1;$j<=$eth_controller_basina_dusen_port_sayisi;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(2,9,".$guvdon_id." ,'".$_POST["guvdon_adi"]."_cnt".$i."', 'P".$j."', '');";
			$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
		if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "Ağ bileşeni ekleme başarısız".mysql_error();
					}
		}
			
		}
		}else{
			if($eth_port_sayisi>0)
			{
					for($i=$ii2;$i<=$eth_port_sayisi;$i++)
					{
						$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
						(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
						VALUES 
						(2,9,".$guvdon_id." ,'', '',  '".$_POST["guvdon_adi"]."-P".$i."');";
						$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
					if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
	}
}
if(isset($_POST["san"])){
$select_donanimag_san="SELECT controller_sayisi, controller_basina_dusen_port_sayisi,port_sayisi From donanim_ag_bilesenleri 
WHERE port_turu =1 and donanim_tip=9 and donanim_tip_id =".$guvdon_id." ;";
$row_san=mysql_fetch_array(mysql_query($select_donanimag_san));
if($row_san["controller_sayisi"]>$controller_sayisi_san)
{
	echo iconv('ISO-8859-9', 'UTF-8', "Yeni SAN Controller Sayısı Eski SAN. Controller Sayısından küçük olamaz !");
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}

if($row_san["port_sayisi"]>$port_sayisi_san)
{
	echo iconv('ISO-8859-9', 'UTF-8', "Yeni SAN Port Sayısı Eski SAN Port Sayısından Küçük olamaz !");
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}

if($row_san["controller_sayisi"]=="")
{
	$ii=1;
}
else{
	$ii=$row_san["controller_sayisi"]+1;
}


if($row_san["port_sayisi"]=="")
{
	$ii2=1;
	$sql_update_san_donanim_ag_bilesenleri="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(1,9,".$guvdon_id." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
}
else{
	$ii2=$row_san["port_sayisi"]+1;
	$sql_update_san_donanim_ag_bilesenleri ="UPDATE
	donanim_ag_bilesenleri
	SET
	controller_sayisi =".$controller_sayisi_san." ,
	controller_basina_dusen_port_sayisi =".$controller_basina_dusen_port_sayisi_san." ,
	port_sayisi = ".$port_sayisi_san."
	WHERE port_turu =1 and donanim_tip = 9 and donanim_tip_id =".$guvdon_id." ;
	";
}


	if (!mysql_query($sql_update_san_donanim_ag_bilesenleri,$link))
	{
		echo "sql_eth ->". mysql_error();
		return 0;
	}	
	else{
		if($controller_sayisi_san>0){
		for($i=$ii;$i<=$controller_sayisi_san;$i++){
		for($j=1;$j<=$controller_basina_dusen_port_sayisi_san;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(1,9,".$guvdon_id." ,'".$_POST["guvdon_adi"]."_cnt".$i."', 'P".$j."', '');";
			$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
		if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "Ağ bileşeni ekleme başarısız--".mysql_error();
					}
		}
			
		}
		}else{
		
			if($port_sayisi_san>0)
			{
					for($i=$ii2;$i<=$port_sayisi_san;$i++)
					{
						$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
						(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
						VALUES 
						(1,9,".$guvdon_id." ,'', '',  '".$_POST["guvdon_adi"]."-P".$i."');";
						$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
					if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "Ağ bileşeni ekleme başarısız--".mysql_error();
					}
					}
			}
		}
	}

	}
	
}
else{
	
	$sql_donanim_ag_bilesenleri="UPDATE
	donanim_ag_bilesenleri_detay
	SET
	aktif =".$_POST['aktif']."
	WHERE donanim_tip=9 and donanim_tip_id=$depuni_id ;";	
	
	if(!mysql_query($sql_donanim_ag_bilesenleri))
	{
		echo "Donanim Ağ Bileşenleri--".mysql_error();
	}
	
	$sql_del_depuni_sunucu="DELETE FROM depuni_sunucu WHERE depuni_id=$depuni_id;";
	
	if(!mysql_query($sql_del_depuni_sunucu)){
		echo "Depolama UnitesixSunucu Bilgileri Güncellenemedi--".mysql_error();
	}
	
	
}	
	


}


mysql_query("COMMIT");
echo "Güncelleme Başarılı !";
include '../db/mysql_baglanma.php';
ob_end_flush();