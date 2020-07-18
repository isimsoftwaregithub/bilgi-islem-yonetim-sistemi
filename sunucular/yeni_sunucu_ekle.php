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
				echo "<img src='images/error.png'/> San Controller Sayısı Giriniz!...";
				return 0;
			}
			if($controller_basina_dusen_port_sayisi_san=="" || $controller_basina_dusen_port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Controller Başına Düşen Port Sayısı Giriniz!...";
				return 0;
			}
		}
		else
		{
			$port_sayisi_san=$_POST["port_sayisi"];
			if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Port Sayısı Giriniz!...";
				return 0;
			}
		}
		
	}
	else{
		$port_sayisi_san=$_POST["port_sayisi"];
		if($port_sayisi_san=="" || $port_sayisi_san=="0")
			{
				echo "<img src='images/error.png'/> SAN Port Sayısı Giriniz!...";
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
				echo "<img src='images/error.png'/> Ethernet Controller Sayısı Giriniz!...";
				return 0;
			}
			if($eth_controller_basina_dusen_port_sayisi=="" || $eth_controller_basina_dusen_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/> Ethernet Controller Başına Düşen Port Sayısı Giriniz!...";
				return 0;
			}
		}
		else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/> Ethernet Port Sayısı Giriniz!...";
				return 0;
			}
		}
		
	}
	else{
		$eth_port_sayisi=$_POST["eth_port_sayisi"];
		if($eth_port_sayisi=="" || $eth_port_sayisi=="0")
			{
				echo "<img src='images/error.png'/> Ethernet Port Sayısı Giriniz!...";
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
	echo "<img src='images/error.png'/> Hatalı Bir İşlem Yaptınız";
	return 0;
}
	
if(isset($_POST["sunucu_turu"])){
	
if ($_POST["sunucu_turu"]=="1")
{	$sunucu_tur_id="1";
	$sunucu_turu="Sanallaştırma Sunucusu";
}
else if($_POST["sunucu_turu"]=="2")
{$sunucu_tur_id="2";
	$sunucu_turu="Sanal Sunucu";
}
else{
	$sunucu_tur_id="3";
	$sunucu_turu="Fiziksel Sunucu";
}
}else{
	$sunucu_tur_id="3";
	$sunucu_turu="Fiziksel Sunucu";
	
}
if(isset($_POST["sunucu_tipi"]))
{
	$sunucu_tipi=$_POST["sunucu_tipi"];
}
else{
	$sunucu_tipi="Rack";
}


$cpu_soket_sayisi=$_POST["cpu_soket_sayisi"];
if($_POST["cpu_soket_sayisi"]==''){
	$cpu_soket_sayisi='null';
}

if(isset($_POST["yerel_disk_yapisi"])){
$yerel_disk_yapisi=$_POST["yerel_disk_yapisi"];
if($yerel_disk_yapisi=="0")
{
	$yerel_disk_yapisi="";
}
}else{
	$yerel_disk_yapisi="";
}

if(isset($_POST["dosyalama_tipi"])){
$dosyalama_tipi=$_POST["dosyalama_tipi"];
}else{
	$dosyalama_tipi="32 Bit";
}
if(isset($_POST["dosyalama_sistemi"])){
$dosyalama_sistemi=$_POST["dosyalama_sistemi"];
}else{
	$dosyalama_sistemi="NTFS";
}

if(isset($_POST["lokasyon"])){
$lokasyon=$_POST["lokasyon"];
}else{
	$lokasyon="1";
}
if(isset($_POST["ram_turu"])){
$ram_turu=$_POST["ram_turu"];
}else{
	$ram_turu="DDR";
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

ob_start();
include '../db/mysql_baglan.php';
include '../log/log.php';
//Sunucu bilgilerini gir;disk türü yerel disk bilgilerinde girileceğinden eklenmedi,optik okuyucu eklenmedi
$sql_insert_sunucular="INSERT INTO sunucular
		( sunucu, sunucu_gorevi,
		notlar, serino, 
		cpu_turu, 
		cpu_soket_sayisi,
		cpu_soket_core_sayisi,
		cpu_frekansi, 
		dosyalama_tipi, 
		dosya_sistemi, 
		ip_adresi1, 
		ip_adresi2, 
		isletim_sistemi, 
		lokasyon,  
		ram_soket_sayisi, 
		dolu_soket_sayisi, 
		ram_toplami, 
		ram_turu, 
		marka, 
		model, 
		sunucu_tipi,
		sunucu_turu, 
		sunucu_tur_id,
		yerel_disk_bilgileri,		
		yerel_disk_yapisi,
		alim_tarihi, 
		garanti_suresi,
		sunucu_demirbasno,
		aktif
		)
VALUES 
	( 
	'".$_POST["sunucu_adi"]."', 
	'".$_POST["sunucu_gorevi"]."', 
	'".$_POST["notlar"]."', 
	'".$_POST["serino"]."', 
	'".$_POST["cpu_turu"]."',
	 ".$cpu_soket_sayisi." , 
	 ".$cpu_soket_core_sayisi." ,
	'".$_POST["cpu_frekansi"]."',
	'".$dosyalama_tipi."',
	'".$dosyalama_sistemi."',
	'".$_POST["ip_adresi1"]."',
	'".$_POST["ip_adresi2"]."',
	'".$_POST["isletim_sistemi"]."',
	'".$lokasyon."',
 	".$ram_toplam_soket_sayisi." ,  
 	".$ram_dolu_soket_sayisi." , 
	'".$ram_toplami."' , 
	'".$ram_turu."',
	'".$_POST["marka"]."', 
	'".$_POST["model"]."',
	'".$sunucu_tipi."',
	'".$sunucu_turu."',
	".$sunucu_tur_id." , 	 
	'".$_POST["yerel_disk_bilgileri"]."', 
	'".$yerel_disk_yapisi."',
	'".$_POST["alinma_tarihi"]."',
	'".$_POST["garanti_suresi"]."' ,
	'".$_POST["sunucu_demirbasno"]."',
	1);
	 ";


$sql_insert_sunucular=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_insert_sunucular);


if (!mysql_query($sql_insert_sunucular,$link))
		  {
				echo "<img src='images/error.png'/> Sunucu Ekleme Başarısız!...".mysql_error();
		  		include '../db/mysql_baglanma.php';
				return 0;
		  }
else{
	
	logall("Yeni Sunucu", $_POST["sunucu_adi"].' ('.$_POST["ip_adresi1"].')', "1");
	
	//EKLENEN SUNUCUNUN IDSINI BUL 
	//BU ID İLE SUNUCU_ (VERİTABANI-FİRMA YAZILIMLAR-KURUMSAL YAZILIMLAR-PAKET YAZILIMLAR-
	//DİĞER YAZILIMLAR VE FİRMA) BİLGİLERİNİ İNSERT ET
	$sql_get_last_sunucu_id="SELECT MAX(sunucuID)as id from sunucular";
	$result=mysql_query($sql_get_last_sunucu_id,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	
	
	if($_POST["sunucu_turu"]=='2')
	{
		$sql_sanal_sunucu="INSERT INTO sanal_sanallastirma(sunucuID, parentID) VALUES (".$row['id'].",".$_POST["sanallastirma_sunuculari"].")";
		//echo $sql_sanal_sunucu.'<br>';
			if (!mysql_query($sql_sanal_sunucu,$link))
		  	{
				echo "<img src='images/error.png'/> Sanallaştırma Sunucusu  Ekleme Başarısız!...".mysql_error();
		  	
		  	}
	}
	
	if($_POST['depolama_unitesi']!='0')
	{
		
		$sql_depuni_sunucu="INSERT INTO depuni_sunucu(sunucu_id, depuni_id, depuni_sunucu_aciklama, disk_yapisi) VALUES (".$row['id'].",".$_POST['depolama_unitesi'].",'".$_POST['depuni_sunucu_aciklama']."','".$_POST['harici_disk_yapisi']."');";
		$sql_depuni_sunucu=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_depuni_sunucu);
		
		//echo $sql_depuni_sunucu;
		if (!mysql_query($sql_depuni_sunucu,$link))
		  	{
					echo "<img src='images/error.png'/> Dep. Unitesi Ekleme Başarısız!...".mysql_error();
		  		
		  	}
	}
	
	//Veritabanı FİRMAsini gir
	 if($_POST['veritabani']!='0')
	{
		$sql_veritabani_sunucu="INSERT INTO veritabani_sunucu (vertab_id,sunucuID) VALUES (".$_POST["veritabani"].",".$row['id'].");";
		//echo $sql_veritabani_sunucu.'<br>';
			if (!mysql_query($sql_veritabani_sunucu,$link))
		  	{
			 	  echo "<img src='images/error.png'/> Veritabanı Ekleme Başarısız!...".mysql_error();
		  		
			 	
		  	}
	}
	if(isset($_POST['firma_yazilimlar']))
		{	
				$firma_yazilimlar='';
				
				if(count($_POST['firma_yazilimlar'])==1 and $_POST['firma_yazilimlar'][0]=='0')
				{
					
				}
				else
				{
					
						foreach ($_POST['firma_yazilimlar'] as $selectedOption){
						if($selectedOption!='0')
			    		$firma_yazilimlar=$selectedOption.','.$firma_yazilimlar;
						}	
			    		//echo $firma_yazilimlar;
						$firma_yazilimlar=substr($firma_yazilimlar, 0,-1);
						//echo $firma_yazilimlar;
				   		$sql_metyaz_sunucu="INSERT INTO metyaz_sunucu (metyaz_id, sunucuID)VALUES ('".$firma_yazilimlar."',".$row['id']." );";
						//echo "metyazılımlar->".$sql_metyaz_sunucu.'<br>';
						if (!mysql_query($sql_metyaz_sunucu,$link))
						{
					 	 echo "<img src='images/error.png'/> Firma Yazılım Ekleme Başarısız!...".mysql_error();
							
						}
					 
				}
		} 
		
		
	if(isset($_POST['kurumsal_yazilimlar']))
	{		$kurumsal_yazilimlar='';
			if(count($_POST['kurumsal_yazilimlar'])==1 and $_POST['kurumsal_yazilimlar'][0]=='0')
				{
					
				}
				else{
				foreach ($_POST['kurumsal_yazilimlar'] as $selectedOption){
					if($selectedOption!='0')
    				$kurumsal_yazilimlar=$selectedOption.','.$kurumsal_yazilimlar;
				}
				$kurumsal_yazilimlar=substr($kurumsal_yazilimlar, 0,-1);
	   			$sql_kuryaz_sunucu="INSERT INTO kuryaz_sunucular(kuryaz_id, sunucu_id)VALUES 	('".$kurumsal_yazilimlar."',".$row['id']." );";
				//echo $sql_kuryaz_sunucu.'<br>';
				if (!mysql_query($sql_kuryaz_sunucu,$link))
			  	{
					 	 echo "<img src='images/error.png'/> Kurumsal Yazılım Ekleme Başarısız!...".mysql_error();
			  						 	 
			  	}
				}
		    
	} 
		
	if(isset($_POST['paket_yazilimlar']))
			{	$paket_yazilimlar='';
				if(count($_POST['paket_yazilimlar'])==1 and $_POST['paket_yazilimlar'][0]=='0'){
					
				}
				else{
					foreach ($_POST['paket_yazilimlar'] as $selectedOption)
					if($selectedOption!='0')
		    		$paket_yazilimlar=$selectedOption.','.$paket_yazilimlar;
				   
					$paket_yazilimlar=substr($paket_yazilimlar, 0,-1);
			   		$sql_pakyaz_sunucu="INSERT INTO pakyaz_sunucu	(pakyaz_id, sunucuID)VALUES 	('".$paket_yazilimlar."',".$row['id']." );";
					//echo $sql_pakyaz_sunucu.'<br>';
					if (!mysql_query($sql_pakyaz_sunucu,$link))
					  {
					 	 echo "<img src='images/error.png'/> Paket Yazılım Ekleme Başarısız!...".mysql_error();
					  
					  }
				}
			
			
			
				
	} 

    
		if(isset($_POST["digyaz_adi"]))
		{	
			if($_POST["digyaz_adi"]!='')
			{
				$digyaz_aciklama="";
				if(isset($_POST["digyaz_aciklama"]))
				{
					$digyaz_aciklama=$_POST["digyaz_aciklama"];
				}
					$sql_digyaz_sunucu="INSERT INTO digyaz_sunucu	( sunucu_id, digyaz_aciklama, digyaz_adi)VALUES 	(".$row['id']." , '".$digyaz_aciklama."', '".$_POST["digyaz_adi"]."');";
					$sql_digyaz_sunucu=iconv('UTF-8', 'ISO-8859-9//IGNORE', $sql_digyaz_sunucu);
					//echo $sql_digyaz_sunucu.'<br>';
				if (!mysql_query($sql_digyaz_sunucu,$link))
				{
					 	 echo "<img src='images/error.png'/> Firma Bilgisi Ekleme Başarısız!...".mysql_error();
											 	 
				}
			}
		}
		
	
		

		if($_POST['firma']!='0')
		{
				$firma_calisanlari='';
				if(isset($_POST['firma_calisanlari'])){
				if(count($_POST['firma_calisanlari'])>0){
					
					foreach ($_POST['firma_calisanlari'] as $selectedOption)
		   			$firma_calisanlari=$selectedOption.','.$firma_calisanlari;
				}
				$firma_calisanlari=substr($firma_calisanlari, 0,-1);
				}
		   		$sql_firma_sunucu="INSERT INTO firma_sunucu	(firma_id, firma_cal_id, sunucu_id)VALUES(".$_POST['firma'].", '".$firma_calisanlari."',".$row['id']." );";
				//echo $sql_firma_sunucu.'<br>';
				if (!mysql_query($sql_firma_sunucu,$link))
				  {
					 	 echo "<img src='images/error.png'/> Firma Bilgisi Ekleme Başarısız!...".mysql_error();
					 	 
				  }

		}
		
		
	if(isset($_POST["eth_sw"])){
	$sql_eth="INSERT INTO donanim_ag_bilesenleri
	(port_turu, donanim_tip, donanim_tip_id, controller_sayisi, controller_basina_dusen_port_sayisi, port_sayisi)
	VALUES 
	(2,1,".$row['id']." ,".$eth_controller_sayisi." ,".$eth_controller_basina_dusen_port_sayisi.",".$eth_port_sayisi.");";
	if (!mysql_query($sql_eth,$link))
	{
		echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
		
	}
	else{
		if($eth_controller_sayisi>0){
		for($i=1;$i<=$eth_controller_sayisi;$i++){
		for($j=1;$j<=$eth_controller_basina_dusen_port_sayisi;$j++){
			$sql_insert_eth_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(2,1,".$row['id']." ,'".$_POST["sunucu_adi"]."_cnt".$i."', 'P".$j."', '');";
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
						(2,1,".$row['id']." ,'', '',  '".$_POST["sunucu_adi"]."-P".$i."');";
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
	(1,1,".$row['id']." ,".$controller_sayisi_san." ,".$controller_basina_dusen_port_sayisi_san.",".$port_sayisi_san.");";
	if (!mysql_query($sql_san,$link))
	{
			 	 echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
			 	
				 ob_end_flush();
			 	
	}else{
		
	if($controller_sayisi_san>0){
		for($i=1;$i<=$controller_sayisi_san;$i++){
		for($j=1;$j<=$controller_basina_dusen_port_sayisi_san;$j++){
			$sql_insert_san_detay="INSERT INTO donanim_ag_bilesenleri_detay
				(port_turu, donanim_tip, donanim_tip_id, controller_adi, controller_port_adi, port_adi)
				VALUES 
				(1,1,".$row['id']." , '".$_POST["sunucu_adi"]."_cnt".$i."', 'P".$j."', '');";
			if(!mysql_query($sql_insert_san_detay,$link)){
			echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
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
						(1,1,".$row['id']." ,'', '',  '".$_POST["sunucu_adi"]."-P".$i."');";
						if(!mysql_query($sql_insert_san_detay,$link)){
						echo "<img src='images/error.png'/> Ağ bileşeni ekleme başarısız".mysql_error();
					}
					}
			}
		}
		
		
	}
	}
	
}
echo "<img src='images/success.png'/> Sunucu Ekleme Başarılı!...";
include '../db/mysql_baglanma.php';
ob_end_flush();