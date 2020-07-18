<?php


if( isset($_SESSION['login']) ) 
						{
ob_start();		
include 'db/mysql_baglan.php';							
$sql_ag_elemani=" 
	SELECT
	agele_id,
	agele_adi,
	agele_serino,
	agele_marka,
	agele_ip,
	agele_notlar,
	agele_demirbasno,
	agele_port_sayisi,
	agele_hizi,
	agele_turu
	FROM
	ag_elemanlari
	WHERE agele_id=".$_GET["aeid"]."
	; ";

	$row=mysql_fetch_array(mysql_query($sql_ag_elemani));
								
?>
<script>
	 $(document).ready(function(){
			$('#agelemani_guncelle').on('submit', function(e)
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
	       $('#agelemani_ekle').resetForm();  // reset form
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		



		    
		 
</script>
<div id="olay">

<p class="baslik_blue">Ağ Elemanı Güncelle</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Yeni Olay</legend>
		
		<form action="ag_elemanlari/ag_elemani_guncelle.php" id="agelemani_guncelle" enctype="multipart/form-data" method="post" >
		<input type="hidden"  name="agele_id" id="agele_id" value="<?php echo $row['agele_id']?>"/>
		
			<table class="olay_ekle">
			
				<tr><th vAlign="top" scope="row" title="Ağ elemanı adı" align="left">Ağ Eleman Türü <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><select name="agele_turu"> 
				<option value="1" <?=$row['agele_turu'] == '1' ? ' selected="selected"' : '';?> >SAN</option>
				<option value="2" <?=$row['agele_turu'] == '2' ? ' selected="selected"' : '';?>>Ethernet</option></select></td></tr>
				<tr><th vAlign="top" scope="row" title="Ağ elemanı adı" align="left">Adı <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="agele_adi"  size="25" id="adi" maxlength="50" value="<?php echo $row['agele_adi']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Seri No</th><td vAlign="top" align="left"><input  type="text" name="agele_serino"  size="25" maxlength="150" id="agele_serino"  value="<?php echo $row['agele_serino']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Demirbas No</th><td vAlign="top" align="left"><input  type="text" name="agele_demirbasno"  size="25" maxlength="100" id="agele_demirbasno" value="<?php echo $row['agele_demirbasno']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Marka/Model</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="agele_marka"  size="25" maxlength="150" id="agele_marka" value="<?php echo $row['agele_marka']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">IP</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="agele_ip"  size="25" maxlength="150" id="agele_ip" value="<?php echo $row['agele_ip']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Hızı</th><td vAlign="top" align="left"><input maxlength="50"  type="text"  name="agele_hizi"  size="25" maxlength="150" id="agele_hizi" value="<?php echo $row['agele_hizi']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Notlar </th><td vAlign="top" align="left"><textarea rows="8" cols="40" name="agele_notlar" ><?php echo $row['agele_notlar']?></textarea></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Port Sayısı <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input maxlength="3"  type="text"  value="<?php echo $row['agele_port_sayisi']?>" size="5" name="agele_port_sayisi"  onkeypress="isnumber(agele_port_sayisi)"  size="50" maxlength="150" id="agele_port_sayisi" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left"></th><td><button type="submit" id="upload_button_blue">Ekle</button> </td></tr>
			</table>
	
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
 		<legend id="legend_red">Uyarı</legend>Olay Eklemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
include 'db/mysql_baglanma.php';
ob_end_flush();
?>