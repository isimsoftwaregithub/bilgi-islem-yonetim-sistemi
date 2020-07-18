<?php 

ob_start();
include '../db/mysql_baglan.php';
$id="999999999999";	
if(isset($_GET['id']))
	$id=$_GET['id'];
	
	$sql_uyeler="SELECT sicilno,ad,soyad  FROM uyeler WHERE gorev not like '%Müd%'" ;
	$result=mysql_query($sql_uyeler,$link);
	
	

	echo '<option value="0">&nbsp;</option>';
	while ($row=mysql_fetch_array($result,MYSQL_BOTH))
	{	if($id==$row["sicilno"])
			{
				echo '<option value='.$row["sicilno"].' selected>'.$row["ad"].' '.$row["soyad"].'</option>';
			}
		else{
		echo '<option value='.$row["sicilno"].'>'.$row["ad"].' '.$row["soyad"].'</option>';	
		}
	}
		
	




	

			





include '../db/mysql_baglanma.php';
	

ob_end_flush();

