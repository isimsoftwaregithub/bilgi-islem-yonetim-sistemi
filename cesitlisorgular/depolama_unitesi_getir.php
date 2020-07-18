<?php
ob_start();


include 'db/mysql_baglan.php';



	$sql_sunucular="SELECT depuni_id ,depuni_adi  FROM depolama_uniteleri WHERE aktif=1" ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	


echo '<select id="depolama_unitesi" name="depolama_unitesi">';
echo '<option value="0">&nbsp;</option>';
	while ($row_dep=mysql_fetch_array($result,MYSQL_BOTH))
	{
		echo '<option value='.$row_dep["depuni_id"].'>'.$row_dep["depuni_adi"].'</option>';
	}


echo '</select>';

	

	
include 'db/mysql_baglanma.php';			






	

ob_end_flush();

?>