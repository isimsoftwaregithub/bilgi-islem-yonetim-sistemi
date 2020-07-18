<?php


if( isset($_SESSION['login']) ) 
								{
									
								
?>
<script type="text/javascript" >
	 $(document).ready(function(){

			
			$('#sunucu_arsivle').on('submit', function(e)
				    {
			    			
				        e.preventDefault();
				        $('#olay_ekle_button').attr('disabled', ''); // disable upload button
				        //show uploading message
				        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Lütfen Bekleyin"/> <span>Arşive Gönderiliyor...</span></div>');
				        $(this).ajaxSubmit({
				        target: '#output',
				        success:  afterSuccess //call function after success
				        });
					});

	
	 function afterSuccess()
	   {
	       //$('#olay_ekle').resetForm();  // reset form
	       $('#button_arsivle').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		



		    
		 
</script>


<?php 
ob_start();
include 'db/mysql_baglan.php';
$sql_sunucubilgileri="SELECT 
	sunucu,
	sunucu_gorevi,
	notlar
FROM
	sunucular s
	where s.sunucuID=".$_GET['sid'];
//echo $sql_sunucubilgileri;
$result=mysql_query($sql_sunucubilgileri);
$row=mysql_fetch_array($result);



include 'db/mysql_baglanma.php';
ob_end_flush();

?>
<div id="olay">
<p class="baslik_blue">Sunucu İşlemleri</p>
<div id="theForm">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue"><img src="images/warning.png"/> Sunucu Arşivle</legend>
		
		<form action="sunucular/sunucu_arsivle.php" id="sunucu_arsivle" enctype="multipart/form-data" method="post" >
		<input type="hidden" name="sunucu_id" id="sunucu_id" value="<?php echo $_GET['sid']?>"/>
		
			<table class="sunucu_detay">
				<tr><th>Sunucu</th><td><?php echo $row['sunucu'].' <br/> '. $row['sunucu_gorevi']?></td></tr>
				<tr><th>Notlar</th><td><?php echo $row['notlar']?></td></tr>
				<tr><th>Arsivlenme Sebebi <span class="yıldız_red">*</span></th><td><textarea rows="4" cols="50" name="arsiv_sebebi"></textarea></td></tr>
				
			</table>
		<?php if($_SESSION["login_yetki"]==1){?>
		<h4><img src="images/warning.png"/> Bu Sunucuyla ilgili tüm bilgiler arşive aktarılacak.<br/> Emin misiniz ? 
		<button type="submit"  title="Evet Bu Sunucuyu Arşive Gönder" class="upload_button_blue"  id="button_arsivle">Arşive Gönder</button></h4>
		<?php }
		else{
		ECHO "yetkiniz yok!!!";	
		}
		?>
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
		<p class="baslik_blue"><img class="img" src="images/add.png"/>Sunucu Arşivle</p>
		<fieldset class="fieldset_blue">
 		<legend id="legend_red"><img src="images/warning.png"/></legend>Bu İşlemi Yapmak İçin Oturum Açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>