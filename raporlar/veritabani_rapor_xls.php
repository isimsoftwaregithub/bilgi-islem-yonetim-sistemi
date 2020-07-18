<?php

ob_start();
include '../db/mysql_baglan.php';
$filename ="veritabani.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Type: text/html; charset=ISO-8859-9');
	$sql_vertab="SELECT
	vertab_id,
	vertab_adi,
	veritabani_ver,
	vertab_notlar,
	ip
	FROM
	veritabanlari;";
	$result_veritabani=mysql_query($sql_vertab,$link);
	$str="";
	

$str.='<table  border="1"; id="veritabani">
<tr>
<th >Sıra</th>
<th >Veritabanı</th>
<th >Sunucu</th>
<th >IP</th>
<th >Notlar</th>
</tr>';
 	$sira=1;
 	$bg="#F5F5F5";
	while ($row_veritabani=mysql_fetch_array($result_veritabani,MYSQL_BOTH))
	{
		$str.="<tr>
			<td  style='background-color:$bg; font:11px Arial; text-align:left; width:35px;vertical-align: top'>".$sira."</td>
			<td  style='background-color:$bg; font:11px Arial; width:200px;vertical-align: top'>".$row_veritabani["vertab_adi"]."<br/>".$row_veritabani["veritabani_ver"]."</td>
			<td  style='background-color:$bg; font:11px Arial; width:100px;vertical-align: top'>
			";
		
			$sql_vertab_sunucu="SELECT
					s.sunucu
					FROM
					veritabani_sunucu v
					left join sunucular s on v.sunucuID=s.sunucuID
					where v.vertab_id=".$row_veritabani["vertab_id"];
				$result_vertab_sunucu=mysql_query($sql_vertab_sunucu,$link);
				while ($row1=mysql_fetch_array($result_vertab_sunucu,MYSQL_BOTH))
				{
					$str.= $row1['sunucu'].'<br/>';
				}
				
			$str.="</td><td  style='background-color:$bg; font:11px Arial; width:75px;vertical-align: top'>".$row_veritabani["ip"]."</td>
			<td  style='background-color:$bg; font:11px Arial; width:200px;vertical-align: top'>".$row_veritabani["vertab_notlar"]."</td>
			</tr>";
		$sira=$sira+1;
	if($bg=="#F5F5F5")
	{
		$bg="#FFF";
	}
	else{
		$bg="#F5F5F5";
	}
	}
	$str.="</table>";
	
	echo $str;

include '../db/mysql_baglanma.php';
ob_end_flush();
?>