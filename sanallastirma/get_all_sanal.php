<?php

include 'db/mssql_baglan.php';
include 'db/mysql_baglan.php';

$sql_mssql="SELECT 
       vm.[NAME],vm.[IP_ADDRESS] ,
       h.NAME as Host_Name
	 ,dsname 
      ,[MEM_SIZE_MB]
		,[NUM_VCPU]
      ,vm.[BOOT_TIME]
     ,vm.[POWER_STATE]
      ,[GUEST_OS]
      ,[GUEST_FAMILY]
	  ,vci.GUEST_FULL_NAME
      ,vm.[DNS_NAME]   
      ,[VMMWARE_TOOL]
      ,[NUM_NIC]
      ,[NUM_DISK]
      ,vm.[DESCRIPTION]
      ,vm.[ANNOTATION]
      ,D.disk_size
  FROM [VIM_VCDB].[dbo].[VPXV_VMS] as vm 
  left join (SELECT      DISTINCT VM_ID,
         STUFF(
               (SELECT    ', '+  LTRIM(RTRIM (NAME) ) 
               FROM      [VIM_VCDB].[dbo].[VPXV_VM_DATASTORE] B
               left join dbo.VPXV_DATASTORE c on B.DS_ID=c.ID
               WHERE      B.VM_ID = A.VM_ID
               FOR XML PATH('')), 1, 1, '') AS dsname

FROM      [VIM_VCDB].[dbo].[VPXV_VM_DATASTORE] A) as K on K.VM_ID=vm.VMID
left join (SELECT      DISTINCT VM_ID,
         STUFF(
               (SELECT    ', '+  LTRIM(RTRIM (cast(HARDWARE_DEVICE_CAPACITY_IN/1024/1024 as CHAR))+' GB' ) 
               FROM     [VIM_VCDB].[dbo].[VPX_VIRTUAL_DISK] B
               WHERE      B.VM_ID = A.VM_ID
               FOR XML PATH('')), 1, 1, '') AS disk_size

FROM     [VIM_VCDB].[dbo].[VPX_VIRTUAL_DISK] A) as D on D.VM_ID=vm.VMID
 left join dbo.VPXV_HOSTS as h on h.HOSTID=vm.HOSTID

left join [VPX_VM_CONFIG_INFO] as vci on vci.ID=vm.VMID
   where vm.IS_TEMPLATE=0
  order by   vm.[NAME]";
$result_1 = odbc_exec($link_mssql, $sql_mssql) ; 
$satir = odbc_fetch_row($result_1); 

?>
<div id="sanal_sunucu">

<?php 
$added_server=0;
$null=null;
$sira=1;
$bg="#F5F5F5";
 if ( $satir == true ) { 
        $result_1 = odbc_exec($link_mssql, $sql_mssql) ; 
        while ( $row = odbc_fetch_array($result_1) ) { 
        	//echo $sira++;
        	$sql_mysql="SELECT  sunucu FROM SUNUCULAR WHERE  sunucu='".$row['NAME']."'";
        	//echo $sql_mysql."<br>";
        	
        	//echo $row['NAME']."</br>";
        	$result_mysql=mysql_query($sql_mysql,$link);
        	$num_rows = mysql_num_rows($result_mysql);
        	if($num_rows==0){
        		//echo $num_rows;
        		
        		 $dosyalama_tipi='32 Bit'; 
				 if (strpos($row['GUEST_FULL_NAME'],'64') !== false) {
				    $dosyalama_tipi='64 Bit'; 
				}
        		
				$notlar='Henüz bir not eklenmemiş (Veriler VCenter MS SQL Veri Tabanından otomatik olarak  aktarılmıştır)';
        		if($row['ANNOTATION']!="" or $row['ANNOTATION']!=null){
					
						$notlar=$row['ANNOTATION'];		
				}
				
				
				
				//İşletim Sistemi Kontrol Et
				$isletim_sistemi=$row['GUEST_FULL_NAME'];
				 $dosyalama_sistemi="ext3";
				if($row['GUEST_FULL_NAME']==""||$row['GUEST_FULL_NAME']==null){
					$isletim_sistemi="YOK";
					 $dosyalama_sistemi="YOK";
					  $dosyalama_tipi='YOK'; 
				}
        	
//        	 if (strpos($row['GUEST_OS'],'win') !== false) {
//				    $dosyalama_sistemi="NTFS";
//				}
//        	if (strpos($row['GUEST_OS'],'sles11') !== false) {
//				   $isletim_sistemi='Suse Linux Ent. Server 11 (64-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'windows7Server64Guest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2008 R2 (64-bit)';
//				}
//			if (strpos($row['GUEST_OS'],'winNetEnterprise64Guest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2003 (64-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'winLonghorn64Guest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2008 (64-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'freebsd64Guest') !== false) {
//				   $isletim_sistemi='Free BSD (64 Bit)';
//				}
//			if (strpos($row['GUEST_OS'],'other26xLinux64Guest') !== false) {
//				   $isletim_sistemi='Other 2.6.x Linux (64 Bit)';
//				}	
//        	if (strpos($row['GUEST_OS'],'sles10_64Guest') !== false) {
//				   $isletim_sistemi='Suse Linux Ent. Server 10 (64-bit)';
//        	}
//        	if (strpos($row['GUEST_OS'],'sles10Guest') !== false) {
//				   $isletim_sistemi='Suse Linux Ent. Server 10 (32-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'sles64Guest') !== false) {
//				   $isletim_sistemi='Suse Linux Ent. Server 8/9 (64-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'sles64Guest') !== false) {
//				   $isletim_sistemi='Suse Linux Ent. Server 8/9 (64-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'windows7Guest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2008 (32-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'windows7Guest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2008 (32-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'winLonghornGuest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2008 (32-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'winNetEnterpriseGuest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2003 (32-bit)';
//				}
//        	if (strpos($row['GUEST_OS'],'winNetStandardGuest') !== false) {
//				   $isletim_sistemi='Microsoft Windows Server 2003 Standart';
//				}
//        	if (strpos($row['GUEST_OS'],'winXPProGuest') !== false) {
//				   $isletim_sistemi='Microsoft Windows XP Professional (32 Bit)';
//				}
		$disk_size= str_replace("GB", "", $row['disk_size']);
		$disk_size= str_replace(",", "+", $row['disk_size']);
		//echo $disk_size;
        		$sql_insert_sunucular="INSERT INTO sunucular
					( sunucu, sunucu_gorevi,
					notlar, serino, 
					cpu_turu, 
	
					cpu_frekansi, 
					dosyalama_tipi, 
					dosya_sistemi, 
					ip_adresi1, 
					ip_adresi2, 
					isletim_sistemi, 
					lokasyon,  
					
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
				'".$row['NAME']."', 
				'".$row['NAME']."', 
				'".$notlar."', 
				'', 
				'".$row['NUM_VCPU']." vCPU',

				'',
				'".$dosyalama_tipi."',
				'".$dosyalama_sistemi."',
				'".$row['IP_ADDRESS']."',
				'',
				'".$isletim_sistemi."',
				'1',

				'".$row['MEM_SIZE_MB']." MB' , 
				'DDR',
				'', 
				'',
				'RACK',
				'Sanal Sunucu',
				2 , 	 
				'".$disk_size."', 
				'RAID 5',
				'2003-01-01',
				'4 Yıl' ,
				'',
				1);
				 ";
			// echo $sql_insert_sunucular."</br>";;   		
        	if (!mysql_query($sql_insert_sunucular,$link))
		  {
				echo "<img src='images/error.png'/> Sunucu Ekleme Başarısız!...".mysql_error();
		  	
				return 0;
		  }
		  else{
		  		$added_server++;
		  		$sql_get_last_sunucu_id="SELECT MAX(sunucuID)as id from sunucular";
				$result=mysql_query($sql_get_last_sunucu_id,$link);
				$row1=mysql_fetch_array($result,MYSQL_BOTH);
				 $sanalastirma_sunucusu=0;
				// echo $row['Host_Name']."</br>";
		  if (strpos($row['Host_Name'],'1') !== false) {
				   $sanalastirma_sunucusu=20;
				}
		    if (strpos($row['Host_Name'],'2') !== false) {
				   $sanalastirma_sunucusu=21;
				}
		    if (strpos($row['Host_Name'],'3') !== false) {
				   $sanalastirma_sunucusu=22;
				}
		    if (strpos($row['Host_Name'],'4') !== false) {
				   $sanalastirma_sunucusu=23;
				}
		  $sql_sanal_sunucu="INSERT INTO sanal_sanallastirma(sunucuID, parentID) VALUES (".$row1['id']."+1,".$sanalastirma_sunucusu.")";
			//echo $sql_sanal_sunucu;
			if (!mysql_query($sql_sanal_sunucu,$link))
		  	{
				echo "<img src='images/error.png'/> Sanallaştırma Sunucusu  Ekleme Başarısız!...".mysql_error();
		  	
		  	}
		  }
			        	}
        	
        	
        
        }  
   

	
	
}

echo "<img src='images/success.png'/>  TOPLAM : ".$added_server." sanal sunucu eklendi...<br>";

$sql_sanal_sunucular="SELECT sunucu,sunucuID FROM sunucular WHERE sunucu_tur_id=2 AND aktif=1";
$result3=mysql_query($sql_sanal_sunucular,$link);
$yok=0;
$var=0;
$sira=1;
$add_or="";
while ($row3=mysql_fetch_array($result3,MYSQL_BOTH)){
	//echo $sira++;
	if($row3['sunucu']=='yazilimhezarfenkıbrıs'){
		$add_or=" OR VMID=315";
	}
	
	$sql_mysql_varmi="SELECT 
        vm.[NAME]
  		FROM [VIM_VCDB].[dbo].[VPXV_VMS] as vm WHERE vm.NAME='".$row3['sunucu']."' ".$add_or;
  
 //echo $sql_mysql_varmi.'</br>';
  $queryresult = odbc_exec($link_mssql, $sql_mysql_varmi); 
   if ( odbc_num_rows($queryresult) > 0 ) { 
      //echo "VAR___>>".$row3['sunucu']."<br>";
     } else { 
     	echo $row3['sunucu'].'İsimli sunucu arşive gönderildi...!</br>';
     	
          //echo "YOK___>>".$row3['sunucu']."<br>";
           	$sql_arsivle="UPDATE sunucular s SET aktif=0 , arsiv_sebebi='Sanal Sunucu Silindi...!'  where s.sunucuID=".$row3['sunucuID'];
           	$sql_donagbildetay="UPDATE	donanim_ag_bilesenleri_detay SET aktif =0 where donanim_tip=1 AND donanim_tip_id=".$row3['sunucuID'];
           	//echo $sql_arsivle;
        if(!mysql_query($sql_arsivle))
		{
			echo "<img src='images/error.png'/> Sql Hatası Oluştu--".mysql_error()."</br>";
			return 0;
		}
		if(!mysql_query($sql_donagbildetay))
		{
			echo "<img src='images/error.png'/> Ağ Bileşenleri Güncellenemedi--".mysql_error()."</br>";
			return 0;
		}
		
		//echo "<img src='images/success.png'/> Sunucu Arşivleme Başarılı!...</br>";
        $yok++;
    } 
}

echo "<img src='images/success.png'/> ".$yok." tane  sanal sunucu arşive gönderildi...</br>";
?>


</div>


<?php 
//echo "<img src='images/success.png'/> Sunucu  Ekleme Başarılı!...".mysql_error();
include 'db/mysql_baglanma.php';
include 'db/ase_baglanma.php';