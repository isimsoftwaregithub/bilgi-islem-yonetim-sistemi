<?php
function logall ($islem,$islemnot,$oncelik){
	if(!isset($_SESSION)){
		$sicilno=0;
	}
	else{
		$sicilno=$_SESSION['sicilno'];
	}
	
		$sql_insert_loglar="INSERT INTO loglar ( ip,islem,islem_not,oncelik,sicil_no,tarih,zaman)
		VALUES 
		('".$_SERVER['REMOTE_ADDR']."','".$islem."','".$islemnot."',".$oncelik.",'".$sicilno."', '".date('Y-m-d')."','".date('H:i:s')."');";
		//echo $sql_insert_loglar;	
		$sql_insert_loglar=iconv('UTF-8', 'ISO-8859-9', $sql_insert_loglar);
		//echo $sql_insert_loglar;
		if(!mysql_query($sql_insert_loglar))
		{
			echo mysql_error();
		}
	
}