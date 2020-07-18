	 <script>
	 $(document).ready(function(){
		 $("#sunucu_listesi tbody > tr > td > span").click(function(e){
				$("#tabs-1").empty().html('<img src="images/ajax-loader.gif" /><br />');
			    $("#tabs-1").load("ag_elemanlari/agelemani_detay_getir.php?aid="+this.id);
			  	$("#tabs-2").empty().html('<img src="images/ajax-loader.gif" /><br />');
			  	$("#tabs-2").load("ag_elemanlari/kaynak_listesi_agelemani.php?aid="+this.id);
			    $("#output").empty();
			    $( "#tabs" ).hide("fast");
				$( "#tabs" ).show("slow");
				$( "#p" ).hide("slow");
				$( "#t" ).val(this.id);
			});
		

	});
	
</script>

<?php
ob_start();
header('Content-Type: text/html; charset=ISO-8859-9');

include '../db/mysql_baglan.php';

$sql_agele="
	SELECT
		agele_id,
		agele_adi
	FROM
	ag_elemanlari;"

?>
<table class="sunucu_listesi"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php 
$result=mysql_query($sql_agele,$link);
$class="odd";
while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
		
	echo    '<tr class='.$class.' id='.$row['agele_id'].'><td class='.$class.' id='.$row['agele_id'].'><span id='.$row['agele_id'].'>'.$row['agele_adi'].'</span></td></tr>
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

?></tbody></table>
<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();
?>