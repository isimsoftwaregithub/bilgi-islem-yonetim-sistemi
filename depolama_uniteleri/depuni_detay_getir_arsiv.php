 <script type="text/javascript" >
	 $(document).ready(function(){
		  

		  
			
			 $("#d_d").find('a').click(function(){
		
				 var id = $(this).attr("id");
				//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>
<?php


	ob_start();

if(isset($_GET["did"]))
{	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$where="";
	$sql_dep="SELECT
	depuni_id,
	depuni_adi,
	depuni_tip,
	dep_uni_serino,
	dep_uni_disk_boyutlari,
	dep_uni_isletim_sistemi,
	dep_uni_disk_array_bilgileri,
	depuni_notlar,
	depuni_demirbasno,
	depuni_marka_model,
	depuni_ip,
	aktif
	FROM
	depolama_uniteleri
	where depuni_id=".$_GET["did"];
	$result=mysql_query($sql_dep,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	$not="";
	if($row["aktif"]==0)
	{
		$not="<h2 style='color:red'>Bu Depolama Unitesi Artık Kullanılmamaktadır !</h2>";
	}
	
	if ($row['depuni_notlar']=="")
	{
		$not.="Henüz bir not eklenmemiş";
	}
	else{
		$not.=$row['depuni_notlar'];
	}

	$sql_dep_sunucu="SELECT
	s.sunucu,s.ip_adresi1
	FROM
	depuni_sunucu d
	left join sunucular s on d.sunucu_id=s.sunucuID
	where d.depuni_id=".$_GET["did"];
	$result=mysql_query($sql_dep_sunucu,$link);	
	


	
	echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;" id="d_d"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

 <table class="sunucu_detay" summary="Sunucu Detay Bilgileri">
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['depuni_adi'].' '.$row['depuni_tip'].' </td></tr>
 <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Seri No / Demirbaş No</th><td class="odd" vAlign="top" align="left">'.$row['dep_uni_serino'].'/'.$row['depuni_demirbasno'].'</td></tr>
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Marka / Model</th><td class="even" vAlign="top" align="left">'.$row['depuni_marka_model'].' </td></tr>
 <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">IP</th><td class="odd" vAlign="top" align="left">'.$row['depuni_ip'].'</td></tr>
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Boyut</th><td class="even" vAlign="top" align="left">'.$row['dep_uni_disk_boyutlari'].'</td></tr>
 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">İşletim Sistemi</th><td class="odd" vAlign="top" align="left">'.$row['dep_uni_isletim_sistemi'].' </td></tr>
 <tr class="even"><th class="even" vAlign="top" scope="row" align="left">Disk Array Bilgileri</th><td class="even"vAlign="top" align="left">'.$row['dep_uni_disk_array_bilgileri'].'</td></tr>
 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left" title="Sunucular Üzerinde">Sunucu</th><td class="odd" vAlign="top" align="left">
 
';
while ($row1=mysql_fetch_array($result,MYSQL_BOTH))
{
	echo $row1['sunucu'].' ('.$row1['ip_adresi1'].')<br/>';
}
echo '</td></tr></table>';

echo '</div>';

	
	include '../db/mysql_baglanma.php';
	ob_end_flush();
}
else
{
echo "Depolama Unitesi Seçiniz!!!";
}





?>
