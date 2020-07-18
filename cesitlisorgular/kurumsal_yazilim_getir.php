

<?php
ob_start();



include 'db/mysql_baglan.php';

	$sql_sunucular="SELECT kuryaz_id ,kuryaz_adi  FROM kurumsal_yazilimlar" ;
	$result=mysql_query($sql_sunucular,$link);
	
	
	


echo "<select name ='kurumsal_yazilimlar[]' class='select_multi' id='kurumsal_yazilimlar'   multiple='multiple' size='3'>";
echo '<option value="0">&nbsp;</option>';
	while ($row_kuryaz2=mysql_fetch_array($result,MYSQL_BOTH))
	{
		$toggle=true;
		if(isset($row_kuryaz["kuryaz_id"]))
		{
		$kuryaz=explode(",",$row_kuryaz["kuryaz_id"]);
			foreach ($kuryaz as $value) {
	    		if($value==$row_kuryaz2["kuryaz_id"]){
	    			echo '<option value='.$row_kuryaz2["kuryaz_id"].' selected>'.$row_kuryaz2["kuryaz_adi"].'</option>';
	    			$toggle=false;
	    		}
	    		
			}
		if ($toggle){
	    			echo '<option value='.$row_kuryaz2["kuryaz_id"].'>'.$row_kuryaz2["kuryaz_adi"].'</option>';		
	    		}
		}
		else{
				echo '<option value='.$row_kuryaz2["kuryaz_id"].'>'.$row_kuryaz2["kuryaz_adi"].'</option>';		
		}
		
		
	}

echo '</select>';

	

			

include 'db/mysql_baglanma.php';





	

ob_end_flush();

?>