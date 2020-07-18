<?php
ob_start();
include 'db/mysql_baglan.php';

$sql_depuni_bilgileri_getir="
SELECT
	depuni_id,
	depuni_adi,
	depuni_tip,
	dep_uni_serino,
	dep_uni_disk_boyutlari,
	dep_uni_isletim_sistemi,
	dep_uni_disk_array_bilgileri,
	depuni_notlar,
	depuni_demirbasno,
	depuni_marka_model,
	depuni_ip,
	aktif
FROM
	depolama_uniteleri
WHERE depuni_id=".$_GET['did'].";";
$result=mysql_query($sql_depuni_bilgileri_getir,$link);
$row=mysql_fetch_array($result,MYSQL_BOTH);





$sql_donanim_ag_bilesenleri="SELECT
	port_turu,
	donanim_tip,
	donanim_tip_id,
	controller_sayisi,
	controller_basina_dusen_port_sayisi,
	port_sayisi,
	donagbil_id
FROM
donanim_ag_bilesenleri
WHERE port_turu=1 and donanim_tip=3 and donanim_tip_id=".$_GET['did'].";";

$result=mysql_query($sql_donanim_ag_bilesenleri);
$row_donanim_ag_bileseni=mysql_fetch_array($result,MYSQL_BOTH);


$sql_donanim_ag_bilesenleri="SELECT
	port_turu,
	donanim_tip,
	donanim_tip_id,
	controller_sayisi,
	controller_basina_dusen_port_sayisi,
	port_sayisi,
	donagbil_id
FROM
donanim_ag_bilesenleri
WHERE port_turu=2 and donanim_tip=3 and donanim_tip_id=".$_GET['did'].";";

$result=mysql_query($sql_donanim_ag_bilesenleri);
$row_donanim_ag_bileseni2=mysql_fetch_array($result,MYSQL_BOTH);

include 'db/mysql_baglanma.php';
ob_flush();
