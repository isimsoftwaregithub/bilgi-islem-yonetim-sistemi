<?php


if( isset($_SESSION['login']) ) 
								{
								
?>
<script>
	 $(document).ready(function(){
	
		
			
			$('#depuni_ekle').on('submit', function(e)
				    {
			    	
				        e.preventDefault();
				        $('#upload_button_blue').attr('disabled', ''); // disable upload button
				        //show uploading message
				        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Lütfen Bekleyin"/> <span>Ekleniyor...</span></div>');
				        $(this).ajaxSubmit({
				        target: '#output',
				        success:  afterSuccess //call function after success
				        });
					});
			
	 function afterSuccess()
	   {
	      // $('#depuni_ekle').resetForm();  // reset form
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

	    
});
		
		



		    
		 
</script>
<div id="olay">
<p class="baslik_blue">Depolama Unitesi Ekle</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Yeni Depolama Unitesi Ekle</legend>
		<form action="depolama_uniteleri/depolama_unitesi_ekle.php" id="depuni_ekle" enctype="multipart/form-data" method="post" >
			<table class="olay_ekle">
				<tr><th vAlign="top" scope="row" title="Disk? / Teyp?" align="left">Tip <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><select name="depuni_tip"> 
				<option value="Disk">Disk</option><option value="Teyp">Teyp</option></select></td></tr>
				<tr><th vAlign="top" scope="row" title="Depolama Unitesi Adı" align="left">Adı <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="depuni_adi"  size="25" id="depuni_adi" maxlength="50"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Seri No</th><td vAlign="top" align="left"><input  type="text" name="dep_uni_serino"  size="25" maxlength="500" id="dep_uni_serino" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Demirbas No</th><td vAlign="top" align="left"><input  type="text" name="depuni_demirbasno"  size="25" maxlength="100" id="depuni_demirbasno" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Marka/Model</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="depuni_marka_model"  size="25" maxlength="150" id="depuni_marka_model" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Disk Boyutu</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="dep_uni_disk_boyutlari"  size="25" maxlength="500" id="dep_uni_disk_boyutlari" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">IP</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="depuni_ip"  size="25" maxlength="25" id="depuni_ip" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">İşletim Sistemi</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="dep_uni_isletim_sistemi"  size="25" maxlength="50" id="dep_uni_isletim_sistemi" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Disk Aray Bilgileri </th><td vAlign="top" align="left"><textarea rows="8" cols="40" name="dep_uni_disk_array_bilgileri" ></textarea></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Notlar </th><td vAlign="top" align="left"><textarea rows="4" cols="40" name="depuni_notlar" ></textarea></td></tr>
			</table>
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
<button type="submit" id="upload_button_blue">Ekle</button>
	<p id="output"></p>
</div>
		</form>
			<div id="output"></div>
			<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>
	</fieldset>


</div>
</div>
<!---->
<?php 
	}
	else{
		?>
		<div id="olay">
		<p class="baslik_blue"><img class="img" src="images/add.png"/>Depolama Unitesi</p>
		<fieldset class="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Depolama Unitesi Eklemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>