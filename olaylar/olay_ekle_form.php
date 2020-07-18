<?php


if( isset($_SESSION['login']) ) 
								{
									
								
?>
<script src="../ckeditor/ckeditor.js"></script>

<script type="text/javascript" >
	 $(document).ready(function(){
	
		 $('#olay_tip').change(function(){
				
			
			  if($("#olay_tip").val()=="0" || $("#olay_tip").val()=="8" ){
			 	
			 	$("#olay_tip_id").empty();
			  }
			  else{
				 	$("#olay_tip_id").empty().html('<img src="images/16x16.gif" /><br />');
				 	$("#olay_tip_id").load("olaylar/olay_tur_id_getir.php?tip_id="+$("#olay_tip").val());  
			  }
			});


			
			$('#olay_ekle').on('submit', function(e)
				    {
			    	
				       	e.preventDefault();
				       	for ( instance in CKEDITOR.instances )
				        	CKEDITOR.instances[instance].updateElement();
				        $('#upload_button_blue').attr('disabled', ''); // disable upload button
				        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Lütfen Bekleyiniz..."/> <span>Ekleniyor...</span></div>');
				        $(this).ajaxSubmit({
				        target: '#output',
				        success:  afterSuccess //call function after success
				        });
					});

	
	 function afterSuccess()
	   {
		
	       //$('#olay_ekle').resetForm();  // reset form
	     
	       if($("#output").html().match(/error/)==null){
	    	 $("#olay_tip_id").empty();
		     $('#olay_ekle').resetForm();
		     $('#aciklama').empty().html('');
	       }
		       
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		// Replace the <textarea id="editor"> with an CKEditor
		// instance, using default configurations.
		CKEDITOR.replace( 'aciklama', {
			
			toolbar: [
			  		// { name: 'document',    groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', 'Templates', 'document' ] },
    // On the basic preset, clipboard and undo is handled by keyboard.
    // Uncomment the following line to enable them on the toolbar as well.
    // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo' ] },
   
   
    //{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
   
    { name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'BidiLtr', 'BidiRtl' ] },
    { name: 'links', items: [ 'Link', 'Unlink' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'UIColor', 'Maximize', 'ShowBlocks' ] },
    { name: 'editing',     groups: [ 'find', 'selection' ], items: [ 'Find', 'Replace', 'SelectAll' ] },
    { name: 'insert', items: [  'Table', 'Smiley', 'SpecialChar' ] }
   // { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', 'SelectAll', 'Scayt' ] }
			  	]
		});



		    
		 
</script>
<div id="olay">

<p class="baslik_blue">Olay Ekle</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Yeni Olay</legend>
		
		<form action="olaylar/olay_ekle.php" id="olay_ekle" name="olay_ekle" enctype="multipart/form-data" method="post" >
			<table class="olay_ekle">
				<tr><td vAlign="top" align="left"><select name="olay_tip" id="olay_tip">
				<option value="0">Genel Konu</option>
				<option value="1">Sunucular</option>
				<option value="2">Veritabanları</option>
				<option value="3">Depolama Üniteleri</option>
				<option value="4">Ağ Elemanlari</option>
				<option value="9">Güvenlik Donanimlari</option>
				<option value="5">Firma Yazılımlar</option>
				<option value="6">Kurumsal Yazılımlar</option>
				<option value="7">Paket Yazılımlar</option>
				<option value="8">Diğer Yazılımlar</option>
				</select>
				</td><td><div id="olay_tip_id"></div></td></tr>
				<tr><th vAlign="top" scope="row" title="Olay için bir başlık ekleyin" align="left">Başlık <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="baslik" class="baslik" size="50" id="baslik" maxlength="250"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Anahtar Kelimeler</th><td vAlign="top" align="left">
				<input maxlength="100"  type="text" name="anahtar_kelime" class="anahtar_kelime" size="50" id="anahtar_kelime"  style="text-transform: lowercase;"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Dosya</th><td vAlign="top" align="left"><input type="file"   name="files[]" id="file"  multiple/></td></tr>
				<tr><th vAlign="top" scope="row" align="left"></th><td></td></tr>
				
			</table>
		<textarea rows="40" cols="50" id="aciklama" name="aciklama" ></textarea><p>
		<button type="submit" id="upload_button_blue">Ekle</button> 
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
		<p class="baslik_blue"><img class="img" src="images/add.png"/>Olay Ekle</p>
		<fieldset class="fieldset_blue">
 		<legend id="legend_red"><img src="images/warning.png"/></legend>Olay Eklemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>