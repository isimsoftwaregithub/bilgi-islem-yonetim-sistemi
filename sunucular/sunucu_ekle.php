<?php if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){?>
 <script type="text/javascript" >
	 $(document).ready(function(){

	 $('#sunucu_turu').change(function() {
			
			 if($("#sunucu_turu").val()=="2"){
			 //alert( $("#sunucu_turu").val());
			 $("#sanallastirma_sunuculari").empty().html('<img src="images/16x16.gif" /><br />');
			 $("#sanallastirma_sunuculari").load("cesitlisorgular/sanallastirma_suncularini_getir.php");
			 }
			 else{
				 $("#sanallastirma_sunuculari").empty();
			 }
			});
		 $('#firma').change(function() {
			
			 if($("#firma").val()!="0"){
				
			 $("#firma_calisani").empty().html('<img src="images/16x16.gif" /><br />');
			 $("#firma_calisani").load("cesitlisorgular/firma_calisani_getir.php?firma_id="+$("#firma").val());
			 }
			 else{
				 $("#firma_calisani").empty();
			 }
			});

		 $('#chk_san').click(function() {
			    $("#san").toggle(this.checked);
			    
			});
		 $('#eth_sw').click(function() {
			    $("#eth").toggle(this.checked);
			    
			});
			
		 $("#portsayisi").toggle(true);
		 $("#eth_portsayisi").toggle(true);
		 $('#eth_cnt_var').change(function() {
			 if($('#eth_cnt_var').val()==2){
				   $("#eth_controller").toggle(this.checked);
				   $("#eth_controller2").toggle(this.checked);
				   $("#eth_portsayisi").toggle(this.checked);
			 }
			 else{
				 $("#eth_portsayisi").toggle(this.checked);
				 $("#eth_controller").toggle(this.checked);
				  $("#eth_controller2").toggle(this.checked);
			 }
			});
		 $('#cnt_var').change(function() {
			 if($('#cnt_var').val()==2){
				   $("#controller").toggle(this.checked);
				   $("#controller2").toggle(this.checked);
				   $("#portsayisi").toggle(this.checked);
			 }
			 else{
				 $("#portsayisi").toggle(this.checked);
				 $("#controller").toggle(this.checked);
				  $("#controller2").toggle(this.checked);
			 }
			});
		
		$( "#tabs" ).tabs({
	   		event: "mouseover"

				
			});

		
			
			$( "#datepicker" ).datepicker( $.datepicker.regional[ "tr" ] );
			
		

		
		$('#sunucuekle').on('submit', function(e)
					    {
				    		e.preventDefault();
					        $('#upload_button_blue').attr('disabled', ''); // disable upload button
					        //show uploading message
					        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Lütfen Bekleyin"\/> <span>Ekleniyor...<\/span><\/div>');
					        $(this).ajaxSubmit({
					        target: '#output',
					        success:  afterSuccess //call function after success
					        });
		});

	 function afterSuccess()
		   {
		      //$('#sunucuekle').resetForm();  // reset form
		       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
		       $("#san").attr('style','display:none');
		       $("#controller").attr('style','display:none');
			   $("#controller2").attr('style','display:none');
			   $("#portsayisi").toggle(true);

		       $("#eth").attr('style','display:none');
		       $("#eth_controller").attr('style','display:none');
			   $("#eth_controller2").attr('style','display:none');
			   $("#eth_portsayisi").toggle(true);
			   $('#chk_san').attr('checked', false);
			   $('#eth_sw').attr('checked', false);
		   }		  
	});
	
		    
		 
</script>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
 <meta http-equiv="content-language" content="TR"/>
<div id="sunucu_ekle">

<p class="baslik_blue">Yeni Sunucu Ekle</p>
<div id="flow">
<form action="sunucular/yeni_sunucu_ekle.php" id="sunucuekle"  method="post" >

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Sunucu Bilgileri (1)</a></li>
		<li><a href="#tabs-2">Diğer Bilgiler (2)</a></li>
		<li><a href="#tabs-3">Ağ Bileşenleri (3)</a></li>
	</ul>
	<div id="tabs-1">
	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Sunucu Adı <span class="yıldız_red">*</span></th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Sunucu Adı" name="sunucu_adi" maxlength="50" size="25" id="sunucu_adi" />
 	</td>
 </tr>
  <tr class="odd"> 
 	<th align="left" class="odd" valign="top" scope="row">Seri No / Demirbaş No</th>
 	<td align="left" class="odd" valign="top">
 		<input type="text" title="Seri No" name="serino" maxlength="150" size="15" id="serino" /> /
 		<input type="text" title="Demirbaş No" name="sunucu_demirbasno" maxlength="50" size="15" id="sunucu_demirbasno" />
 	</td>
 </tr>
 <tr class="odd">
 	<th align="left" class="odd" valign="top" scope="row">Sunucu Görevi</th>
 	<td align="left" class="odd" valign="top">
 		<input type="text" title="Sunucu Görevi" name="sunucu_gorevi"  maxlength="50" size="25" id="sunucu_gorevi" />
 	</td>
 </tr>
 <tr class="even">
	<th align="left" class="even" valign="top" scope="row">Sunucu Türü</th>
	<td align="left" class="even" valign="top">
		<select name="sunucu_turu" id="sunucu_turu">
			<option value="3">Fiziksel Sunucu</option>
			<option value="2">Sanal Sunucu</option>
			<option value="1">Sanallaştırma Sunucusu</option>
		</select>
		
		<div id="sanallastirma_sunuculari"></div>
	</td>
 </tr>
 <tr class="odd">
	<th align="left" class="odd" valign="top" scope="row">IP Adresi</th>
	<td align="left" class="odd" valign="top">
		<input type="text" title="IP Adresi" name="ip_adresi1"  maxlength="20" size="12" id="ip_adresi1" /> 
	 	<input type="text" title="IP Adresi 2" name="ip_adresi2"  maxlength="20" size="12" id="ip_adresi2" />
	 </td>
 </tr>
 <tr class="even">
	 <th align="left" class="even" valign="top" scope="row">Marka / Model</th>
	 <td align="left" class="even" valign="top">
	 	<input type="text" title="Marka" name="marka"  maxlength="50" size="12" id="marka" />
	 	<input type="text" title="Model" name="model"  maxlength="50" size="12" id="model" />
	 </td>
 </tr>
  <tr class="odd">
	  <th align="left" class="odd" valign="top" scope="row">İşletim Sistemi</th>
	  <td align="left" class="odd" valign="top">
	  	<input type="text" title="İşletim Sistemi" name="isletim_sistemi"  maxlength="250" size="25" id="isletim_sistemi" />
	  </td>
  </tr>
 <tr class="even">
	 <th align="left" class="even" valign="top" scope="row">Sistem Odası</th>
 	<td align="left" class="even" valign="top">
 	 	<?php include 'cesitlisorgular/lokasyon_getir.php';?>
 	</td>
 </tr>
 <tr class="odd">
 	<th align="left" class="odd" valign="top" scope="row">Sunucu Tipi</th>
 	<td align="left" class="odd" valign="top">
 	  <select name="sunucu_tipi" id="sunucu_tipi">
	   <option value="Rack">Rack</option>
	   <option value="Blade">Blade</option>
	   <option value="Standart">Standart</option>
	  </select>
 	</td>
 </tr>
 <tr class="even">
 	<th align="left" class="even" valign="top" scope="row">CPU Modeli / Soket sayısı / Soket core sayısı / Frekansı</th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="CPU Türü" name="cpu_turu"  maxlength="150" size="12" id="cpu_turu" />
 		<input type="text" onkeypress="isnumber(cpu_soket_sayisi)" title="CPU Soket Sayısı" name="cpu_soket_sayisi"  maxlength="9" size="2" id="cpu_soket_sayisi" />
 		<input type="text" onkeypress="isnumber(cpu_soket_core_sayisi)" title="CPU Soket Core Sayısı" name="cpu_soket_core_sayisi"  maxlength="9" size="2" id="cpu_soket_core_sayisi" />
 		<input type="text" title="CPU Frekansı" name="cpu_frekansi"  maxlength="10" size="5" id="cpu_frekansi" />
 	</td>
 </tr>
<tr class="odd">
	<th align="left" class="odd" valign="top" scope="row">Dosyalama Türü/Sistemi</th>
	<td align="left" class="odd" valign="top">
	  <select name="dosyalama_tipi" id="dosyalama_tipi">
	   <option value="32 Bit">32 Bit</option>
	   <option value="64 Bit">64 Bit</option>
	  </select>
	   <select name="dosyalama_sistemi" id="dosyalama_sistemi">
	   <option value="NTFS">NTFS</option>
	   <option value="FAT32">FAT32</option>
	   <option value="FAT12">FAT12</option>
	   <option value="FAT16">FAT16</option>
	   <option value="ReiserFS">ReiserFS</option>
	   <option value="ext">ext</option>
	     <option value="ext2">ext2</option>
      <option value="ext3">ext3</option>
       <option value="ext4">ext4</option>
       <option value="HFS">HFS</option>
       <option value="HFS+">HFS+</option>
         <option value="XFS">XFS</option>
          <option value="ZFS">ZFS</option>
	  </select>
	</td>
</tr>
<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Ram Türü / Toplamı</th>
	<td align="left" class="even" valign="top">
	  <select name="ram_turu" id="ram_turu">
	   <option value="DDR">DDR</option>
	   <option value="DDR2">DDR2</option>
	   <option value="DDR2">DDR3</option>
	  </select>
	  <input type="text" title="Toplam Ram" name="ram_toplami"  maxlength="20" size="5" id="ram_toplami" />
	</td>
</tr>
<tr class="odd">
	<th align="left" class="odd" valign="top" scope="row">Ram Toplam / Dolu Soket Sayısı</th>
	<td align="left" class="odd" valign="top">
		 <input type="text" onkeypress="isnumber(ram_toplam_soket_sayisi)" title="Ram Toplam Soket Sayısı" name="ram_toplam_soket_sayisi"  maxlength="9" size="12" id="ram_toplam_soket_sayisi" />
		 <input type="text" onkeypress="isnumber(ram_dolu_soket_sayisi)" title="Ram Dolu Soket Sayısı" name="ram_dolu_soket_sayisi"  maxlength="9" size="12" id="ram_dolu_soket_sayisi" />
	</td>
</tr>
<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Yerel Disk Özellikleri</th>
	<td align="left" class="even" valign="top">
	<input type="text" title="Yerel Disk Bilgileri" name="yerel_disk_bilgileri"  maxlength="100" size="20" id="yerel_disk_bilgileri" />
	 <select name="yerel_disk_yapisi" id="yerel_disk_yapisi">
	   <option value="0">&nbsp;</option>
	   <option value="Raid 0">Raid 0</option>
	   <option value="Raid 1">Raid 1</option>
	   <option value="Raid 2">Raid 2</option>
	   <option value="Raid 5">Raid 5</option>
	   <option value="Raid 6">Raid 6</option>
	   
	  </select>
 	</td>
</tr>
<tr class="odd">
	<th align="left" class="odd" valign="top" scope="row">Harici Disk Özellikleri</th>
	<td align="left" class="odd" valign="top">
		<?php include 'cesitlisorgular/depolama_unitesi_getir.php';?>
		<p> </p> 
		<select name="harici_disk_yapisi" id="harici_disk_yapisi">
			<option value="0">&nbsp;</option>
			<option value="Raid 0">Raid 0</option>
			<option value="Raid 1">Raid 1</option>
			<option value="Raid 2">Raid 2</option>
			<option value="Raid 5">Raid 5</option>
			<option value="Raid 6">Raid 6</option>
		</select>
	   <input type="text" title="Depolama Unitesi Açıklama" name="depuni_sunucu_aciklama"  maxlength="100" size="22" id="depuni_sunucu_aciklama" />
 	</td>
</tr>
<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Alınma Tarihi</th>
	<td align="left" class="even" valign="top">
		<input type="text" name="alinma_tarihi" maxlength="10" id="datepicker" />
	</td>
</tr>
<tr class="odd">
	<th align="left" class="odd" valign="top" scope="row">Garanti Süresi</th>
	<td align="left" class="odd" valign="top">
		<input  type="text" title="Garanti Süresi" name="garanti_suresi"  maxlength="25" size="22" id="garanti_suresi" />
	</td>
</tr>
	<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Notlar	</th>
	<td align="left" class="even" valign="top">
		<textarea rows="4" cols="50" name="notlar"></textarea>
	</td>
</tr>
</tbody>

</table>
<!--			<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>-->
</div>
	<div id="tabs-2">

<fieldset class="fieldset_blue">
<legend class="legend_blue">Veritabanları</legend>
	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Veritabanı</th>
 	<td align="left" class="even" valign="top">
 		
	<?php include 'cesitlisorgular/veri_tabanı_getir.php';?>
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
		
		<div id="firma_calisani"></div>
	</td>
</tr>
</tbody>

</table>
</fieldset>


</div>
	
<div id="tabs-3">
<fieldset class="fieldset_blue">
	<legend class="legend_blue">SAN Switch Bilgileri</legend>
	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row"><input title="SAN Switch Var? Yok?" type="checkbox" name="san" id="chk_san"/> SAN Switch</th>
 	<td align="left" class="odd" valign="top"  ></td> 	<td align="left" class="odd" valign="top" ></td>
 </tr>

  <tr class="odd" id="san" style="display:none"> 
 	<th align="left" class="odd" valign="top" scope="row">Controller 
 	<select id="cnt_var" name="cnt_var">
 	<option value="1">Yok</option>
 	<option value="2">Var</option>
 	</select>
	</th>

 	<td align="left" class="odd" valign="top" id="controller" style="display:none">
 	Controller Sayısı <input type="text" title="Seri No" name="controller_sayisi" maxlength="2" size="5" id="controller_sayisi" /></td>
	<td align="left" class="odd" valign="top" id="controller2" style="display:none; text-align:left">Cont. Başına Düşen Port Sayısı 
	<input type="text" title="Controller Başına Düşen Port Sayısı" name="controller_basina_dusen_port_sayisi" maxlength="150" size="15" id="controller_basina_dusen_port_sayisi" /></td>
 	<td align="left" class="odd" valign="top" id="portsayisi" style="display:none" >
 	Port Sayısı <input type="text" title="Seri No" name="port_sayisi" maxlength="2" size="5" id="port_sayisi" /> 
 	</td>
 	
 </tr>

</tbody>

</table>
</fieldset>

<fieldset class="fieldset_blue">
	<legend class="legend_blue">Ethernet Switch Bilgileri</legend>
	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row"><input title="Ethernet Switch Var? Yok?" type="checkbox" name="eth_sw" id="eth_sw"/>Ethernet Switch  </th>
 	<td align="left" class="odd" valign="top"  ></td> 	<td align="left" class="odd" valign="top" ></td>
 </tr>

  <tr class="odd" id="eth" style="display:none"> 
 	<th align="left" class="odd" valign="top" scope="row">Controller 
 	<select id="eth_cnt_var" name="eth_cnt_var">
 	<option value="1">Yok</option>
 	<option value="2">Var</option>
 	</select>
	</th>

 	<td align="left" class="odd" valign="top" id="eth_controller" style="display:none">
 	Controller Sayısı <input type="text" title="Controller Sayısı" name="eth_controller_sayisi" maxlength="2" size="5" id="controller_sayisi" /></td>
	<td align="left" class="odd" valign="top" id="eth_controller2" style="display:none; text-align:left">Cont. Başına Düşen Port Sayısı 
	<input type="text" title="Controller Başına Düşen Port Sayısı" name="eth_controller_basina_dusen_port_sayisi" maxlength="150" size="15" id="eth_controller_basina_dusen_port_sayisi" /></td>
 	<td align="left" class="odd" valign="top" id="eth_portsayisi" style="display:none" >
 	Port Sayısı <input type="text" title="Seri No" name="eth_port_sayisi" maxlength="2" size="5" id="eth_port_sayisi" /> 
 	</td>
 	
 </tr>

</tbody>

</table>
</fieldset>
<!--			<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>-->
<button type="submit" class="upload_button_blue" id="upload_button_blue">Ekle</button>
	<p id="output"></p>
</div>

</div>

</form>
</div>
</div>
<?php 

	}
}

?>

