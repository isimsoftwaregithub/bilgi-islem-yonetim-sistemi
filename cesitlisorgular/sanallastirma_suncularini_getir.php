<?php
ob_start();


header('Content-Type: text/html; charset=ISO-8859-9');
include '../db/mysql_baglan.php';

	$id="99999999999999";
	
	if(isset($_GET['sid']))
	$id=$_GET['sid'];
	
	$sql_sunucular="SELECT sunucuID ,sunucu  FROM sunucular where sunucu_tur_id=1 AND aktif=1 " ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	


echo '<select id="sanallastirmaSunuculari" name="sanallastirma_sunuculari">';

	while ($row=mysql_fetch_array($result,MYSQL_BOTH))
	{	if($id==$row["sunucuID"])
			{
				echo '<option value='.$row["sunucuID"].' selected>'.$row["sunucu"].'</option>';
			}
		else{
		echo '<option value='.$row["sunucuID"].'>'.$row["sunucu"].'</option>';	
		}
	}
		
	


echo '</select>';

	

			





include '../db/mysql_baglanma.php';
	

ob_end_flush();

?>