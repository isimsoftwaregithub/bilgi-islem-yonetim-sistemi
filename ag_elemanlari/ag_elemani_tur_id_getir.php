<?php
ob_start();


header('Content-Type: text/html; charset=ISO-8859-9');
include '../db/mysql_baglan.php';

	

$id=$_GET['tip_id'];

	if($id=='1')
	{
		$sql="SELECT sunucuID, sunucu FROM sunucular" ;
		
	}
	elseif($id=='2')
	{
		$sql="SELECT vertab_id, vertab_adi FROM veritabanlari" ;
	}
	elseif($id=='3')
	{
		$sql="SELECT depuni_id, depuni_adi FROM depolama_uniteleri" ;
	}

	elseif ($id=='9')
	{
		$sql="SELECT guvdon_id, guvdon_adi FROM guvenlik_donanimlari" ;
	}
		
	$result=mysql_query($sql,$link);	

	
		if(isset($_GET['tipid']))
		$tipid=$_GET['tipid'];
	
	echo '<select id="olay_tip_id" name="olay_tip_id">';
	echo '<option value="0">&nbsp;</option>';
	while ($row=mysql_fetch_array($result,MYSQL_BOTH))
	{if($tipid==$row[0])
			{
				echo '<option value='.$row[0].' selected>'.$row[1].'</option>';
			}
		else{
				echo '<option value='.$row[0].'>'.$row[1].'</option>';
		}
		
	}
echo '</select>';

	

			





include '../db/mysql_baglanma.php';
	

ob_end_flush();

?>