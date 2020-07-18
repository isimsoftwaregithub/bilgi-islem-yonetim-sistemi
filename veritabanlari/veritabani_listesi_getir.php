	 <script>
	 $(document).ready(function(){
		 $("#sunucu_listesi tbody > tr > td > span").click(function(e){
				$("#tabs-1").empty().html('<img src="images/ajax-loader.gif" /><br />');
			    $("#tabs-1").load("veritabanlari/veritabani_detay_getir.php?vtid="+this.id);
			  	$("#tabs-2").empty().html('<img src="images/ajax-loader.gif" /><br />');
			  	$("#tabs-2").load("veritabanlari/kaynak_listesi_veritabani.php?vtid="+this.id);
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
		vertab_id,
		vertab_adi
	FROM
	veritabanlari
	ORDER by vertab_adi 
	;"

?>
<table class="sunucu_listesi"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php 
$result=mysql_query($sql_agele,$link);
$class="odd";
while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
		
	echo    '<tr class='.$class.' id='.$row['vertab_id'].'><td class='.$class.' id='.$row['vertab_id'].'><span id='.$row['vertab_id'].'>'.$row['vertab_adi'].'</span></td></tr>
			';

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