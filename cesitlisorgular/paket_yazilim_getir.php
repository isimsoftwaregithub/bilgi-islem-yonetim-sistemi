<?php
ob_start();



include 'db/mysql_baglan.php';

	$sql_pakyaz="SELECT pakyaz_id ,pakyaz_adi  FROM paket_yazilimlar" ;
	$result=mysql_query($sql_pakyaz,$link);
	
	
	


echo "<select name='paket_yazilimlar[]' class='select_multi' id='paket_yazilimlar' multiple='multiple' size='3'>";
echo '<option value="0">&nbsp;</option>';
	while ($row_pakyaz2=mysql_fetch_array($result,MYSQL_BOTH))
	{
		$toggle=true;
	if(isset($row_pakyaz["pakyaz_id"]))
		{
		$pakyaz=explode(",",$row_pakyaz["pakyaz_id"]);
			foreach ($pakyaz as $value) {
	    		if($value==$row_pakyaz2["pakyaz_id"]){
	    			echo '<option value='.$row_pakyaz2["pakyaz_id"].' selected>'.$row_pakyaz2["pakyaz_adi"].'</option>';
	    			$toggle=false;
	    		}
	    		
			}
			if($toggle){
	    			echo '<option value='.$row_pakyaz2["pakyaz_id"].'>'.$row_pakyaz2["pakyaz_adi"].'</option>';		
	    		}
		}
		else{
				echo '<option value='.$row_pakyaz2["pakyaz_id"].'>'.$row_pakyaz2["pakyaz_adi"].'</option>';		
		}
		
		
	}


echo '</select>';


include 'db/mysql_baglanma.php';
ob_end_flush();

?>