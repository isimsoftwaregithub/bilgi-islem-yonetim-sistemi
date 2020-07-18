
<?php

ob_start();
include '../db/mysql_baglan.php';
$filename ="sunucu.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Type: text/html; charset=utf-8');
$id=0;
$where="";
if(isset($_GET["t"])){
	$id=$_GET["t"];
	if($id!=0){
	$where=" AND sunucu_tur_id=".$id;
	}
	
}
	$sql_sunucular="SELECT s.sunucuID,sunucu_gorevi,
	ltrim(notlar)  notlar,
	serino,
	sunucu_demirbasno,
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
	d.depuni_sunucu_aciklama,d.disk_yapisi,du.depuni_adi,vt.vertab_adi,vt.veritabani_ver
	FROM sunucular s left join depuni_sunucu d on d.sunucu_id=s.sunucuID 
	left join depolama_uniteleri du on du.depuni_id=d.depuni_id
	left join veritabani_sunucu v on v.sunucuID=s.sunucuID
    left join veritabanlari vt on vt.vertab_id=v.vertab_id
    WHERE 1=1 AND s.aktif=1 $where 
    order by sunucu_tur_id desc
    ";
	$result=mysql_query($sql_sunucular,$link);
	
	
	

	
?>	

<table  border=1; class="sunucu_rapor">
<thead>
<tr>
<th >Sıra</th>
<th >Sunucu</th>
<!--<th>Sunucu Türü</th>-->
<th>Seri / D.baş No</th>
<th >İşlemci</th>
<th >Ram</th>
<th  >F.Sys.</th>
<th >Y. Disk</th>
<th >H. Disk</th>
<th >IP</th>
<th >OS</th>
<th>DB</th>
<th >Yazılımlar</th>
<th >A. Tar.</th>
<th >Notlar</th>
</tr>
</thead>
<?php 
$sira=1;
$bg="#F5F5F5";
while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
	
	$result_pakyazid=mysql_query("SELECT pakyaz_id from pakyaz_sunucu where sunucuID=".$row['sunucuID']."",$link);
	$in=0;
	if(mysql_num_rows($result_pakyazid)>0){
		$row_pakyazid=mysql_fetch_array($result_pakyazid,MYSQL_BOTH);
		$in=$row_pakyazid["pakyaz_id"];
		
	}

	$sql_pakyaz="SELECT py.pakyaz_adi,py.pakyaz_aciklama,py.programlama_dili FROM pakyaz_sunucu p
				LEFT JOIN sunucular s ON s.sunucuID=p.sunucuID
				LEFT JOIN paket_yazilimlar py ON py.pakyaz_id in (".$in.")
				WHERE s.sunucuID=".$row['sunucuID']."";
	$result_pakyaz=mysql_query($sql_pakyaz,$link);
	
	$result_metyaz_id=mysql_query("SELECT metyaz_id FROM metyaz_sunucu WHERE sunucuID=".$row['sunucuID']."",$link);
	$in=0;
	if(mysql_num_rows($result_metyaz_id)>0){
		$row_metyazid=mysql_fetch_array($result_metyaz_id,MYSQL_BOTH);
		$in=$row_metyazid["metyaz_id"];
	}
	
	
	$sql_metyaz="SELECT my.metyaz_adi,my.metyaz_aciklama FROM metyaz_sunucu m
				LEFT JOIN sunucular s ON s.sunucuID=m.sunucuID 
				LEFT JOIN firma_yazilimlar my ON my.metyaz_id in (".$in.")
				WHERE s.sunucuID=".$row['sunucuID']."";
	
	$result_metyaz=mysql_query($sql_metyaz,$link);
	
	
	$result_kuryaz_id=mysql_query("SELECT kuryaz_id FROM kuryaz_sunucular WHERE sunucu_id=".$row['sunucuID']."",$link);
	$in=0;
	if(mysql_num_rows($result_kuryaz_id)>0){
		$row_kuryazid=mysql_fetch_array($result_kuryaz_id,MYSQL_BOTH);
		$in=$row_kuryazid["kuryaz_id"];
	}
	
	$sql_kuryaz="SELECT ky.kuryaz_adi,ky.kuryaz_aciklama,ky.kuryaz_programlama_dili FROM kuryaz_sunucular k
				LEFT JOIN sunucular s ON s.sunucuID=k.sunucu_id 
				LEFT JOIN kurumsal_yazilimlar ky ON ky.kuryaz_id in (".$in.")
				WHERE s.sunucuID=".$row['sunucuID']."";
	$result_kuryaz=mysql_query($sql_kuryaz,$link);
	
	$sql_digyazilimlar="SELECT digyaz_id, sunucu_id, digyaz_aciklama FROM  digyaz_sunucu2 d
					LEFT JOIN sunucular s ON s.sunucuID=d.sunucu_id 
					WHERE s.sunucuID=".$row['sunucuID']."";
	$result_digyazimlimlar=mysql_query($sql_digyazilimlar,$link);
	
	
	echo "<tbody><tr>
	<td  style='background-color:$bg; width:2px;vertical-align: top'>".$sira."</td>
	<td  style=' background-color:$bg;width:150px;vertical-align: top'>".$row["sunucu_gorevi"]." ".$row["marka"]." ".$row["model"]."</td>
		
	
	<td  style='background-color:$bg; width:100px;vertical-align: top'>".$row["serino"]."  ".$row["sunucu_demirbasno"]."</td>
	<td  style=' background-color:$bg;width:75px;vertical-align: top'>".$row["cpu_turu"]." ".$row["cpu_soket_sayisi"]." ".$row["cpu_soket_core_sayisi"]." ".$row["cpu_frekansi"]."</td>
	<td  style=' background-color:$bg;width:75px;vertical-align: top'>".$row["ram_toplami"]." ".$row["ram_turu"]."</td>
	<td  style=' background-color:$bg;width:50px;vertical-align: top'>".$row["dosyalama_tipi"]." ".$row["dosya_sistemi"]."</td>
	<td  style='background-color:$bg; width:200px;vertical-align: top'>".$row["yerel_disk_bilgileri"]." ".$row["yerel_disk_yapisi"]."</td>
	<td  style='background-color:$bg; width:200px;vertical-align: top'>".$row["depuni_adi"]." ".$row["depuni_sunucu_aciklama"]." ".$row["disk_yapisi"]."</td>
	<td  style='background-color:$bg; width:100px;vertical-align: top'>".$row["ip_adresi1"]." ".$row["ip_adresi2"]."</td>
	<td  style='background-color:$bg; width:75px;vertical-align: top'>".$row["isletim_sistemi"]."</td>
	<td  style='background-color:$bg; width:150px;vertical-align: top'>".$row["vertab_adi"]." ".$row["veritabani_ver"]."</td>
	<td  style='background-color:$bg; width:100px;vertical-align: top'>
	";
	
		if(mysql_num_rows($result_pakyaz)>0)
		{
				

					while ($row_pakyaz=mysql_fetch_array($result_pakyaz,MYSQL_BOTH))
					{
					 echo $row_pakyaz['pakyaz_adi'].'  ';
						
					}
				  
				
		}
		
	if(mysql_num_rows($result_metyaz)>0)
		{
				
					
					while ($row_metyaz=mysql_fetch_array($result_metyaz,MYSQL_BOTH))
					{
					 echo $row_metyaz['metyaz_adi'].'  ';
						
					}
				  
				
		}
		if(mysql_num_rows($result_kuryaz)>0)
		{
			
				 	
					
					while ($row_kuryaz=mysql_fetch_array($result_kuryaz,MYSQL_BOTH))
					{
					 echo $row_kuryaz['kuryaz_adi'].' ';
						
					}
				  
				
		}
//	if(mysql_num_rows($result_digyazimlimlar)>0)
//		{
//			
//				 	
//					
//					while ($row_digyaz=mysql_fetch_array($result_digyazimlimlar,MYSQL_BOTH))
//					{
//					 echo  $row_digyaz['digyaz_aciklama'].' ';
//						
//					}
//				  
//				
//		}
		
	echo "</td><td  style='background-color:$bg; width:62px;vertical-align: top'>".$row["alim_tarihi"]." / ".$row["garanti_suresi"]."</td>
	<td  style='background-color:$bg; width:150px;vertical-align: top'>".str_replace("<br />", "", $row["notlar"])."</td>
	</tr></tbody>";
	$sira=$sira+1;
	if($bg=="#F5F5F5")
	{
		$bg="#FFF";
	}
	else{
		$bg="#F5F5F5";
	}
}

?></table>

<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();
?>