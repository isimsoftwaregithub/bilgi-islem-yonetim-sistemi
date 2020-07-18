<?php

ob_start();
include '../db/mysql_baglan.php';
$filename ="excelreport.xls";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename);


	$sql_sunucular="SELECT sunucu_gorevi,
	notlar,
	serino,
	cpu_turu,
	cpu_soket_sayisi,
	cpu_soket_core_sayisi,
	cpu_frekansi,
	disk_turu,
	dosyalama_tipi,
	dosya_sistemi,
	ip_adresi1,
	ip_adresi2,
	isletim_sistemi,
	lokasyon,
	optik_okuyucu,
	ram_soket_sayisi,
	dolu_soket_sayisi,
	ram_toplami,
	ram_turu,
	marka,
	model,
	sunucu_tipi,
	sunucu_turu,
	sunucu_tur_id,
	yerel_disk_bilgileri,
	yerel_disk_yapisi,
	alim_tarihi,
	garanti_suresi FROM sunucular where 1=1 ";
	$result=mysql_query($sql_sunucular,$link);
?>	
<!--<table>
  
  <td >".$row["cpu_turu"]." ".$row["cpu_soket_sayisi"]."".$row["cpu_soket_core_sayisi"]." ".$row["cpu_frekansi"]." ".$row["cpu_turu"]."</td>

<?php 
$row=mysql_fetch_array($result,MYSQL_BOTH);
//while ($row=mysql_fetch_array($result,MYSQL_BOTH))
//{
//	
//	$cpuTuru=$row["cpu_turu"];
//	echo $cpuTuru;
//	echo "<tr ><td style='border-bottom:1px solid black;' >".$row["sunucu_gorevi"]."</td>
//	<td style='border-bottom:1px solid red;' ></td>
//	</tr>";
//}

?>

</table>


--><!--<input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">-->

<table id="testTable" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides" border="1"><caption>CODE-PAGE SUPPORT IN MICROSOFT WINDOWS</caption><colgroup align="center"></colgroup><colgroup align="left"></colgroup><colgroup span="2" align="center"></colgroup><colgroup span="3" align="center"></colgroup><thead valign="top"><tr><th>Code-Page<br>ID</th><th>Name</th><th>ACP</th><th>OEMCP</th><th>Windows<br>NT 3.1</th><th>Windows<br>NT 3.51</th><th>Windows<br>95</th></tr></thead><tbody><tr><td><?php echo $row["sunucu_gorevi"]?></td><td style="background-color: #00f; color: #fff">sad</td><td></td><td></td><td>X</td><td>X</td><td>*</td></tr><tr><td>1250</td><td style="font-weight: bold">Windows 3.1 Eastern European</td><td>X</td><td></td><td>X</td><td>X</td><td>X</td></tr><tr><td>1251</td><td>Windows 3.1 Cyrillic</td><td>X</td><td></td><td>X</td><td>X</td><td>X</td></tr><tr><td>1252</td><td>Windows 3.1 US (ANSI)</td><td>X</td><td></td><td>X</td><td>X</td><td>X</td></tr><tr><td>1253</td><td>Windows 3.1 Greek</td><td>X</td><td></td><td>X</td><td>X</td><td>X</td></tr><tr><td>1254</td><td>Windows 3.1 Turkish</td><td>X</td><td></td><td>X</td><td>X</td><td>X</td></tr><tr><td>1255</td><td>Hebrew</td><td>X</td><td></td><td></td><td></td><td>X</td></tr><tr><td>1256</td><td>Arabic</td><td>X</td><td></td><td></td><td></td><td>X</td></tr><tr><td>1257</td><td>Baltic</td><td>X</td><td></td><td></td><td></td><td>X</td></tr><tr><td>1361</td><td>Korean (Johab)</td><td>X</td><td></td><td></td><td>**</td><td>X</td></tr></tbody><tbody><tr><td>437</td><td>MS-DOS United States</td><td></td><td>X</td><td>X</td><td>X</td><td>X</td></tr><tr><td>708</td><td>Arabic (ASMO 708)</td><td></td><td>X</td><td></td><td></td><td>X</td></tr><tr><td>709</td><td>Arabic (ASMO 449+, BCON V4)</td><td></td><td>X</td><td></td><td></td><td>X</td></tr><tr><td>710</td><td>Arabic (Transparent Arabic)</td><td></td><td>X</td><td></td><td></td><td>X</td></tr><tr><td>720</td><td>Arabic (Transparent ASMO)</td><td></td><td>X</td><td></td><td></td><td>X</td></tr></tbody></table>


<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();
?>