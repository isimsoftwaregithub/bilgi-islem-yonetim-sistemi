<?php


if( isset($_SESSION['login']) ) 
								{
									
								
?>
<script type="text/javascript" >
	 $(document).ready(function(){

		 $('#yazilim_turu').change(function(){
				
			
			 if($("#yazilim_turu").val()!=0){
				 $("#button").show();
			 }
			 else{
				 $("#button").hide();
			 }

			  if($("#yazilim_turu").val()==5)
			  {
				  //$('#yazilim_ekle').resetForm();
				  $("#metyaz").show();
				  $("#yazturid").val($("#yazilim_turu").val());
				  
			  }
			  else{
				  $("#metyaz").hide();
				
			  }

			  if($("#yazilim_turu").val()==6)
			  {
				
				  $("#kuryaz").show();
				  $("#yazturid").val($("#yazilim_turu").val());
				  //$("#kuryazprog").empty().html('<img src="images/16x16.gif" /><br />');
				  $("#kuryazprog").load("cesitlisorgular/uye_bilgisi_getir.php");  
				 //$("#kuryazsorumlu").empty().html('<img src="images/16x16.gif" /><br />');
				  $("#kuryazsorumlu").load("cesitlisorgular/uye_bilgisi_getir.php");  
			  }
			  else{
				  $("#kuryaz").hide();
				
			  }
			  
			  if($("#yazilim_turu").val()==7)
			  {
				
				  $("#pakyaz").show();
				  $("#yazturid").val($("#yazilim_turu").val());
				  //$("#sorumlu1").empty().html('<img src="images/16x16.gif" /><br />');
				  $("#sorumlu1").load("cesitlisorgular/uye_bilgisi_getir.php");  
				  //$("#sorumlu2").empty().html('<img src="images/16x16.gif" /><br />');
				  $("#sorumlu2").load("cesitlisorgular/uye_bilgisi_getir.php");  
			  }
			  else{
				  $("#pakyaz").hide();
				
			  }
			});
			
			$('#yazilim_ekle').on('submit', function(e)
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
	      // $('#yazilim_ekle').resetForm();  // reset form
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		



		    
		 
</script>
<div id="olay">

<p id="title" class="baslik_blue">Yazılım Ekle </p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Yeni Yazılım</legend>
		
		
		
		<form action="yazilimlar/yazilim_ekle.php" id="yazilim_ekle" enctype="multipart/form-data" method="post" >
		<input type="hidden" name="yazturid" id="yazturid" value="" />
			<table class="olay_ekle">
			<tr><th>Yazılım Türü <span class="yıldız_red">*</span></th>
			<td vAlign="top" align="right"><select name="yazilim_turu" id="yazilim_turu">
				<option value="0"></option>
				<option value="5">Firma Yazılımlar</option>
				<option value="6">Kurumsal Yazılımlar</option>
				<option value="7">Paket Yazılımlar</option>
				
			
			</select>
			</td>
			</tr>
			</table>
			
			<div id="metyaz"  style="display:none">
				<table class="olay_ekle">
				<tr><th vAlign="top" scope="row" title="Firma Yazılım Adı" align="left">Ad <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="metyaz_adi"  size="50" id="baslik" maxlength="50"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Açıklama </th><td vAlign="top" align="left"><textarea rows="15" cols="60" name="metyazaciklama" ></textarea></td></tr>
			</table>
			</div>
			<div id="kuryaz"  style="display:none">
				<table class="olay_ekle">
					<tr><th vAlign="top" scope="row" title="Kurumsal Yazılım Adı" align="left">Ad <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="kuryazadi" class="baslik" size="50" id="baslik" maxlength="50"/></td></tr>
					<tr><th vAlign="top" scope="row" title="Programlama Dili" align="left">Programlama Dili</th><td vAlign="top" align="left"><input type="text" title="" name="kuryazprgdili" class="baslik" size="50" id="baslik" maxlength="25"/></td></tr>
					<tr><th vAlign="top" scope="row" align="left">Açıklama </th><td vAlign="top" align="left"><textarea rows="15" cols="60" name="kuryazaciklama" ></textarea></td></tr>
					<tr><th vAlign="top" scope="row" align="left">Programlayan</th><td vAlign="top" align="left"><select id="kuryazprog" name="kuryazprog"></select></td></tr>
					<tr><th vAlign="top" scope="row" align="left">Sorumlu</th><td vAlign="top" align="left"><select id="kuryazsorumlu" name="kuryazsorumlu"></select></td></tr>
				</table>
			</div>
			<div id="pakyaz"  style="display:none">
				<table class="olay_ekle">
					<tr><th vAlign="top" scope="row" title="Paket Yazılım Adı" align="left">Ad <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="pakyazadi" class="baslik" size="50" id="baslik" maxlength="50"/></td></tr>
					<tr><th vAlign="top" scope="row" title="Programlama Dili" align="left">Programlama Dili</th><td vAlign="top" align="left"><input type="text" title="" name="pakyazprgdili" class="baslik" size="50" id="baslik" maxlength="25"/></td></tr>
					<tr><th vAlign="top" scope="row" align="left">Açıklama </th><td vAlign="top" align="left"><textarea rows="15" cols="60" name="pakyazaciklama" ></textarea></td></tr>
					<tr><th vAlign="top" scope="row" align="left" title="Sorumlu Personel">Sorumlu 1</th><td vAlign="top" align="left"><select id="sorumlu1" name="sorumlu1"></select></td></tr>
					<tr><th vAlign="top" scope="row" align="left" title="Varsa İkinci Sorumlu">Sorumlu 2</th><td vAlign="top" align="left"><select id="sorumlu2" name="sorumlu2"></select></td></tr>
				</table>
			</div>
		
			<div id="button" style="display:none">
			<button type="submit" id="upload_button_blue">Ekle</button>
			</div>
		</form>
			<p></p>
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
		<p class="baslik_blue"><img class="img" src="images/add.png"/>Olay Ekle</p>
		<fieldset class="fieldset_blue">
 		<legend id="legend_red"><img src="images/warning.png"/></legend>Olay Eklemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>