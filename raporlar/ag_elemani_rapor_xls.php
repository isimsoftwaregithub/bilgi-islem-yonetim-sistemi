
<?php
ob_start();
include '../db/mysql_baglan.php';
$filename ="bim_switch_config.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Type: text/html; charset=ISO-8859-9');
	$sql_ag_elemanlari="SELECT
	agele_id,
	agele_adi,
	agele_serino,
	agele_marka,
	agele_ip,
	agele_notlar,
	agele_demirbasno,
	agele_port_sayisi,
	agele_hizi,
	agele_turu
FROM
	ag_elemanlari;";
	$result=mysql_query($sql_ag_elemanlari,$link);
	
	
	
$strtable="";
	
?>	
<div id="agelemani_rapor">

<table  border="1" class="agelemani_rapor">
<thead>
<tr>
<th >Sıra</th>
<th >Ağ Elemanı</th>
<th>Seri / D.baş No</th>
<th >IP</th>
<th >Port Sayısı</th>
<th >Notlar</th>
</tr>
</thead>
<tbody>
<?php 
$sira=1;
$bg="#F5F5F5";
while ($row=mysql_fetch_array($result,MYSQL_BOTH))
{
	echo "
	<tr>
	<td  style='background-color:$bg; width:2px;vertical-align: top'>".$sira."</td>
	<td  style=' background-color:$bg;width:150px;vertical-align: top'>".$row["agele_adi"]."<br/>".$row["agele_marka"]." ".$row["agele_hizi"]."</td>
	<td  style='background-color:$bg; width:100px;vertical-align: top'>".$row["agele_serino"]." / ".$row["agele_demirbasno"]."</td>
	<td  style=' background-color:$bg;width:100px;vertical-align: top'>".$row["agele_ip"]."</td>
	<td  style=' background-color:$bg;width:50px;vertical-align: top'>".$row["agele_port_sayisi"]."</td>
	<td  style='background-color:$bg; width:150px;vertical-align: top'>".str_replace("<br />", "", $row["agele_notlar"])."</td>
	</tr>";
//	echo '<tr><td colspan="6">asd</td></tr>';
	$sira=$sira+1;
	if($bg=="#F5F5F5")
	{
		$bg="#FFF";
	}
	else{
		$bg="#F5F5F5";
	}

	
	$sql_port_bilgisi="
	SELECT
	agele_id,
	agele_port_number,
	d.controller_adi,
	d.controller_port_adi,
	d.port_adi
	FROM
	agele_port_bilgileri a
	left join donanim_ag_bilesenleri_detay d on a.donagbildetay_id=d.donagbildetay_id
	WHERE agele_id=".$row['agele_id'].";";
	$result2=mysql_query($sql_port_bilgisi,$link);

	$str_portnumbers1="";
	$str_portnumbers2="";
	$str_portname1="";	
	$str_portname2="";	
	$count=$row["agele_port_sayisi"]/2;
	$i=0;
	while ($row2=mysql_fetch_array($result2,MYSQL_BOTH)){
		if($i<$count){
		$str_portnumbers1.="<td  style='text-align:left; background-color:#F6E4CC'>".$row2['agele_port_number']."</td>"; 
		if($row2['controller_adi']==""||$row2['controller_adi']==null){
			$str_portname1.="<td style='font-size:10px;'>&nbsp;".$row2['port_adi']."</td>";
		}
		elseif($row2['port_adi']==""||$row2['port_adi']==null){
			$str_portname1.="<td style='font-size:10px;'>&nbsp;".$row2['controller_adi']." ".$row2['controller_port_adi']. "</td>";
		}
		else{
			$str_portname1.="<td style='font-size:10px;'>&nbsp;</td>";
		}
		}
		if($i>=$count){
		$str_portnumbers2.="<td style='text-align:left; background-color:#F6E4CC'>".$row2['agele_port_number']."</td>"; 
		if($row2['controller_adi']==""||$row2['controller_adi']==null){
			$str_portname2.="<td style='font-size:10px;'>&nbsp;".$row2['port_adi']."</td>";
		}elseif($row2['port_adi']==""||$row2['port_adi']==null){
			$str_portname2.="<td style='font-size:10px;'>&nbsp;".$row2['controller_adi']." ".$row2['controller_port_adi']. "</td>";
		}
		else{
			$str_portname2.="<td style='font-size:10px;'>&nbsp;</td>";
		}
		}
		$i=$i+1;
		}
	
	$strtable.=	"
	<table border='1' class='agelemani_rapor'>
	<tr><td colspan='$count' style='text-align:center; color:white; background-color:#336699'>".$row['agele_adi']."</td></tr>
	<tr>$str_portnumbers1</tr>
	<tr  style=' background-color:#F5F5F9'>$str_portname1</tr>
	<tr>$str_portname2</tr>
	<tr>$str_portnumbers2</tr>
	</table>";
		
//	echo "<tr><td colspan='6'><table>";
//	echo "<tr>$str_portnumbers1</tr>";
//	echo "<tr>$str_portname1</tr>";
//		echo "<tr>$str_portname2</tr>";
//	echo "<tr>$str_portnumbers2</tr>";
//	
//	echo "</table></td></tr>";

}
echo "<tr><td rowspan='2' colspan='6'><br/><br/></td></tr>";
echo $strtable;
?>

</tbody></table>

<?php 


?>

</div>


<?php

include '../db/mysql_baglanma.php';
ob_end_flush();
?>