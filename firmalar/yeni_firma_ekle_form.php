<?php if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){?>
 	<script>
	 $(document).ready(function(){

	
		$('#firmaekle').on('submit', function(e)
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
		      $('#firmaekle').resetForm();  // reset form
		      $('#upload_button_blue').removeAttr('disabled'); //enable submit button
		      $("#output").html('<p>Yeni Firma Ekleme Başarılı</p>')
		   }	  
	});
	
		    
		 
</script>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
 <meta http-equiv="content-language" content="TR"/>
<div id="sunucu_ekle">

<p class="baslik_blue">Yeni Firma Ekle</p>
<div id="flow">
<form action="firmalar/yeni_firma_ekle.php" id="firmaekle"  method="post" >


	<table class="sunucu_detay">

 <tbody>
 <tr class="even"> 
 	<th align="left" class="even" valign="top" scope="row">Firma Adı <span class="yıldız_red">*</span></th>
 	<td align="left" class="even" valign="top">
 		<input type="text" title="Firma Adı" name="firma" maxlength="200" size="25" id="firma" />
 	</td>
 </tr>
  <tr class="odd"> 
 	<th align="left" class="odd" valign="top" scope="row">Tel No</th>
 	<td align="left" class="odd" valign="top">
 		<input type="text" title="Firma Telefon No" name="telefon" maxlength="50" size="25" id="telefon" />
 	</td>
 </tr>


<tr class="even">
	<th align="left" class="even" valign="top" scope="row">Adres</th>
	<td align="left" class="even" valign="top">
	<textarea rows="4" cols="50" name="adres" title="Firma Adresi"></textarea>
	</td>
	</tr>
<tr class="odd"> 
 	<th align="left" class="odd" valign="top" scope="row">Web Adresi</th>
 	<td align="left" class="odd" valign="top">
 		<input type="text" title="Web Adresi" name="web" maxlength="50" size="25" id="web" />
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

