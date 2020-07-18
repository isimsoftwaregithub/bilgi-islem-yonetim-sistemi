
<?php
ob_start();

if(isset($_GET["vtid"]))
{	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$where="";
	$sql_vertab="SELECT
	vertab_adi,
	veritabani,
	vertab_notlar,
	ip
	FROM
	veritabanlari
	where vertab_id=".$_GET["vtid"];
	$result=mysql_query($sql_vertab,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	if ($row['vertab_notlar']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['vertab_notlar'];
	}
$sql_vertab_sunucu="SELECT
					s.sunucu,s.ip_adresi1
					FROM
					veritabani_sunucu v
					left join sunucular s on v.sunucuID=s.sunucuID
					where v.vertab_id=".$_GET["vtid"];
					$result=mysql_query($sql_vertab_sunucu,$link);

echo '		
		 <div style="width:100%;height:660px;border:0px;overflow:auto;"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['vertab_adi'].' </td></tr>
  <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Veritabanı</th><td class="odd" vAlign="top" align="left">'.$row['veritabani'].' </td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left" title="Sunucular Üzerinde">Sunucu</th><td class="even" vAlign="top" align="left">
';
while ($row1=mysql_fetch_array($result,MYSQL_BOTH))
{
	echo $row1['sunucu'].' ('.$row1['ip_adresi1'].')<br/>';
}
echo '</td></tr></table></div>';
	
	include '../db/mysql_baglanma.php';
}
else
{
echo "Ağ Elemani Seçiniz";
}







	




			



ob_end_flush();

?>
<!--<tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_turu'].'</br> <a  href=index.php?s='.$s.'&sid='.$sid.' >'.$sbilgi.'</a> </td></tr>-->
