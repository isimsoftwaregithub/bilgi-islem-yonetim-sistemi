<?php

if(isset($_GET['ip'])){
	//echo $_GET['ip'];
if($_GET['ip']!="" || $_GET['ip']!=null){	
	//echo $_GET['ip'];
$ping_ex = exec("ping -n 1 -w 1 ".$_GET['ip'], $ping_result, $pr);

//echo $pr;
if ($pr == 0){ 
echo '<img src="images/green.png" width="12px" alt="on" title="on"/>'; 
} 
else { 
echo '<img src="images/red.png" width="12px" alt="off" title="off"/>'; 
} 
}
else{
	echo '<img src="images/yellow.png" width="12px" alt="IP Bilgisi Eksik" title="IP Bilgisi Eksik"/>'; 
}
}
else{
echo '<img src="images/yellow.png" width="12px" title="IP Bilgisi Eksik" alt="IP Bilgisi Eksik"/>'; 
}