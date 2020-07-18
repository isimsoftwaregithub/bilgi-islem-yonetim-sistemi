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
				echo "<img src='images/error.png'/> SAN Controller Sayısı Giriniz!...";
				return 0;
			}
			if($controller_basina_dusen_port_sayisi_san=="" || $controller_basina_dusen_port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Controller Başına Düşen Port Sayısı Giriniz !...";
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
				echo "<img src='images/error.png'/> SAN Port Sayısı Giriniz !" ;
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
				echo "<img src='images/error.png'/> Ethernet Controller Başına Düşen Port Sayısı Giriniz !";
				return 0;
			}
		}
		else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo iconv('ISO-8859-9', 'UTF-8', "Ethernet Port Sayısı Giriniz !");
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

if(isset($_POST["sunucu_adi"])){
if($_POST["sunucu_adi"]==""){
echo "<img src='images/error.png'/> Lütfen Sunucu Adını Giriniz !";
	return 0;
}
}
else{
	echo "Hatalı Bir İşlem Yaptınız";
	die();
}
ob_start();
include '../db/mysql_baglan.php';
if($_POST["sunucu_id"]==""){
	echo "<img src='images/error.png'/> Hata Oluştu (Sunucu Bulunumadı)!";
	return 0;
}
$sunucuID=$_POST["sunucu_id"];


if ($_POST["sunucu_turu"]=="1"){
	$sunucu_turu="Sanallaştırma Sunucusu";
}
else if($_POST["sunucu_turu"]=="2")
{
	$sunucu_turu="Sanal Sunucu";
}
else{
	$sunucu_turu="Fiziksel Sunucu";
}
$sunucu_turu=iconv('ISO-8859-9//IGNORE', 'UTF-8', $sunucu_turu);
$cpu_soket_sayisi=$_POST["cpu_soket_sayisi"];
if($_POST["cpu_soket_sayisi"]==''){
	$cpu_soket_sayisi='null';
	
}

$yerel_disk_yapisi=$_POST["yerel_disk_yapisi"];
if($yerel_disk_yapisi=="0")
{
	$yerel_disk_yapisi="";
}
$cpu_soket_core_sayisi=$_POST["cpu_soket_core_sayisi"];
if($_POST["cpu_soket_core_sayisi"]==''){
	$cpu_soket_core_sayisi='null';
}
$ram_toplam_soket_sayisi=$_POST["ram_toplam_soket_sayisi"];
if($_POST["ram_toplam_soket_sayisi"]==''){
	$ram_toplam_soket_sayisi='null';
}
$ram_dolu_soket_sayisi=$_POST["ram_dolu_soket_sayisi"];
if($_POST["ram_dolu_soket_sayisi"]==''){
	$ram_dolu_soket_sayisi='null';
}
$ram_toplami=$_POST["ram_toplami"];
if($_POST["ram_toplami"]==''){
	$ram_toplami='null';
}

$sql_sunucu_update="UPDATE
	sunucular
SET
	sunucu = '".$_POST["sunucu_adi"]."',
	sunucu_gorevi = '".$_POST["sunucu_gorevi"]."',
	notlar = '".nl2br($_POST["notlar"])."', 
	serino = '".$_POST["serino"]."',
	cpu_turu = '".$_POST["cpu_turu"]."',
	cpu_soket_sayisi =  ".$cpu_soket_sayisi." , 
	cpu_soket_core_sayisi = ".$cpu_soket_core_sayisi." ,
	cpu_frekansi = '".$_POST["cpu_frekansi"]."',
	dosyalama_tipi = '".$_POST["dosyalama_tipi"]."',
	dosya_sistemi ='".$_POST["dosyalama_sistemi"]."',
	ip_adresi1 = '".$_POST["ip_adresi1"]."',
	ip_adresi2 = '".$_POST["ip_adresi2"]."',
	isletim_sistemi = '".$_POST["isletim_sistemi"]."',
	lokasyon = '".$_POST["lokasyon"]."',
	ram_soket_sayisi = ".$ram_toplam_soket_sayisi." ,  
	dolu_soket_sayisi = ".$ram_dolu_soket_sayisi." , 
	ram_toplami = '".$ram_toplami."' ,
	ram_turu = '".$_POST["ram_turu"]."',
	marka = '".$_POST["marka"]."', 
	model = '".$_POST["model"]."',
	sunucu_tipi = '".$_POST["sunucu_tipi"]."',
	sunucu_turu = '".$sunucu_turu."',
	sunucu_tur_id = ".$_POST["sunucu_turu"]." , 
	yerel_disk_bilgileri = '".$_POST["yerel_disk_bilgileri"]."', 
	yerel_disk_yapisi = '".$yerel_disk_yapisi."',
	alim_tarihi = '".$_POST["alinma_tarihi"]."',
	garanti_suresi = '".$_POST["garanti_suresi"]."',
	sunucu_demirbasno = '".$_POST["sunucu_demirbasno"]."'
	WHERE sunucuID=".$sunucuID."";

mysql_query("BEGIN");
$sql_sunucu_update=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_sunucu_update);
$query_sunucu_update=mysql_query($sql_sunucu_update,$link);

if (!$query_sunucu_update)
		  {
			 	 echo "SUNUCU GUNCELLE ->". mysql_error();
			 	 mysql_query("ROLLBACK");  
			 	 return 0;
		  }
else{


	if($_POST["sunucu_turu"]=='2')
	{	
		$sql_del_sanal_sunucu ="DELETE FROM sanal_sanallastirma WHERE sunucuID=".$sunucuID."";
		$query_del_sanal_sunucu=mysql_query($sql_del_sanal_sunucu,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_sanal_sunucu)
		  	{
			 	 echo "<img src='images/error.png'/> Sanal Sunucu Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
		$sql_sanal_sunucu="INSERT INTO sanal_sanallastirma(sunucuID, parentID) VALUES (".$sunucuID.",".$_POST["sanallastirma_sunuculari"].")";
		$query_sanal_sunucu=mysql_query($sql_sanal_sunucu,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_sanal_sunucu)
		  	{
			 	echo "<img src='images/error.png'/> Sanal Sunucu ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
	}
	else{
	$sql_del_sanal_sunucu ="DELETE FROM sanal_sanallastirma WHERE sunucuID=".$sunucuID."";
		$query_del_sanal_sunucu=mysql_query($sql_del_sanal_sunucu,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_sanal_sunucu)
		  	{
			 	 echo "<img src='images/error.png'/> Sanal Sunucu Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
	}
	
	if(isset($_POST['depolama_unitesi'])){
	if($_POST['depolama_unitesi']!='0')
	{
		$sql_del_depolama_unitesi ="DELETE FROM depuni_sunucu WHERE sunucu_id=".$sunucuID."";
		$query_del_depolama_unitesi=mysql_query($sql_del_depolama_unitesi,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_depolama_unitesi)
		  	{
			 	echo "<img src='images/error.png'/> Depolama Unitesi Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
		
		
		$sql_depuni_sunucu="INSERT INTO depuni_sunucu(sunucu_id, depuni_id, depuni_sunucu_aciklama, disk_yapisi) VALUES (".$sunucuID.",".$_POST['depolama_unitesi'].",'".$_POST['depuni_sunucu_aciklama']."','".$_POST['harici_disk_yapisi']."');";
		$sql_depuni_sunucu=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_depuni_sunucu);
		$query_depuni_sunucu=mysql_query($sql_depuni_sunucu,$link);
		//echo $sql_depuni_sunucu;
		if (!$query_depuni_sunucu)
		  	{
			 	echo "<img src='images/error.png'/> Depolama Unitesi->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
	}
	else{
		$sql_del_depolama_unitesi ="DELETE FROM depuni_sunucu WHERE sunucu_id=".$sunucuID."";
		$query_del_depolama_unitesi=mysql_query($sql_del_depolama_unitesi,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_depolama_unitesi)
		  	{
			 	echo "<img src='images/error.png'/> Depolama Unitesi Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
	}
	}
	//Veritabanı bilgisini gir
	 if($_POST['veritabani']!='0')
	{
		
		$sql_del_veritabani_sunucu ="DELETE FROM veritabani_sunucu WHERE sunucuID=".$sunucuID."";
		$query_del_veritabani_sunucu=mysql_query($sql_del_veritabani_sunucu,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_veritabani_sunucu)
		  	{
			 	 echo "<img src='images/error.png'/> Veritabanı Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
		
		
		$sql_veritabani_sunucu="INSERT INTO veritabani_sunucu (vertab_id,sunucuID) VALUES (".$_POST["veritabani"].",".$sunucuID.");";
		//echo $sql_veritabani_sunucu.'<br>';
		$qurey_veritabani_sunucu=mysql_query($sql_veritabani_sunucu,$link);
			if (!$qurey_veritabani_sunucu)
		  	{
			 	echo "<img src='images/error.png'/> Veritabanı ->". mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
	}
	else{
		$sql_del_veritabani_sunucu ="DELETE FROM veritabani_sunucu WHERE sunucuID=".$sunucuID."";
		$query_del_veritabani_sunucu=mysql_query($sql_del_veritabani_sunucu,$link);
		//echo $sql_sanal_sunucu.'<br>';
			if (!$query_del_veritabani_sunucu)
		  	{
			 	 echo "<img src='images/error.png'/> Veritabanı Sil ->".mysql_error();
			 	 mysql_query("ROLLBACK"); 
			 	 return 0;
		  	}
		
	}
	if(isset($_POST['firma_yazilimlar']))
		{	
				$firma_yazilimlar='';
				
				if(count($_POST['firma_yazilimlar'])==1 and $_POST['firma_yazilimlar'][0]=='0')
				{
				$sql_del_metyaz_sunucu ="DELETE FROM metyaz_sunucu WHERE sunucuID=".$sunucuID."";
				$query_del_metyaz_sunucu=mysql_query($sql_del_metyaz_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_metyaz_sunucu)
				  	{
					 	 echo "<img src='images/error.png'/> Metyaz Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
				}
				else
				{
				$sql_del_metyaz_sunucu ="DELETE FROM metyaz_sunucu WHERE sunucuID=".$sunucuID."";
				$query_del_metyaz_sunucu=mysql_query($sql_del_metyaz_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_metyaz_sunucu)
				  	{
					 	echo "<img src='images/error.png'/> Metyaz Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
					
					foreach ($_POST['firma_yazilimlar'] as $selectedOption){
						if($selectedOption!='0')
			    		$firma_yazilimlar=$selectedOption.','.$firma_yazilimlar;
						}	
			    		//echo $firma_yazilimlar;
						$firma_yazilimlar=substr($firma_yazilimlar, 0,-1);
						//echo $firma_yazilimlar;
				   		$sql_metyaz_sunucu="INSERT INTO metyaz_sunucu (metyaz_id, sunucuID)VALUES ('".$firma_yazilimlar."',".$sunucuID." );";
				   		$query_metyaz_sunucu=mysql_query($sql_metyaz_sunucu,$link);
						//echo "metyazılımlar->".$sql_metyaz_sunucu.'<br>';
						if (!$query_metyaz_sunucu)
						{
							 	 echo "<img src='images/error.png'/> Firma Yazılımlar". mysql_error();
							 	 mysql_query("ROLLBACK"); 
							 	 return 0;
						}
					 
				}
		} 
		
	if(isset($_POST['kurumsal_yazilimlar']))
	{		$kurumsal_yazilimlar='';
			if(count($_POST['kurumsal_yazilimlar'])==1 and $_POST['kurumsal_yazilimlar'][0]=='0')
				{
					$sql_del_kuryaz_sunucu ="DELETE FROM kuryaz_sunucular WHERE sunucu_id=".$sunucuID."";
					$query_del_kuryaz_sunucu=mysql_query($sql_del_kuryaz_sunucu,$link);
					//echo $sql_sanal_sunucu.'<br>';
						if (!$query_del_kuryaz_sunucu)
					  	{
						 	 echo "<img src='images/error.png'/> Kuryaz Sunucu Sil ->".mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
					  	}
					
				}
				else{
				$sql_del_kuryaz_sunucu ="DELETE FROM kuryaz_sunucular WHERE sunucu_id=".$sunucuID."";
				$query_del_kuryaz_sunucu=mysql_query($sql_del_kuryaz_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_kuryaz_sunucu)
				  	{
					 	echo "<img src='images/error.png'/> Kuryaz Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
				foreach ($_POST['kurumsal_yazilimlar'] as $selectedOption){
					if($selectedOption!='0')
    				$kurumsal_yazilimlar=$selectedOption.','.$kurumsal_yazilimlar;
				}
				$kurumsal_yazilimlar=substr($kurumsal_yazilimlar, 0,-1);
	   			$sql_kuryaz_sunucu="INSERT INTO kuryaz_sunucular(kuryaz_id, sunucu_id)VALUES 	('".$kurumsal_yazilimlar."',".$sunucuID." );";
				//echo $sql_kuryaz_sunucu.'<br>';
				$query_kuryaz_sunucu=mysql_query($sql_kuryaz_sunucu,$link);
				if (!$query_kuryaz_sunucu)
			  	{
				 	 echo "<img src='images/error.png'/> Kurumsal Yazılımlar ->".mysql_error();
				 	 mysql_query("ROLLBACK"); 
				 	 return 0;
			  	}
				}
		    
	} 
		
	if(isset($_POST['paket_yazilimlar']))
			{	$paket_yazilimlar='';
				if(count($_POST['paket_yazilimlar'])==1 and $_POST['paket_yazilimlar'][0]=='0'){
					$sql_del_pakyaz_sunucu ="DELETE FROM pakyaz_sunucu WHERE sunucuID=".$sunucuID."";
					$query_del_pakyaz_sunucu=mysql_query($sql_del_pakyaz_sunucu,$link);
					//echo $sql_sanal_sunucu.'<br>';
						if (!$query_del_pakyaz_sunucu)
					  	{
						 	 echo "<img src='images/error.png'/> Pakyaz Sunucu Sil ->".mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
					  	}
				}
				else{
					$sql_del_pakyaz_sunucu ="DELETE FROM pakyaz_sunucu WHERE sunucuID=".$sunucuID."";
					$query_del_pakyaz_sunucu=mysql_query($sql_del_pakyaz_sunucu,$link);
					//echo $sql_sanal_sunucu.'<br>';
						if (!$query_del_pakyaz_sunucu)
					  	{
						 	echo "<img src='images/error.png'/> Pakyaz Sunucu Sil ->".mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
					  	}
					foreach ($_POST['paket_yazilimlar'] as $selectedOption)
					if($selectedOption!='0')
		    		$paket_yazilimlar=$selectedOption.','.$paket_yazilimlar;
				   
					$paket_yazilimlar=substr($paket_yazilimlar, 0,-1);
			   		$sql_pakyaz_sunucu="INSERT INTO pakyaz_sunucu	(pakyaz_id, sunucuID)VALUES 	('".$paket_yazilimlar."',".$sunucuID." );";
					//echo $sql_pakyaz_sunucu.'<br>';
					$query_pakyaz_sunucu=mysql_query($sql_pakyaz_sunucu,$link);
					if (!$query_pakyaz_sunucu)
					  {
						 	 echo "<img src='images/error.png'/> Paket Yazılımlar->". mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
					  }
				}
			
			
			
				
	} 
    
		if(isset($_POST["digyaz_adi"]))
		{	
			if($_POST["digyaz_adi"]!='')
			{
				$sql_del_digyaz_sunucu ="DELETE FROM digyaz_sunucu WHERE sunucu_id=".$sunucuID."";
					$query_del_digyaz_sunucu=mysql_query($sql_del_digyaz_sunucu,$link);
					//echo $sql_sanal_sunucu.'<br>';
						if (!$query_del_digyaz_sunucu)
					  	{
						 	echo "<img src='images/error.png'/> Digyaz Sunucu Sil ->".mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
					  	}
				
				$digyaz_aciklama="";
				if(isset($_POST["digyaz_aciklama"]))
				{
					$digyaz_aciklama=$_POST["digyaz_aciklama"];
				}
					$sql_digyaz_sunucu="INSERT INTO digyaz_sunucu	( sunucu_id, digyaz_aciklama, digyaz_adi)VALUES 	(".$sunucuID." , '".$digyaz_aciklama."', '".$_POST["digyaz_adi"]."');";
					$sql_digyaz_sunucu=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_digyaz_sunucu);
					//echo $sql_digyaz_sunucu.'<br>';
					$query_digyaz_sunucu=mysql_query($sql_digyaz_sunucu,$link);
				if (!$query_digyaz_sunucu)
				{
						 	echo "<img src='images/error.png'/> Diğer Yazılımlar". mysql_error();
						 	 mysql_query("ROLLBACK"); 
						 	 return 0;
				}
			}
			else{
				$sql_del_digyaz_sunucu ="DELETE FROM digyaz_sunucu WHERE sunucu_id=".$sunucuID."";
				$query_del_digyaz_sunucu=mysql_query($sql_del_digyaz_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_digyaz_sunucu)
				  	{
					 	 echo "<img src='images/error.png'/> Digyaz Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
			}
			
		}

		if($_POST['firma']!='0')
		{
				$sql_del_firma_sunucu ="DELETE FROM firma_sunucu WHERE sunucu_id=".$sunucuID."";
				$query_del_firma_sunucu=mysql_query($sql_del_firma_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_firma_sunucu)
				  	{
					 	echo "<img src='images/error.png'/> Firma Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
			
				$firma_calisanlari='';
				if(isset($_POST['firma_calisanlari'])){
				if(count($_POST['firma_calisanlari'])>0){
					
					foreach ($_POST['firma_calisanlari'] as $selectedOption)
		   			$firma_calisanlari=$selectedOption.','.$firma_calisanlari;
				}
				
				
				$firma_calisanlari=substr($firma_calisanlari, 0,-1);
				}
				
		   		$sql_firma_sunucu="INSERT INTO firma_sunucu	(firma_id, firma_cal_id, sunucu_id)VALUES(".$_POST['firma'].", '".$firma_calisanlari."',".$sunucuID." );";
		   		$query_firma_sunucu=mysql_query($sql_firma_sunucu,$link);
				//echo $sql_firma_sunucu.'<br>';
				if (!$query_firma_sunucu)
				  {
					 	echo "<img src='images/error.png'/> Firma Sunucu->".mysql_error();
					 	 return 0;
				  }

		}
		else{
				$sql_del_firma_sunucu ="DELETE FROM firma_sunucu WHERE sunucu_id=".$sunucuID."";
				$query_del_firma_sunucu=mysql_query($sql_del_firma_sunucu,$link);
				//echo $sql_sanal_sunucu.'<br>';
					if (!$query_del_firma_sunucu)
				  	{
					 	 echo "<img src='images/error.png'/> Firma Sunucu Sil ->".mysql_error();
					 	 mysql_query("ROLLBACK"); 
					 	 return 0;
				  	}
		}


if(isset($_POST["eth_sw"])){
$select_donanimag_eth="SELECT controller_sayisi, controller_basina_dusen_port_sayisi,port_sayisi From donanim_ag_bilesenleri WHERE port_turu =2 and donanim_tip = 1 and donanim_tip_id =".$sunucuID." ;";
$row_eth=mysql_fetch_array(mysql_query($select_donanimag_eth));
if($row_eth["controller_sayisi"]>$eth_controller_sayisi)
{
	echo "<img src='images/error.png'/> Yeni Eth. Controller Sayısı Eski Eth. Controller Sayısından küçük olamaz !";
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}
if($row_eth["port_sayisi"]>$eth_port_sayisi)
{
	echo "<img src='images/error.png'/> Yeni Eth. Port Sayısı Eski Eth. Port Sayısından Küçük olamaz !";
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
	$sql_update_san_donanim_ag_bilesenleri="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(1,1,".$sunucuID." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
}
else{
	$ii2=$row_eth["port_sayisi"]+1;
	$sql_update_san_donanim_ag_bilesenleri ="UPDATE
	donanim_ag_bilesenleri
	SET
	controller_sayisi =".$controller_sayisi_san." ,
	controller_basina_dusen_port_sayisi =".$controller_basina_dusen_port_sayisi_san." ,
	port_sayisi = ".$port_sayisi_san."
	WHERE port_turu =1 and donanim_tip = 1 and donanim_tip_id =".$sunucuID." ;
	";
}

	if (!mysql_query($sql_update_eth_donanim_ag_bilesenleri,$link))
	{
		echo "<img src='images/error.png'/> sql_eth ->". mysql_error();
		return 0;
	}	
	else{
		if($eth_controller_sayisi>0){
		for($i=$ii;$i<=$eth_controller_sayisi;$i++){
		for($j=1;$j<=$eth_controller_basina_dusen_port_sayisi;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(2,1,".$row['id']." ,'".$_POST["sunucu_adi"]."_cnt".$i."', 'P".$j."', '');";
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
						(2,1,".$row['id']." ,'', '',  '".$_POST["sunucu_adi"]."-P".$i."');";
						$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
					if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
	}
}
if(isset($_POST["san"])){
$select_donanimag_san="SELECT controller_sayisi, controller_basina_dusen_port_sayisi,port_sayisi From donanim_ag_bilesenleri WHERE port_turu =1 and donanim_tip = 1 and donanim_tip_id =".$sunucuID." ;";
$row_san=mysql_fetch_array(mysql_query($select_donanimag_san));
if($row_san["controller_sayisi"]>$controller_sayisi_san)
{
	echo "<img src='images/error.png'/> Yeni SAN Controller Sayısı Eski SAN. Controller Sayısından küçük olamaz !";
	include '../db/mysql_baglanma.php';
	ob_end_flush();
	return 0;
}

if($row_san["port_sayisi"]>$port_sayisi_san)
{
	echo "<img src='images/error.png'/> Yeni SAN Port Sayısı Eski SAN Port Sayısından Küçük olamaz !";
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
	(1,1,".$sunucuID." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
}
else{
	$ii2=$row_san["port_sayisi"]+1;
	$sql_update_san_donanim_ag_bilesenleri ="UPDATE
	donanim_ag_bilesenleri
	SET
	controller_sayisi =".$controller_sayisi_san." ,
	controller_basina_dusen_port_sayisi =".$controller_basina_dusen_port_sayisi_san." ,
	port_sayisi = ".$port_sayisi_san."
	WHERE port_turu =1 and donanim_tip = 1 and donanim_tip_id =".$sunucuID." ;
	";
}


	if (!mysql_query($sql_update_san_donanim_ag_bilesenleri,$link))
	{
		echo "<img src='images/error.png'/> sql_eth ->". mysql_error();
		return 0;
	}	
	else{
		if($controller_sayisi_san>0){
		for($i=$ii;$i<=$controller_sayisi_san;$i++){
		for($j=1;$j<=$controller_basina_dusen_port_sayisi_san;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(1,1,".$sunucuID." ,'".$_POST["sunucu_adi"]."_cnt".$i."', 'P".$j."', '');";
			$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
		if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
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
						(1,1,".$sunucuID." ,'', '',  '".$_POST["sunucu_adi"]."-P".$i."');";
						$sql_insert_eth_detay=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_eth_detay);
					if(!mysql_query($sql_insert_eth_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
	}

	}
	
	}
mysql_query("COMMIT");
echo "<img src='images/success.png'/> Güncelleme Başarılı !";
include '../db/mysql_baglanma.php';
ob_end_flush();