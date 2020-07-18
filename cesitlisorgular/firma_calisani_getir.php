<?php
ob_start();
include '../db/mysql_baglan.php';

	$sql_calisanlar="SELECT firmacal_id ,adi_soyadi  FROM firma_calisanlari where firma_id=".$_GET["firma_id"] ;
	$result=mysql_query($sql_calisanlar,$link);
	
	

echo '<select name="firma_calisanlari[]" class="select_multi" id="firma_calisanlari"  multiple="multiple" size="3">';
	while ($row_calisan=mysql_fetch_array($result,MYSQL_BOTH))
	{ 
		
		$toggle=true;
		if(isset($_GET["firma_cal_id"]))
		{
		$calisan=explode(",",$_GET["firma_cal_id"]);
			foreach ($calisan as $value)
			 {
	    		if($value==$row_calisan["firmacal_id"])
	    		{
	    			echo '<option value='.iconv('UTF-8', 'ISO-8859-9', $row_calisan["firmacal_id"]).' selected>'.iconv('ISO-8859-9','UTF-8', $row_calisan["adi_soyadi"]).'</option>';
	    			$toggle=false;
	    		}
	    		
			}
			if($toggle)
			{
				echo '<option value='.$row_calisan["firmacal_id"].'>'. $row_calisan["adi_soyadi"].'</option>';
				
			}
		}
		else{
				echo '<option value='.$row_calisan["firmacal_id"].'>'.$row_calisan["adi_soyadi"].'</option>';	
		}
		
		
		
	}


echo '</select>';

	

			





include '../db/mysql_baglanma.php';
	

ob_end_flush();

?>