<?php
ob_start();
include 'db/mysql_baglan.php';

$sql_sunucu_bilgileri_getir="
SELECT
	sunucuID,
	sunucu,
	sunucu_gorevi,
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
	garanti_suresi,
	sunucu_demirbasno
FROM
	sunucular
WHERE sunucuID=".$_GET['sid'].";";
$result=mysql_query($sql_sunucu_bilgileri_getir,$link);
$row=mysql_fetch_array($result,MYSQL_BOTH);

$sql_sanallastirma_bilgisi="SELECT parentID FROM sanal_sanallastirma WHERE sunucuID=".$_GET['sid'].";";
$result=mysql_query($sql_sanallastirma_bilgisi,$link);
$row_sanallastirma=mysql_fetch_array($result,MYSQL_BOTH);

$sql_depolama_unitesi="SELECT depuni_id,depuni_sunucu_aciklama,disk_yapisi FROM depuni_sunucu WHERE sunucu_id=".$_GET['sid'].";";
$result=mysql_query($sql_depolama_unitesi,$link);
$row_depolama=mysql_fetch_array($result,MYSQL_BOTH);

$sql_veritabani="SELECT vertab_id FROM veritabani_sunucu WHERE sunucuID=".$_GET['sid'].";";
$result=mysql_query($sql_veritabani,$link);
$row_veritabani=mysql_fetch_array($result,MYSQL_BOTH);

$sql_metyaz="SELECT metyaz_id FROM metyaz_sunucu WHERE sunucuID=".$_GET['sid'].";";
$result=mysql_query($sql_metyaz,$link);
$row_metyaz=mysql_fetch_array($result,MYSQL_BOTH);

$sql_kuryaz="SELECT kuryaz_id FROM kuryaz_sunucular WHERE sunucu_id=".$_GET['sid'].";";
$result=mysql_query($sql_kuryaz,$link);
$row_kuryaz=mysql_fetch_array($result,MYSQL_BOTH);

$sql_pakyaz="SELECT pakyaz_id FROM pakyaz_sunucu WHERE sunucuID=".$_GET['sid'].";";
$result=mysql_query($sql_pakyaz,$link);
$row_pakyaz=mysql_fetch_array($result,MYSQL_BOTH);

$sql_digyaz="SELECT digyaz_adi,digyaz_aciklama FROM digyaz_sunucu WHERE sunucu_id=".$_GET['sid'].";";
$result=mysql_query($sql_digyaz,$link);
$row_digyaz=mysql_fetch_array($result,MYSQL_BOTH);

$sql_firma="SELECT firma_id,firma_cal_id FROM firma_sunucu WHERE sunucu_id=".$_GET['sid'].";";
$result=mysql_query($sql_firma,$link);
$row_firma=mysql_fetch_array($result,MYSQL_BOTH);


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
WHERE port_turu=1 and donanim_tip=1 and donanim_tip_id=".$_GET['sid'].";";

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
WHERE port_turu=2 and donanim_tip=1 and donanim_tip_id=".$_GET['sid'].";";

$result=mysql_query($sql_donanim_ag_bilesenleri);
$row_donanim_ag_bileseni2=mysql_fetch_array($result,MYSQL_BOTH);

include 'db/mysql_baglanma.php';
ob_flush();