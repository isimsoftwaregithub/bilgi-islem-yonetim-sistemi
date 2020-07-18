<?php


if( isset($_SESSION['login']) ) 
								{
								
?>
<script>
	 $(document).ready(function(){
	
		
			
			$('#guvdon_guncelle').on('submit', function(e)
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
		  
	       $('#depuni_ekle').resetForm();  // reset form
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	       $('#chk_san').attr('checked', false);
		   $('#eth_sw').attr('checked', false);
	     
	       
	   }		 

	 $('#chk_san').click(function() {
		    $("#san").toggle(this.checked);
		    $("#portsayisi").toggle(this.checked);
		    
		});
	 $('#eth_sw').click(function() {
		    $("#eth").toggle(this.checked);
		    $("#eth_portsayisi").toggle(this.checked);
		});



	 if($("#sanchk").val()=="1") {
			$('#chk_san').attr('checked', true);
			$("#san").toggle(true);

			if($("#contsayisi").val()!="0") {
				$('#cnt_var').val(2);
				$("#controller").toggle(this.checked);
				$("#controller2").toggle(this.checked);
				$("#controller_sayisi").val($("#contsayisi").val());
				$("#controller_basina_dusen_port_sayisi").val($("#contsayisi2").val());
			} else {
				$("#portsayisi").toggle(this.checked);
				$("#port_sayisi").val($("#san_port_sayisi").val());
			}
		}

		if($("#ethchk").val()=="2") {	
			
			$('#eth_sw').attr('checked', true);
			$("#eth").toggle(true);
		
			if($("#contsayisieth").val()!="0") {
				 $('#eth_cnt_var').val(2);
				 $("#eth_controller").toggle(this.checked);
				 $("#eth_controller2").toggle(this.checked);
				 $("#controller_sayisi_eth").val($("#contsayisieth").val());
				 $("#controller_basina_dusen_port_sayisi_eth").val($("#contsayisi2eth").val());
			} else {
				$("#eth_portsayisi").toggle(this.checked);
				$("#eth_port_sayisi").val($("#ethportsayisi").val());
			}				
		}
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
<?php include 'guvenlik_donanimlari/guvdon_bilgisi_getir.php';?>
<p class="baslik_blue">Güvenlik Donanımı Güncelle</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Güvenlik Donanımı Güncelle</legend>
		<form action="guvenlik_donanimlari/guvdon_guncelle.php" id="guvdon_guncelle" enctype="multipart/form-data" method="post" >
		<input type="hidden"  name="sanchk" id="sanchk" value="<?php echo $row_donanim_ag_bileseni['port_turu']?>"/>
<input type="hidden"  name="contsayisi" id="contsayisi" value="<?php echo $row_donanim_ag_bileseni['controller_sayisi']?>"/>
<input type="hidden"  name="contsayisi2" id="contsayisi2" value="<?php echo $row_donanim_ag_bileseni['controller_basina_dusen_port_sayisi']?>"/>
<input type="hidden"  name="san_port_sayisi" id="san_port_sayisi" value="<?php echo $row_donanim_ag_bileseni['port_sayisi']?>"/>


<input type="hidden"  name="ethchk" id="ethchk" value="<?php echo $row_donanim_ag_bileseni2['port_turu']?>"/>
<input type="hidden"  name="contsayisieth" id="contsayisieth" value="<?php echo $row_donanim_ag_bileseni2['controller_sayisi']?>"/>
<input type="hidden"  name="contsayisi2eth" id="contsayisi2eth" value="<?php echo $row_donanim_ag_bileseni2['controller_basina_dusen_port_sayisi']?>"/>
<input type="hidden"  name="ethportsayisi" id="ethportsayisi" value="<?php echo $row_donanim_ag_bileseni2['port_sayisi']?>"/>
		<input type="hidden"  name="guvdon_id" id="guvdon_id" value="<?php echo $row['guvdon_id']?>"/>
		
		
			<table class="olay_ekle">
				
				<tr><th vAlign="top" scope="row" title="Depolama Unitesi Adı" align="left">Adı <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="guvdon_adi"  value="<?php echo $row['guvdon_adi']?>" size="25" id="guvdon_adi" maxlength="100"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Seri No</th><td vAlign="top" align="left"><input  type="text" name="guvdon_serino"  size="25" maxlength="500" id="guvdon_serino" value="<?php  echo $row['guvdon_serino']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Demirbas No</th><td vAlign="top" align="left"><input  type="text" name="guvdon_demirbasno"  size="25" maxlength="100" id="guvdon_demirbasno" value="<?php echo $row['guvdon_demirbasno']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">IP</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="guvdon_ip"  size="25" maxlength="15" id="guvdon_ip" value="<?php echo $row['guvdon_ip']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Notlar </th><td vAlign="top" align="left"><textarea rows="4" cols="40" name="guvdon_notlar" ><?php  echo  $row['guvdon_notlar']?></textarea></td></tr>
				<tr><th vAlign="top" scope="row" title="Aktif ?" align="left">Aktif</th><td vAlign="top" align="left">
				<select name="aktif"> 
				<option value="1" <?=$row['aktif'] == '1' ? ' selected="selected"' : '';?>>Evet</option>
				<option value="0" <?=$row['aktif'] == '0' ? ' selected="selected"' : '';?>>Hayır</option>
				</select></td></tr>
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
<button type="submit" id="upload_button_blue">Güncelle</button>
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
 		<legend id="legend_red">Uyarı</legend>Depolama Unitesi Güncellemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>