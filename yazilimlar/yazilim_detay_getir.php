
<?php
ob_start();

if(isset($_GET["yid"]))
{	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';

	$ytid=$_GET["ytid"];
	$yid=$_GET["yid"];
	if($ytid==7)
	{
	$sql_pakyaz="SELECT
	pakyaz_adi,
	programlama_dili,
	pakyaz_aciklama
	FROM
	paket_yazilimlar
	where pakyaz_id=".$yid;
	$result=mysql_query($sql_pakyaz,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	
	$sql_pakyazsunucu="
		SELECT
			s.sunucu,s.ip_adresi1,
			pakyaz_adi,sorumlu1,sorumlu2
			FROM
			pakyaz_sunucu p
		left join paket_yazilimlar py on p.pakyaz_id=py.pakyaz_id
		left join sunucular s on p.sunucuID=s.sunucuID
		where p.pakyaz_id like '%$yid%'";
	$result_pakyazsunucu=mysql_query($sql_pakyazsunucu,$link);
	if ($row['pakyaz_aciklama']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['pakyaz_aciklama'];
	}
	echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 
	 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
	 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['pakyaz_adi'].' </td></tr>
	 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Programlama Dili</th><td class="odd" vAlign="top" align="left">'.$row['programlama_dili'].' </td></tr>
	 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left" title="Sunucular Üzerinde">Sunucu</th><td class="even" vAlign="top" align="left">
	
';
while ($row=mysql_fetch_array($result_pakyazsunucu,MYSQL_BOTH))
{
	echo $row["sunucu"].' ('.$row['ip_adresi1'].')<br/>';
	
}
echo '</td></tr>
<tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Sorumlu</th><td class="even" vAlign="top" align="left">'.$row['sorumlu1'].' </td></tr>
<tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Sorumlu</th><td class="even" vAlign="top" align="left">'.$row['sorumlu2'].' </td></tr>
</table></div>';
	
	
	}
	
if($ytid==6)
	{
	$sql_pakyaz="SELECT
	kuryaz_id,
	kuryaz_adi,
	kuryaz_programlama_dili,
	kuryaz_aciklama,
	programlayan,
	sorumlu
	FROM
	kurumsal_yazilimlar
	where kuryaz_id=".$yid;
	$result=mysql_query($sql_pakyaz);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	if ($row['kuryaz_aciklama']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['kuryaz_aciklama'];
	}
	
	
	$sql_kuryazsunucu="
		SELECT
			s.sunucu,s.ip_adresi1,
			kuryaz_adi
			FROM
			kuryaz_sunucular p
		left join kurumsal_yazilimlar py on p.kuryaz_id=py.kuryaz_id
		left join sunucular s on p.sunucu_id=s.sunucuID
		where p.kuryaz_id like '%$yid%'";
	$result_kuryazsunucu=mysql_query($sql_kuryazsunucu,$link);
	
	echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

	 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
	 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['kuryaz_adi'].' </td></tr>
	 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Programla Dili</th><td class="odd" vAlign="top" align="left">'.$row['kuryaz_programlama_dili'].' </td></tr>
	 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left" title="Sunucular Üzerinde">Sunucu</th><td class="even" vAlign="top" align="left">
';
	while ($row1=mysql_fetch_array($result_kuryazsunucu,MYSQL_BOTH))
{
	echo $row1["sunucu"].' ('.$row1['ip_adresi1'].')<br/>';
	
}
echo '</td></tr>';
$sql_prg="
		SELECT
			ad,soyad
			FROM
			uyeler u
		left join kurumsal_yazilimlar ky on u.sicilno=ky.programlayan
		where ky.programlayan=".$row['programlayan'];

	$result_prg=mysql_query($sql_prg);
	$row_prg=mysql_fetch_array($result_prg,MYSQL_BOTH);
$sql_srm="
		SELECT
			ad,soyad
			FROM
			uyeler u
		left join kurumsal_yazilimlar ky on u.sicilno=ky.sorumlu
		where ky.sorumlu=".$row['sorumlu'];
   //echo $sql_srm;
	$result_srm=mysql_query($sql_srm,$link);
	$row_srm=mysql_fetch_array($result_srm,MYSQL_BOTH);
 echo '<tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Programlayan</th><td class="odd" vAlign="top" align="left">'.$row_prg["ad"].' '.$row_prg["soyad"].' </td></tr>
  <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Sorumlu</th><td class="even" vAlign="top" align="left">'.$row_srm["ad"].' '.$row_srm["soyad"].' </td></tr>
</table></div>';
	
	
	}

if($ytid==5)
	{
	$sql_pakyaz="SELECT
	metyaz_id,
	metyaz_adi,
	metyaz_aciklama
	FROM
	firma_yazilimlar
	where metyaz_id=".$yid;
	$result=mysql_query($sql_pakyaz,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	if ($row['metyaz_aciklama']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['metyaz_aciklama'];
	}
	$sql_metyazsunucu="
			SELECT
			s.sunucu,s.ip_adresi1,
			metyaz_adi
			FROM
			metyaz_sunucu p
		left join firma_yazilimlar py on p.metyaz_id=py.metyaz_id
		left join sunucular s on p.sunucuID=s.sunucuID
		where p.metyaz_id like '%$yid%'";
	$result_metyazsunucu=mysql_query($sql_metyazsunucu,$link);
	
	
	echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

	 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
	 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['metyaz_adi'].' </td></tr>

	 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left" title="Sunucular Üzerinde">Sunucu</th><td class="odd" vAlign="top" align="left">
';
		while ($row=mysql_fetch_array($result_metyazsunucu,MYSQL_BOTH))
	{
		echo $row["sunucu"].' ('.$row['ip_adresi1'].')<br/>';
		
	}
echo '</td></tr></table></div>';
	
	
	}
	
	include '../db/mysql_baglanma.php';
}
else
{
echo "Yazılım Seçiniz";
}







	




			



ob_end_flush();

?>
<!--<tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_turu'].'</br> <a  href=index.php?s='.$s.'&sid='.$sid.' >'.$sbilgi.'</a> </td></tr>-->
