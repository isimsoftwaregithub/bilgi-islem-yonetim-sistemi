<?php

	
	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$agele_id=$_POST['agele_id'];
	$sql_agelemani="SELECT agele_port_sayisi,agele_id,agele_turu FROM ag_elemanlari WHERE  agele_id =".$agele_id;
	$result_agele=mysql_query($sql_agelemani);
	$row_agele=mysql_fetch_array($result_agele);
	for($i=1;$i<=$row_agele['agele_port_sayisi']; $i++){

		
	$sql_update="UPDATE
	agele_port_bilgileri
	SET
	donagbildetay_id =".$_POST[$i]."
	WHERE agele_id=".$agele_id." AND agele_port_number =".$i." ;
	";
	if(!mysql_query($sql_update)){
		
		echo "<img src='images/success.png'/>".mysql_error();
	}
	}
	
	
include '../db/mysql_baglanma.php';
	

ob_end_flush();
