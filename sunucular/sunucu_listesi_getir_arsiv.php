<script type="text/javascript" >
	$(document).ready(function(){
		$("#sunucu_listesi tbody > tr > td > span").click(function(e){
			$("#tabs-1").empty().html('<img src="images/ajax-loader.gif" /><br />');
			$("#tabs-1").load("sunucular/sunucu_detay_getir_arsiv.php?sid="+this.id);
			$("#tabs-2").empty().html('<img src="images/ajax-loader.gif" /><br />');
			$("#tabs-2").load("sunucular/yazilim_listesi_sunucu_detay_getir.php?sid="+this.id);
			$("#tabs-3").empty().html('<img src="images/ajax-loader.gif" /><br />');
			$("#tabs-3").load("sunucular/kaynak_listesi_sunucu_detay.php?sid="+this.id);
			$( "#tabs" ).hide("fast");
			$( "#tabs" ).show("slow");
			$( "#p" ).hide("slow");
			$("#output").empty();
			$("#sid").val(this.id);
		});

	});

	
</script>
<?php
ob_start();
header('Content-Type: text/html; charset=ISO-8859-9');
include '../db/mysql_baglan.php';
$where="";


$sql_sunucular="SELECT sunucuID ,sunucu  FROM sunucular where 1=1 AND aktif=0 ";
//Eğer Fiziksel, Sanallaştırma veya Sanal Seçilmiş ise
if (isset($_GET["tur_id"]))
{ 
	if($_GET["tur_id"]!=""){
		$where =" AND sunucu_tur_id=".$_GET["tur_id"]."";
	}
}
$sql_sunucular.=" ".$where." ORDER BY sunucu";

$result=mysql_query($sql_sunucular,$link);
$class="odd";?>
<table class="sunucu_listesi"  summary="Sunucu Detay Bilgileri">

 <tbody>
 	
	<?php 
	

while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
		
	echo    '<tr class="'.$class.' data "  id='.$row['sunucuID'].'><td class="'.$class.' data" id='.$row['sunucuID'].'><span id='.$row['sunucuID'].'>'.$row['sunucu'].'</span></td></tr>
			';
//			echo    '<tr id='.$row['sunucuID'].'><td id='.$row['sunucuID'].'> <img src="images/sunucu.png" alt="Sanallaştırma Sunucusu" style="height: 25px; width: 20px"/></td><td>'.$row['sunucu'].'</td>
//				<td>'.$row['sunucu_turu'].'
//			'.$row['ip_adresi1'].'
//			'.$row['isletim_sistemi'].' </td><td class="noborder"><a href=index.php?s=s_d&sid='.$row[0].' >Detay</a></td></tr>
//			';
			if($class=="odd")
			{
				$class="even";
			}
			else{
				$class="odd";
			}

}


?>
</tbody>
</table>
<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();

?>
