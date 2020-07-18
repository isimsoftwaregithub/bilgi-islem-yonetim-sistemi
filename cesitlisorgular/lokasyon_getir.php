

<?php
ob_start();

include 'db/mysql_baglan.php';
	$id="0";
	if(isset($row['lokasyon']))	
	$id=$row['lokasyon'];
	
	
	$sql_sunucular="SELECT lokasyonID, lokasyon FROM lokasyonlar" ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	

echo "<select name ='lokasyon' id='lokasyon'>";

	while ($row_lok=mysql_fetch_array($result,MYSQL_BOTH))
	{
		if($id==$row_lok["lokasyonID"]){
		echo '<option value='.$row_lok["lokasyonID"].' selected>'.$row_lok["lokasyon"].'</option>';
		}
		else{
			echo '<option value='.$row_lok["lokasyonID"].'>'.$row_lok["lokasyon"].'</option>';
		}
	}

echo '</select>';
	include 'db/mysql_baglanma.php';	






	

ob_end_flush();

?>