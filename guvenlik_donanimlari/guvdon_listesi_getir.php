	 <script>
	 $(document).ready(function(){
		 $("#sunucu_listesi tbody > tr > td > span").click(function(e){
				$("#tabs-1").empty().html('<img src="images/ajax-loader.gif" /><br />');
			    $("#tabs-1").load("guvenlik_donanimlari/guvdon_detay_getir.php?gdid="+this.id);
			  	$("#tabs-2").empty().html('<img src="images/ajax-loader.gif" /><br />');
			  	$("#tabs-2").load("guvenlik_donanimlari/kaynak_listesi_guvdon.php?gdid="+this.id);
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

include '../db/mysql_baglan.php';

$sql_agele="
	SELECT
		guvdon_id,
		guvdon_adi
	FROM
	guvenlik_donanimlari
	ORDER by guvdon_adi 
	;"

?>
<table class="sunucu_listesi"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php 
$result=mysql_query($sql_agele,$link);
$class="odd";
while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
		
	echo    '<tr class='.$class.' id='.$row['guvdon_id'].'><td class='.$class.' id='.$row['guvdon_id'].'><span id='.$row['guvdon_id'].'>'.$row['guvdon_adi'].'</span></td></tr>
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