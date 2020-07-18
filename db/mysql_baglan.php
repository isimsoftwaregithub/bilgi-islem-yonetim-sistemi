<?php

$vt_server="localhost";
$vt_user="root";
$vt_pass="12345";
$vt_name="bys";;
$link = mysql_connect($vt_server, $vt_user, $vt_pass);
if (!$link) {
    die('Bağlanamadı: ' . mysql_error());
}else{
	
	mysql_selectdb($vt_name,$link);
	@mysql_query("SET NAMES 'latin5'");
}



?>