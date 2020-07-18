<?php
ob_start();



include 'db/mysql_baglan.php';


	$sql_sunucular="SELECT firma_id ,firma  FROM firmalar" ;
	$result=mysql_query($sql_sunucular,$link);
	
	$id="";
	if(isset($row_firma["firma_id"]))
	$id=$row_firma["firma_id"];
	


echo '<select id="firma" name="firma">';
echo '<option value="0">&nbsp;</option>';
	while ($row_firma2=mysql_fetch_array($result,MYSQL_BOTH))
	{
		if($id==$row_firma2["firma_id"]){
		echo '<option value='.$row_firma2["firma_id"].' selected>'.$row_firma2["firma"].'</option>';
		}
		else
		{
			echo '<option value='.$row_firma2["firma_id"].'>'.$row_firma2["firma"].'</option>';
		}
	}


echo '</select>';

	

			

include 'db/mysql_baglanma.php';





	

ob_end_flush();

?>