
<?php
ob_start();

if(isset($_GET["aid"]))
{

	

	
	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$sql_agelemani="SELECT agele_port_sayisi,agele_id,agele_turu FROM ag_elemanlari WHERE  agele_id =".$_GET["aid"];
	$result_agele=mysql_query($sql_agelemani);
	$row_agele=mysql_fetch_array($result_agele);
	
	$sql_agelemani_port_bilgileri="SELECT agele_port_number,agele_id,donagbildetay_id FROM agele_port_bilgileri  WHERE  agele_id =".$_GET["aid"];
	$result_agele_port_bilgileri=mysql_query($sql_agelemani_port_bilgileri);
		

	
	$width=$row_agele['agele_port_sayisi']*30;
	
	?>
	<div style="width:200%; max-width:700px;  max-height:540px; height:<?php echo $width?>px;border:1px solid #EBEFF5;overflow:auto;"> 
	<table style="border:1px solid #EBEFF5; width:100%">
	<?php while ($row_agele_port_bilgileri=mysql_fetch_array($result_agele_port_bilgileri))
	{?>
	<tr style="border:1px solid #EBEFF5;"><td><?php echo $row_agele_port_bilgileri['agele_port_number']; ?>.Port</td> 
	<td vAlign="top" align="left">
				</td><td><?php 
	$sql_donanim_ag_elemani="SELECT
	port_turu,
	donanim_tip,
	donanim_tip_id,
	controller_adi,
	controller_port_adi,
	port_adi,
	donagbildetay_id
	FROM
	donanim_ag_bilesenleri_detay
	WHERE aktif=1 AND port_turu=".$row_agele['agele_turu'].
	"
	ORDER BY donagbildetay_id
	";

	$result_donanim_ag_elemani=mysql_query($sql_donanim_ag_elemani);
	echo '<select id='.$row_agele_port_bilgileri['agele_port_number'].' name='.$row_agele_port_bilgileri['agele_port_number'].'>';
	echo '<option value="0">Boş</option>';
	while ($row_donanim_ag_elemani=mysql_fetch_array($result_donanim_ag_elemani)){
	
		if($row_donanim_ag_elemani['donagbildetay_id']==$row_agele_port_bilgileri['donagbildetay_id']){
			echo '<option value='.$row_donanim_ag_elemani["donagbildetay_id"].' selected>'; 
			if($row_donanim_ag_elemani['controller_adi']!=""){
				echo $row_donanim_ag_elemani['controller_adi']."-".$row_donanim_ag_elemani['controller_port_adi'];
			}
			else{
				echo $row_donanim_ag_elemani['port_adi'];
			}
			
			echo '</option>';
			
		}else{
			echo '<option value='.$row_donanim_ag_elemani["donagbildetay_id"].'>';
			
			if($row_donanim_ag_elemani['controller_adi']!=""){
				echo $row_donanim_ag_elemani['controller_adi']."-".$row_donanim_ag_elemani['controller_port_adi'];
			}
			else{
				echo $row_donanim_ag_elemani['port_adi'];
			}
			echo '</option>';
		}
		
		
	}
	}?></td></tr>
	
	
	
	<?php }?>
	</table>
	</div>
	
	<?php 
	
	
	
	
	include '../db/mysql_baglanma.php';





ob_end_flush();

?>