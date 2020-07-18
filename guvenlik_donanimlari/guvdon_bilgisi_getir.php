<?php
ob_start();
include 'db/mysql_baglan.php';

$sql_guvdon_bilgileri_getir="
SELECT
	guvdon_id,
	guvdon_adi,
	guvdon_serino,
	guvdon_ip,
	guvdon_notlar,
	guvdon_demirbasno,
	aktif
FROM
guvenlik_donanimlari
WHERE guvdon_id=".$_GET['gdid'].";";
$result=mysql_query($sql_guvdon_bilgileri_getir,$link);
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
WHERE port_turu=1 and donanim_tip=9 and donanim_tip_id=".$_GET['gdid'].";";

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
WHERE port_turu=2 and donanim_tip=9 and donanim_tip_id=".$_GET['gdid'].";";

$result=mysql_query($sql_donanim_ag_bilesenleri);
$row_donanim_ag_bileseni2=mysql_fetch_array($result,MYSQL_BOTH);

include 'db/mysql_baglanma.php';
ob_flush();
