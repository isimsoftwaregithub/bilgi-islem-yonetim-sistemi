	 <script>
	 $(document).ready(function(){
		 $("#sunucu_listesi tbody > tr > td > span").click(function(e){
			  	$("#tabs-1").empty().html('<img src="images/ajax-loader.gif" /><br />');
			    $("#tabs-1").load("yazilimlar/yazilim_detay_getir.php?yid="+this.id+"&ytid="+$(this).attr('value'));
			  	$("#tabs-2").empty().html('<img src="images/ajax-loader.gif" /><br />');
			  	$("#tabs-2").load("yazilimlar/kaynak_listesi_yazilim.php?yid="+this.id+"&ytid="+$(this).attr('value'));
			    $("#output").empty();
			    $( "#tabs" ).hide("fast");
				$( "#tabs" ).show("slow");
				$( "#p" ).hide("slow");
				$( "#t" ).val(this.id);
				$( "#y" ).val($(this).attr('value'));
			});
		

	});
	
</script>

<?php
ob_start();
header('Content-Type: text/html; charset=ISO-8859-9');
include '../db/mysql_baglan.php';
$pakyaz="";
$kuryaz="";
$metyaz="";
$class="odd";
if (isset($_GET["tur_id"]))
{ 
	
		if($_GET["tur_id"]=="7"||$_GET["tur_id"]=="")
		{
			$sql_pakyaz="
				SELECT
				pakyaz_id,
				pakyaz_adi
				FROM
				paket_yazilimlar
				;";
			$result=mysql_query($sql_pakyaz,$link);
	
		
		while ($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
					
				$pakyaz.=  '<tr class='.$class.' id='.$row['pakyaz_id'].'><td class='.$class.' id='.$row['pakyaz_id'].'><span id='.$row['pakyaz_id'].' value="7">'.$row['pakyaz_adi'].'</span></td></tr>';
			
						if($class=="odd")
						{
							$class="even";
						}
						else{
							$class="odd";
						}
			
			}
		}
		if($_GET["tur_id"]=="6"||$_GET["tur_id"]=="")
		{
			$sql_kuryaz="
				SELECT
			kuryaz_id,
			kuryaz_adi
			FROM
			kurumsal_yazilimlar;";
			$result=mysql_query($sql_kuryaz,$link);
		
		while ($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
					
				$pakyaz.=  '<tr class='.$class.' id='.$row['kuryaz_id'].'><td class='.$class.' id='.$row['kuryaz_id'].'><span id='.$row['kuryaz_id'].' value="6">'.$row['kuryaz_adi'].'</span></td></tr>';
			
						if($class=="odd")
						{
							$class="even";
						}
						else{
							$class="odd";
						}
			
			}
		}
		
		if($_GET["tur_id"]=="5"||$_GET["tur_id"]=="")
		{
			$sql_metyaz="
				SELECT
				metyaz_id,
				metyaz_adi
				FROM
				firma_yazilimlar;";
			$result=mysql_query($sql_metyaz,$link);
		
		while ($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
					
				$metyaz.=  '<tr class='.$class.' id='.$row['metyaz_id'].'><td class='.$class.' id='.$row['metyaz_id'].'><span id='.$row['metyaz_id'].' value="5">'.$row['metyaz_adi'].'</span></td></tr>';
			
						if($class=="odd")
						{
							$class="even";
						}
						else{
							$class="odd";
						}
			
			}
		}
		
	
}


?>
<table class="sunucu_listesi"  summary="Sunucu Detay Bilgileri">

 <tbody>
 <?php 
echo $pakyaz;
echo $kuryaz;
echo $metyaz;

?></tbody></table>
<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();
?>