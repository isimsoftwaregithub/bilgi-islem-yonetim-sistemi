<fieldset class="fieldset_blue">
<legend class="legend_blue">Veritabanları</legend>
	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Veritabanı</th>
 	<td align="left" class="even" valign="top">
 		
	<?php include '../cesitlisorgular/veri_tabanı_getir.php';?>
 	</td>
 </tr>

 
</tbody>

</table>
</fieldset>
<fieldset class="fieldset_blue">
	<legend class="legend_blue">Firma Yazılımlar</legend>
<table class="sunucu_detay">

 <tbody>
  <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Firma Yazılım</th>
 	<td align="left" class="even" valign="top">
 		<?php include 'cesitlisorgular/firma_yazilim_getir.php';?>
 		
 	</td>
 </tr>
 
</tbody>

</table>
</fieldset>
<fieldset class="fieldset_blue">
	<legend class="legend_blue">Kurumsal Yazılımlar</legend>
<table class="sunucu_detay">

 <tbody>
<tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Kurumsal Yazılım</th>
 	<td align="left" class="even" valign="top">
 		<?php include 'cesitlisorgular/kurumsal_yazilim_getir.php';?>
 	</td>
 </tr>
 
</tbody>

</table>
</fieldset>
<fieldset class="fieldset_blue">
	<legend class="legend_blue">Paket Yazılımlar</legend>
<table class="sunucu_detay">

 <tbody>
<tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Paket Yazılım</th>
 	<td align="left" class="even" valign="top">
 		<?php include 'cesitlisorgular/paket_yazilim_getir.php';?>
 	</td>
 </tr>
 
</tbody>

</table>
</fieldset>

<fieldset class="fieldset_blue">
	<legend class="legend_blue">Diğer Yazılımlar</legend>
<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Yazılım Adı</th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Yazılım Adı" name="digyaz_adi" maxlength="150" size="25" id="digyaz_adi" />
 	</td>
 </tr>
  <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Açıklama</th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Açıklama" name="digyaz_aciklama" maxlength="1000" size="25" id="digyaz_aciklama" />
 	</td>
 </tr>
</tbody>

</table>
</fieldset>

<fieldset class="fieldset_blue">
	<legend class="legend_blue">Firma Bilgileri</legend>
<table class="sunucu_detay">

 <tbody>
<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Firma</th>
	<td align="left" class="even" valign="top">
		 	<?php include 'cesitlisorgular/firma_getir.php';?>
		  	<p>&nbsp;</p><div id="firma_calisani"></div>
	</td>
</tr>
</tbody>

</table>
</fieldset>