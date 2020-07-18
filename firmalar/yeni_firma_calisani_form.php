<?php if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){?>
 	<script>
	 $(document).ready(function(){

	
		$('#firmacalekle').on('submit', function(e)
					    {
				    	
					        e.preventDefault();
					        $('#upload_button_blue').attr('disabled', ''); // disable upload button
					        //show uploading message
					        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Lütfen Bekleyin"/> <span>Yükleniyor...</span></div>');
					        $(this).ajaxSubmit({
					        target: '#output',
					        success:  afterSuccess //call function after success
					        });
		});
	
		
		 function afterSuccess()
		   {
		     // $('#firmacalekle').resetForm();  // reset form
		      $('#upload_button_blue').removeAttr('disabled'); //enable submit button
		    
		   }	  
	});
	
		    
		 
</script>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
 <meta http-equiv="content-language" content="TR"/>
<div id="sunucu_ekle">

<p class="baslik_blue">Yeni Firma Çalışanı Ekle</p>
<div id="flow">
<form action="firmalar/yeni_firma_calisani_ekle.php" id="firmacalekle"  method="post" >


	<table class="sunucu_detay">

 <tbody>
 <tr class="even">
	<th align="left" class="even" valign="top" scope="row">Firma<span class="yıldız_red">*</span></th>
	<td align="left" class="even" valign="top">
		 	<?php include 'cesitlisorgular/firma_getir.php';?>
		  	
	</td>
</tr>
 
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Ad Soyad <span class="yıldız_red">*</span></th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Firma Çalışan Adı" name="adi_soyadi" maxlength="50" size="25" id="adi_soyadi" />
 	</td>
 </tr>
  <tr class="odd"> 
 	<th align="left" class="odd" valign="top" scope="row">Tel No</th>
 	<td align="left" class="odd" valign="top">
 		<input type="text" title="Firma Çalışan Telefon No" name="telefon" maxlength="50" size="25" id="telefon" />
 	</td>
 </tr>


 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">E-Posta</th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Firma Çalışan E-Posta" name="eposta" maxlength="50" size="25" id="eposta" />
 	</td>
 </tr>
</tbody>

</table>











	<button type="submit" id="upload_button_blue">Ekle</button>
	<p id="output"></p>
			<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>
	


</form>
</div>
</div>
<?php 

	}
}

?>

