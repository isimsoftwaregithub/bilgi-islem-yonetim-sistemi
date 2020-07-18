<?php
include '../db/mssql_baglan.php';
include '../db/mysql_baglan.php';
$sql_sanal_sunucular="SELECT adi,notlar FROM notlar order by adi";
$result3=mysql_query($sql_sanal_sunucular,$link);
$cnt=0;
while ($row3=mysql_fetch_array($result3,MYSQL_BOTH)){
	
	$sqlupdate="UPDATE sunucular set notlar='".$row3['notlar']."' where sunucu='".$row3['adi']."'";
	mysql_query($sqlupdate);
	
}


include '../db/mysql_baglanma.php';
include '../db/ase_baglanma.php';