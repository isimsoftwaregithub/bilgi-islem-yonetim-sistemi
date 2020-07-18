<?php
ob_start();
//EĞER BİR SUNUCU İSE 

header('Content-Type: text/html; charset=ISO-8859-9');
include '../db/mysql_baglan.php';
$vtid=$_GET['yid'];
$dokuman_tip=$_GET['ytid'];
$sql_dokumanlar="SELECT docID,	dokuman_tip,u.ad,u.soyad,	dokuman_tip_id,	baslik,	aciklama,	
kisiID,	dosya_tipi,	anahtar_kelimeler,	eklenme_tarihi,	
okunma_sayisi,		dosya_adi,	link 
FROM dokumanlar d left join uyeler u on u.sicilno=d.kisiID where dokuman_tip=$dokuman_tip and dokuman_tip_id='$vtid'";
$result=mysql_query($sql_dokumanlar,$link);
$class="even";
if(mysql_num_rows($result)>0){
		echo '<div style="width:100%;height:669px;border:0px;overflow:auto;">
			<table class="kaynak_listesi"  summary="kaynak_listesi">';
		//echo '<thead><th  class="head width10" title="Dosya Türü">~</th><th class="head width200" title="Dosya Türü">Dosya Adı</th><th  class="head width50" title="Dosya Türü">Kişi</th></thead>';	
			while ($row=mysql_fetch_array($result,MYSQL_BOTH))
			{
			
				if (!@file_exists('../kaynak_ico/'.$row['dosya_tipi'].'.png')) 
				{
					
					$dosyatipi="yok.png";
						
				}
				else{
					$dosyatipi=$row['dosya_tipi'].'.png';
				}
			
			echo '<tr class='.$class.'><td class="'.$class.' image"><img title='.$row['dosya_tipi'].' src=kaynak_ico/'.$dosyatipi.' alt="ico"/> </td>
				  <td class="'.$class.' baslik"><a href="bys/'.$row['link'].$row['dosya_adi'].'" title="'.$row['aciklama'].'" target="_blank">'.  $row['baslik'].'</a></td>
				  </tr>
				  <tr class="'.$class.'"><td class="'.$class.' kisi"> '.$row['ad'].' '.$row['soyad'].'</td> <td class="'.$class.' anahtarkelime">'.$row['anahtar_kelimeler'].' - ('.$row['eklenme_tarihi'].')</td></tr>
				  ';
			if($class=="odd")
			{
				$class="even";
			}
			else{
				$class="odd";
			}
			}
		  
		  echo '</table></div>';
}
else{
	
	echo 'Henüz herhangi bir doküman eklenmemiş!';
}
		  

include '../db/mysql_baglanma.php';

ob_end_flush();