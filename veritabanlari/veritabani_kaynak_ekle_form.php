<?php 

if( isset($_SESSION['login']) ) {
							
?>
<div id="form">
<div id="theForm">
<fieldset class="fieldset_blue">
<legend class="legend_blue">Doküman ekle</legend>

<form action="veritabanlari/veritabani_kaynak_ekle.php" id="FileUploader" enctype="multipart/form-data" method="post" >
<table>
<tr><th vAlign="top" scope="row" title="Boş Bırakırsanız Dosya Adı Başlık Olarak Alınacaktır." align="left">Başlık</th><td vAlign="top" align="left"><input type="text" title="Boş Bırakırsanız Dosya Adı Başlık Olarak Alınacaktır." name="baslik" class="baslik" size="25" id="baslik" /></td></tr>
<tr><th vAlign="top" scope="row" align="left">Açıklama</th><td vAlign="top" align="left"><input type="text" name="aciklama" class="baslik" size="25" id="aciklama" /></td></tr>
<tr><th vAlign="top" scope="row" align="left">Anahtar Kelimeler</th><td vAlign="top" align="left"><input type="text" name="anahtar_kelime" class="anahtar_kelime" size="25" id="anahtar_kelime" /></td></tr>
<tr><th vAlign="top" scope="row" align="left">Dosya</th><td vAlign="top" align="left"><input type="file"  name="file" id="file" /></td></tr>
<tr><td></td><td><button type="submit" id="upload_button_blue">Yükle</button> </td></tr>
</table>
<div id="output"></div>
<input type="hidden" id="t" name="t" value=""/>


</form>
</fieldset>


</div>
</div>
<!---->
<?php 
	
}
else{
	?>
	<fieldset class="fieldset_blue">
 	<legend id="legend_red">Uyarı</legend>Doküman Eklemek için oturum açınız.	
 	</fieldset>
	 <?php
}
?>
