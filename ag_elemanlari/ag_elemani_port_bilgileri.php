<?php


if( isset($_SESSION['login']) ) 
								{
								
include 'db/mysql_baglan.php';		
$sql_ag_elemanlari="SELECT agele_id,agele_adi from ag_elemanlari";
$result_ag_elemanlari=mysql_query($sql_ag_elemanlari);
?>
<script>
	 $(document).ready(function(){
	
			$('#agele_id').change(function(e){
				
				 $("#port_detay_bilgileri").empty().html('<img src="images/16x16.gif" /><br />');
				 $('#port_detay_bilgileri').load("ag_elemanlari/ag_elemanlari_port_detay_getir.php?aid="+$(this).val());
				
				});
			 $("#port_detay_bilgileri").empty().html('<img src="images/16x16.gif" /><br />');
			 $('#port_detay_bilgileri').load("ag_elemanlari/ag_elemanlari_port_detay_getir.php?aid="+$("#agele_id").val());
			$('#agelemani_port_bilgisi_guncelle').on('submit', function(e)
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
	       //$('#agelemani_port_bilgisi_guncelle').resetForm();  // reset form
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		



		    
		 
</script>
<div id="olay">

<p class="baslik_blue">Ağ elemanı port bilgileri</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Ağ elemani port bilgileri</legend>
		
		<form action="ag_elemanlari/agelemani_port_bilgisi_guncelle.php" id="agelemani_port_bilgisi_guncelle" enctype="multipart/form-data" method="post" >
			<table class="olay_ekle">
							<tr><th vAlign="top" scope="row" title="Ağ elemanı adı" align="left">Ağ Elemanı <span class="yıldız_red">*</span></th><td vAlign="top" align="left">
							<select id="agele_id" name="agele_id">
							
							<?php
							while ($row_ag_elemani=mysql_fetch_array($result_ag_elemanlari))
							{
								?>
								<option value="<?php echo $row_ag_elemani['agele_id'];?>"><?php echo $row_ag_elemani['agele_adi']?></option>
								<?php 
							} 
							?> 
							</select></td></tr>
				<tr><td></td></tr>
				<tr><th vAlign="top" scope="row" align="left"></th><td></td></tr>
			</table>
			<div id="port_detay_bilgileri"></div>
			<button type="submit" id="upload_button_blue">Güncelle</button> 
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
		
 <?php 
	}
?>