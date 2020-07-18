<?php
ob_start();
//EĞER BİR SUNUCU İSE 
if(!isset($_GET["sid"]))
{
	include 'db/mysql_baglan.php';
$where="";
$sql_sunucular="SELECT sunucuID ,sunucu ,ip_adresi1 ,isletim_sistemi ,lokasyon
 ,sunucu_turu FROM sunucular where 1=1 ";
//Eğer Fiziksel, Sanallaştırma veya Sanal Seçilmiş ise
if (isset($_GET["t"]))
{
	$where ="AND sunucu_tur_id='".$_GET["t"]."'";
	
}
$sql_sunucular.=" ".$where;
$result=mysql_query($sql_sunucular,$link);
$row=mysql_fetch_array($result,MYSQL_BOTH);
$sid=$row['sunucuID'];	

}
else{
	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$sid=$_GET['sid'];
}


$sql_veritabanlari="SELECT vt.vertab_adi,veritabani FROM veritabani_sunucu v
					LEFT JOIN sunucular s ON s.sunucuID=v.sunucuID 
					LEFT JOIN veritabanlari vt ON v.vertab_id=vt.vertab_id
					WHERE s.sunucuID='$sid'";
$result_veri=mysql_query($sql_veritabanlari,$link);

$result_metyaz_id=mysql_query("SELECT metyaz_id FROM metyaz_sunucu WHERE sunucuID='$sid'",$link);
$in=0;
if(mysql_num_rows($result_metyaz_id)>0){
	$row_metyazid=mysql_fetch_array($result_metyaz_id,MYSQL_BOTH);
	$in=$row_metyazid["metyaz_id"];
}


$sql_metyaz="SELECT my.metyaz_adi,my.metyaz_aciklama FROM metyaz_sunucu m
			LEFT JOIN sunucular s ON s.sunucuID=m.sunucuID 
			LEFT JOIN firma_yazilimlar my ON my.metyaz_id in (".$in.")
			WHERE s.sunucuID='$sid'";

$result_metyaz=mysql_query($sql_metyaz,$link);

$result_kuryaz_id=mysql_query("SELECT kuryaz_id FROM kuryaz_sunucular WHERE sunucu_id='$sid'",$link);
$in=0;
if(mysql_num_rows($result_kuryaz_id)>0){
	$row_kuryazid=mysql_fetch_array($result_kuryaz_id,MYSQL_BOTH);
	$in=$row_kuryazid["kuryaz_id"];
}

$sql_kuryaz="SELECT ky.kuryaz_adi,ky.kuryaz_aciklama,ky.kuryaz_programlama_dili FROM kuryaz_sunucular k
			LEFT JOIN sunucular s ON s.sunucuID=k.sunucu_id 
			LEFT JOIN kurumsal_yazilimlar ky ON ky.kuryaz_id in (".$in.")
			WHERE s.sunucuID='$sid'";
$result_kuryaz=mysql_query($sql_kuryaz,$link);

$result_pakyazid=mysql_query("SELECT pakyaz_id from pakyaz_sunucu where sunucuID='$sid'",$link);
$in=0;
if(mysql_num_rows($result_pakyazid)>0){
	$row_pakyazid=mysql_fetch_array($result_pakyazid,MYSQL_BOTH);
	$in=$row_pakyazid["pakyaz_id"];

}


$sql_pakyaz="SELECT py.pakyaz_adi,py.pakyaz_aciklama,py.programlama_dili FROM pakyaz_sunucu p
			LEFT JOIN sunucular s ON s.sunucuID=p.sunucuID
			LEFT JOIN paket_yazilimlar py ON py.pakyaz_id in (".$in.")
			WHERE s.sunucuID='$sid'";
$result_pakyaz=mysql_query($sql_pakyaz,$link);

$sql_digyazilimlar="SELECT d.* FROM  digyaz_sunucu d
					LEFT JOIN sunucular s ON s.sunucuID=d.sunucu_id 
					WHERE s.sunucuID='$sid'";
$result_digyazimlimlar=mysql_query($sql_digyazilimlar,$link);


		if(mysql_num_rows($result_veri)>0)
		{
				echo '<div style="width:100%;border:0px;overflow:auto;"> 
					<fieldset class="fieldset_blue">
					<legend class="legend_blue">Veritabanı</legend>';
				 	
					
					while ($row=mysql_fetch_array($result_veri,MYSQL_BOTH))
					{
					 echo $row['vertab_adi'].' ('.$row['veritabani'].')';
						
					}
				  
				echo '</fieldset> </div>';
		}
		if(mysql_num_rows($result_metyaz)>0)
		{
				echo '<div style="width:100%;border:0px;overflow:auto;"> 
					<fieldset class="fieldset_blue">
					<legend class="legend_blue">Firma Yazılımlar</legend>';
				 	
					
					while ($row=mysql_fetch_array($result_metyaz,MYSQL_BOTH))
					{
					 echo $row['metyaz_adi'].' '.$row['metyaz_aciklama'].'<br/>';
						
					}
				  
				echo '</fieldset> </div>';
		}
		if(mysql_num_rows($result_kuryaz)>0)
		{
				echo '<div style="width:100%;border:0px;overflow:auto;"> 
					<fieldset class="fieldset_blue">
					<legend class="legend_blue">Kurumsal Yazılımlar</legend>';
				 	
					
					while ($row=mysql_fetch_array($result_kuryaz,MYSQL_BOTH))
					{
					 echo $row['kuryaz_adi'].' '.$row['kuryaz_aciklama'].' '.$row['kuryaz_programlama_dili'].'<br/>';
						
					}
				  
				echo '</fieldset> </div>';
		}
		
		if(mysql_num_rows($result_pakyaz)>0)
		{
				echo '<div style="width:100%;border:0px;overflow:auto;"> 
					<fieldset class="fieldset_blue">
					<legend class="legend_blue">Paket Yazılımlar</legend>';

					while ($row=mysql_fetch_array($result_pakyaz,MYSQL_BOTH))
					{
					 echo $row['pakyaz_adi'].' '.$row['pakyaz_aciklama'].' '.$row['programlama_dili'].'<br/>';
						
					}
				  
				echo '</fieldset> </div>';
		}
		
		if(mysql_num_rows($result_digyazimlimlar)>0)
		{
				echo '<div style="width:100%;border:0px;overflow:auto;"> 
					<fieldset class="fieldset_blue">
					<legend class="legend_blue">Diğer Yazılımlar</legend>';
				 	
					
					while ($row=mysql_fetch_array($result_digyazimlimlar,MYSQL_BOTH))
					{
					 echo $row['digyaz_adi'].'<br/>'.$row['digyaz_aciklama'];
						
					}
				  
				echo '</fieldset> </div>';
		}
		  
if(isset($_GET["sid"])){
include '../db/mysql_baglanma.php';
}
else{
	include 'db/mysql_baglanma.php';
}
ob_end_flush();