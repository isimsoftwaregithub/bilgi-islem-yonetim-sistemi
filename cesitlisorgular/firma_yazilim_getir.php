

<?php
ob_start();



include 'db/mysql_baglan.php';
	
	
	
	$sql_sunucular="SELECT metyaz_id ,metyaz_adi  FROM firma_yazilimlar" ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	


	echo "<select name ='firma_yazilimlar[]' class='select_multi' id='firma_yazilimlar'  multiple='multiple' size='3'>";
	echo '<option value="0">&nbsp;</option>';
	while ($row_metyaz2=mysql_fetch_array($result,MYSQL_BOTH))
	{
		$toggle=true;
				if(isset($row_metyaz["metyaz_id"]))
		{
		$metyaz=explode(",",$row_metyaz["metyaz_id"]);
			foreach ($metyaz as $value) {
	    		if($value==$row_metyaz2["metyaz_id"]){
	    			echo '<option value='.$row_metyaz2["metyaz_id"].' selected>'.$row_metyaz2["metyaz_adi"].'</option>';
	    			$toggle=FALSE;
	    		}
	    		
			}
		if ($toggle){
	    			echo '<option value='.$row_metyaz2["metyaz_id"].'>'.$row_metyaz2["metyaz_adi"].'</option>';		
	    		}
		}
		else{
				echo '<option value='.$row_metyaz2["metyaz_id"].'>'.$row_metyaz2["metyaz_adi"].'</option>';		
		}
		
	}

	echo '</select>';

	

			

include 'db/mysql_baglanma.php';





	

ob_end_flush();

?>