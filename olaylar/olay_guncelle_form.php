<?php
session_start();
if( isset($_SESSION['login']) ) 
{
if(isset($_GET["oid"])){
if($_GET["oid"]!="")
{	
	ob_start();
include '../db/mysql_baglan.php';					
$olay_id=$_GET["oid"];
$sql_olay_guncelle="SELECT * FROM olaylar where olay_id=".$olay_id;
$result=mysql_query($sql_olay_guncelle,$link);
$row=mysql_fetch_array($result,MYSQL_BOTH);		

?>		
		
		<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
		<script type="text/javascript" src="../js/jquery.form.js"></script>
		<script src="../ckeditor/ckeditor.js"></script>
		<link rel="stylesheet" href="../ckeditor/sample.css"/>


<script type="text/javascript">
	 $(document).ready(function(){
		 $("#olay_tip").val($("#olaytip").val());
			 if($("#olay_tip").val()=="0" || $("#olay_tip").val()=="7" ){
			 	$("#olay_tip_id").empty().html('<img src="../images/16x16.gif" /><br />');
			 	$("#olay_tip_id").empty();
			  }
			  else{
				 	$("#olay_tip_id").empty().html('<img src="../images/16x16.gif" /><br />');
				 	$("#olay_tip_id").load("olay_tur_id_getir.php?tip_id="+$("#olay_tip").val()+"&tipid="+$("#olaytipid").val());  
			  }
			 	
				$("#ekler").load("olay_dokuman_listesi.php?oid="+$("#olayid").val());  
		 		$('#olay_tip').change(function(){
				
			
			 //alert( $("#sunucu_turu").val());
			  if($("#olay_tip").val()=="0" || $("#olay_tip").val()=="7" ){
			 	$("#olay_tip_id").empty().html('<img src="images/16x16.gif" /><br />');
			 	$("#olay_tip_id").empty();
			  }
			  else{
				 	$("#olay_tip_id").empty().html('<img src="../images/16x16.gif" /><br />');
				 	$("#olay_tip_id").load("olay_tur_id_getir.php?tip_id="+$("#olay_tip").val());  
			  }
			});
			
			
			
			$('#olay_guncelle').on('submit', function(e)
				    {
				        //e.preventDefault();
				        $('#upload_button_blue').attr('disabled', ''); // disable upload button
				        //show uploading message
				        $("#output").html('<div style="padding:10px"><img src="../images/ajax-loader.gif" alt="Lütfen Bekleyin"/> <span style="font-size:12px;">Güncelleniyor...</span></div>');
				        $(this).ajaxSubmit({
				        target: '#output',
				        success:  afterSuccess //call function after success
				        });
					});
				$('span').click(function(){
					
				$.ajax({ url: 'olay_dokuman_sil.php?odid='+$(this).attr("value")});
				
				$("#div_"+$(this).attr("value")).hide();
						
		});
	
	   function afterSuccess()
	     {
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	     }		  
});

</script>
<script type="text/javascript">

		// Replace the <textarea id="editor"> with an CKEditor
		// instance, using default configurations.
	//	alert("asdsad");
		//CKEDITOR.replace( 'aciklama' );
//		CKEDITOR.replace( 'aciklama', {
//			toolbar: [
//			  		// { name: 'document',    groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', 'Templates', 'document' ] },
// // On the basic preset, clipboard and undo is handled by keyboard.
// // Uncomment the following line to enable them on the toolbar as well.
// // { name: 'clipboard',   groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', 'Undo', 'Redo' ] },
//
// //{ name: 'insert', items: [ 'CreatePlaceholder', 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe', 'InsertPre' ] },
// //{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
//
// { name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
// { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'BidiLtr', 'BidiRtl' ] },
// { name: 'links', items: [ 'Link', 'Unlink' ] },
// '/',
// { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
// { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
// { name: 'tools', items: [ 'UIColor', 'Maximize', 'ShowBlocks' ] },
// { name: 'editing',     groups: [ 'find', 'selection' ], items: [ 'Find', 'Replace', 'SelectAll' ] }
//// { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', 'SelectAll', 'Scayt' ] }
//			  	]
//		});
</script>

<link rel="stylesheet" href="css/olay_guncelle.css" type="text/css"/>

<div id="olay">
<input type="hidden"  id="olaytip" value="<?php echo $row['olay_tip']?>"/>
<input type="hidden"  id="olaytipid" value="<?php echo $row['olay_tip_id']?>"/>
<input type="hidden"  id="olayid" value="<?php echo $row['olay_id']?>"/>

 
<p class="baslik_blue">Olay Güncelle</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Olay Güncelle</legend>
		
		<form action="olay_guncelle.php?oid=<?php echo $row['olay_id']?>" id="olay_guncelle" enctype="multipart/form-data" method="post" >
			<table class="olay_guncelle">
				<tr><td vAlign="top" align="left"><select name="olay_tip" id="olay_tip">
				<option value="0">Genel Konu</option>
				<option value="1">Sunucular</option>
				<option value="2">Veritabanları</option>
				<option value="3">Depolama Üniteleri</option>
				<option value="4">Ağ Elemanlari</option>
				<option value="9">Guvenlik Donanimlari</option>
				<option value="5">Firma Yazılımlar</option>
				<option value="6">Kurumsal Yazılımlar</option>
				<option value="7">Paket Yazılımlar</option>
				<option value="8">Diğer Yazılımlar</option>
				</select>
				</td><td><div id="olay_tip_id"></div></td></tr>
				<tr><th vAlign="top" scope="row" title="Olay için bir başlık ekleyin" align="left">Başlık <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="baslik"  maxlength="250" class="baslik" size="50" id="baslik" value="<?php echo $row['baslik']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Anahtar Kelimeler</th><td vAlign="top" align="left"><input type="text" name="anahtar_kelime" class="anahtar_kelime" size="50" id="anahtar_kelime" value="<?php echo $row['anahtar_kelimeler']?>"/></td></tr>
				<?php $sql_olay_ek="SELECT olay_dokuman_id,ek_adi,ek_link FROM olay_dokumanlar WHERE olay_id=".$olay_id;
					$result_ek=mysql_query($sql_olay_ek,$link);
					if(mysql_num_rows($result_ek)>0){
				?>
				<tr><th vAlign="top" scope="row" align="left">Ekler</th><td class="ekler" ><?php					
					while($row_ek=mysql_fetch_array($result_ek,MYSQL_BOTH)){
					echo '<div id="div_'.$row_ek["olay_dokuman_id"].'"><a href="'.$row_ek["ek_link"].$row_ek["ek_adi"].'" target="_blank"  title="Tıklayınız...">'.$row_ek["ek_adi"].' </a>&nbsp;&nbsp;<span id="sil" class="sil" title="Sil" style="cursor:hand;cursor:pointer;" value="'.$row_ek["olay_dokuman_id"].'">Sil</span><br></div>';
				}?></td></tr><?php }?>
				
				<tr><th vAlign="top" scope="row" align="left">Dosya</th><td vAlign="top" align="left"><input type="file"   name="files[]" id="file"  multiple/></td></tr>
				
				
			</table>
			
		<textarea  class="ckeditor" name="aciklama" ><?php echo $row['icerik']?></textarea><p><button type="submit" id="upload_button_blue">Güncelle</button>
			
	
		</form>
			<div id="output"></div>
		<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>
	</fieldset>


</div>
</div>

<?php 

	include '../db/mysql_baglanma.php';
	ob_end_flush();
}
else{
	?>
	<div id="personel_ekle">
		<p class="baslik_blue">Olay Güncelle</p>
		<fieldset class="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Olay Seçiniz...!
 		</fieldset>
 		</div>
	<?php 
	
	
	
}
}
else{
	?>
	
		<div id="personel_ekle">
		<p class="baslik_blue">Olay Güncelle</p>		<fieldset class="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Olay Seçiniz...!
 		</fieldset>
 		</div>
	<?php 
}
}
else{?>
		<div id="personel_ekle">
		<p class="baslik_blue">Olay Güncelle</p>		<fieldset class="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Olay Güncellemek İçin Oturum Açınız...!
 		</fieldset>
 		</div>
 		<?php 
}
?>
		