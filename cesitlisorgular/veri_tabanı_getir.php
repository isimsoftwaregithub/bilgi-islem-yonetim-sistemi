<?php
ob_start();
include 'db/mysql_baglan.php';

	
	$id="";
	if(isset($row_veritabani["vertab_id"])){
	$id=$row_veritabani["vertab_id"];
	}
	$sql_sunucular="SELECT vertab_id ,vertab_adi  FROM veritabanlari ORDER BY vertab_adi " ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	


echo '<select id="veritabani" name="veritabani">';
echo '<option value="0">&nbsp;</option>';
	while ($row_vertab=mysql_fetch_array($result,MYSQL_BOTH))
	{
		if($id==$row_vertab["vertab_id"]){
		echo '<option value='.$row_vertab["vertab_id"].' selected>'.$row_vertab["vertab_adi"].'</option>';
		}
		else{
			echo '<option value='.$row_vertab["vertab_id"].' >'.$row_vertab["vertab_adi"].'</option>';
		}
	}


echo '</select>';

	

include 'db/mysql_baglanma.php';
			






	

ob_end_flush();

?>