 <script type="text/javascript" >
	 $(document).ready(function(){
		  

		  
			
			 $("#s_d").find('a').click(function(){
		
				 var id = $(this).attr("id");
				//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>

<?php
ob_start();

if(!isset($_GET["sid"]))
{
	include 'db/mysql_baglan.php';
	$where="";
	$sql_sunucular="SELECT sunucuID FROM sunucular where 1=1 ";

//Eğer Fiziksel, Sanallaştırma veya Sanal Seçilmiş ise
	if (isset($_GET["t"]))
	{	
		$where ="AND sunucu_tur_id='".$_GET["t"]."'";	
	}
	$sql_sunucular.=" ".$where;
	$result=mysql_query($sql_sunucular,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	$sid=$row['sunucuID'];	
}

else
{

	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$sid=$_GET["sid"];
}

	$sql_sunucular="SELECT sunucuID ,sunucu ,sunucu_gorevi,notlar,serino,cpu_turu ,cpu_soket_sayisi ,
	cpu_soket_core_sayisi ,cpu_frekansi ,disk_turu ,dosyalama_tipi ,yerel_disk_yapisi,
	dosya_sistemi ,ip_adresi1 ,ip_adresi2 ,isletim_sistemi ,lokasyon
 	,optik_okuyucu ,ram_soket_sayisi ,dolu_soket_sayisi ,ram_toplami ,
 	ram_turu ,marka ,model ,sunucu_tipi ,sunucu_turu ,yerel_disk_bilgileri ,
 	alim_tarihi ,garanti_suresi,sunucu_demirbasno,arsiv_sebebi FROM sunucular where sunucuID='".$sid."' " ;
	$sid2=$sid;
	//echo $sql_sunucular ;
	$result=mysql_query($sql_sunucular,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	$sbilgi="";
	$sid="";
	$s="";
if(trim($row['sunucu_turu'])=="Sanal Sunucu")
{
	$sql_sunucular2=" select s.sunucuID,sunucu,ip_adresi1 from sanal_sanallastirma ss left join sunucular s on s.sunucuID=ss.parentID where ss.sunucuID=".$row['sunucuID']."";
	$result2=mysql_query($sql_sunucular2,$link);
	$row2=mysql_fetch_array($result2,MYSQL_BOTH);
	$sid=$row2['sunucuID'];
	$s="s_d";
	$sbilgi='( '.$row2['sunucu'].' isimli '.$row2['ip_adresi1'].' ip adresine sahip   sanallaştırma sunucusu üzerinde)';	
}
if(trim($row['sunucu_turu'])=="Sanallaştırma Sunucusu"){
	$s="s_l";
	$sid=$row['sunucuID'];
	$sbilgi='(Bu sanallaştırma sunucusu üzerindeki sanal makineleri görüntüle)';
}
if ($row['notlar']=="")
{
	$not="Henüz bir not eklenmemiş";
}
else{
	$not=$row['notlar'];
}
	$sql_lokasyon="SELECT lokasyon FROM lokasyonlar;";
	$result=mysql_query($sql_lokasyon,$link);
	$row_lokasyon=mysql_fetch_array($result,MYSQL_BOTH);
	
	$sql_firma="SELECT f.firma,f.telefon,f.web,f.adres FROM firma_sunucu fs
	LEFT JOIN firmalar f on f.firma_id=fs.firma_id
	WHERE sunucu_id='".$sid2."';";
	$result=mysql_query($sql_firma,$link);
	$row_firma=mysql_fetch_array($result,MYSQL_BOTH);
	
	$sql_firma_calisan_sunucu="SELECT firma_cal_id FROM firma_sunucu WHERE sunucu_id='".$sid2."';";
	$result=mysql_query($sql_firma_calisan_sunucu,$link);
	$firma_calisan="";
	if(mysql_num_rows($result)>0)
	{
		$row_calisan=mysql_fetch_array($result,MYSQL_BOTH);
		$sql_firma_calisanlari="SELECT * FROM firma_calisanlari WHERE firmacal_id in (".$row_calisan["firma_cal_id"].") ORDER BY adi_soyadi";
		$result=mysql_query($sql_firma_calisanlari,$link);
		if(mysql_num_rows($result)>0)
		{
			while ($row_calisan=mysql_fetch_array($result,MYSQL_BOTH))
			{
				$firma_calisan=$row_calisan['adi_soyadi'].' '.$row_calisan['telefon'].' '.$row_calisan["eposta"].'<br />'.$firma_calisan;
			}
		}
	}
	
	$harici_disk_bilgileri="";
	$sql_harici_disk_bilgileri=" SELECT 	depuni_sunucu_aciklama,	disk_yapisi,du.depuni_adi,du.depuni_notlar
 								 FROM depuni_sunucu d LEFT JOIN depolama_uniteleri du on d.depuni_id=du.depuni_id 
 								 WHERE sunucu_id='".$sid2."';";
	$result=mysql_query($sql_harici_disk_bilgileri,$link);
	$row_harici=mysql_fetch_array($result,MYSQL_BOTH);

echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;" id="s_d"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar-Arşivlenme Sebebi</legend>'.$not.'<br/>'.$row['arsiv_sebebi'].'
	</fieldset> 
 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Sunucu Adı</th><td class="even" vAlign="top" align="left">'.$row['sunucu'].' </td></tr>
 <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Sunucu Görevi</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_gorevi'].'</td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="even" vAlign="top" align="left">'.$row['sunucu_turu'].' </td></tr>
 <tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">IP Adresi</th><td class="odd"vAlign="top" align="left">'.$row['ip_adresi1'].' '.$row['ip_adresi2'].'</td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">Marka / Model</th><td class="even" vAlign="top" align="left">'.$row['marka'].'  '.$row['model'].' </td></tr>
  <tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">İşletim Sistemi</th><td class="odd" vAlign="top" align="left">'.$row['isletim_sistemi'].' </td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">Sistem Odası</th><td class="even" vAlign="top" align="left">'.$row_lokasyon['lokasyon'].' </td></tr>
 <tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">Sunucu Tipi</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_tipi'].' </td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">CPU Türü / Soket sayısı / Soket core sayısı</th><td class="even" vAlign="top" align="left">'.$row['cpu_turu'].'  '.$row['cpu_soket_sayisi'].'*'.$row['cpu_soket_core_sayisi'].'</td></tr>
<tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">Dosyalama Türü/Sistemi</th><td class="odd" vAlign="top" align="left">'.$row['dosyalama_tipi'].'  '.$row['dosya_sistemi'].' </td></tr>
<tr class="even"><th class="even"  vAlign="top" scope="row" align="left">Ram Türü / Toplamı</th><td class="even" vAlign="top" align="left">'.$row['ram_turu'].'  '.$row['ram_toplami'].' </td></tr>
<tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">Ram Toplam / Dolu Soket Sayısı</th><td class="odd" vAlign="top" align="left">'.$row['ram_soket_sayisi'].'  '.$row['dolu_soket_sayisi'].' </td></tr>
<tr class="even"><th class="even" vAlign="top" scope="row" align="left">Yerel Disk Bilgileri</th><td class="even" vAlign="top" align="left">'.$row['yerel_disk_bilgileri'].' '.$row['yerel_disk_yapisi'].' </td></tr>
<tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Harici Disk Bilgileri</th><td class="odd" vAlign="top" align="left">'.$row_harici['depuni_notlar'].'<br/>'.$row_harici['depuni_adi'].' '.$row_harici['depuni_sunucu_aciklama'].' '.$row_harici['disk_yapisi'].' </td></tr>
<tr class="even"><th class="even" vAlign="top" scope="row" align="left">Alınma Tarihi</th><td class="even" vAlign="top" align="left">'.$row['alim_tarihi'].' </td></tr>
<tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">Garanti Süresi</th><td class="odd" vAlign="top" align="left">'.$row['garanti_suresi'].' </td></tr>
<tr class="even"><th class="even" vAlign="top" scope="row" align="left">Seri No/Demirbaş No</th><td class="even" vAlign="top" align="left">'.$row['serino'].'/'.$row['sunucu_demirbasno'].' </td></tr>
<tr class="odd"><th class="odd" vAlign="top" scope="row" align="left">Firma Bilgileri</th><td class="odd" vAlign="top" align="left">'.$row_firma['firma'].' '.$row_firma['telefon'].' '.$row_firma['web'].' '.$row_firma['adres'].' </td></tr>

<tr class="even"><th class="even" vAlign="top" scope="row" align="left">Firma Çalışanları</th><td class="even" vAlign="top" align="left">'.$firma_calisan.' </td></tr>

</table>';



					

echo '</div>';
	

			




if(isset($_GET["sid"])){
include '../db/mysql_baglanma.php';
	
}else{
include 'db/mysql_baglanma.php';
}
//include 'db/mysql_baglanma.php';
ob_end_flush();

?>
<!--<tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_turu'].'</br> <a  href=index.php?s='.$s.'&sid='.$sid.' >'.$sbilgi.'</a> </td></tr>-->
