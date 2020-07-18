 <script>
	 $(document).ready(function(){
		
		   $('#FileUploader').on('submit', function(e)
				    {
			    		 e.preventDefault();
				        $('#upload_button_blue').attr('disabled', ''); // disable upload button
				        //show uploading message
				        $("#output").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Uploading...</span></div>');
				        $(this).ajaxSubmit({
				        target: '#output',
				        success:  afterSuccess //call function after success
				        });
				    });
		   $( "#tabs" ).tabs({
				event: "mouseover"
			});
		   	$( "#tabs" ).hide();
			$(".dl").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Yükleniyor...</span></div>');
			$(".dl").load("yazilimlar/yazilim_listesi_getir.php?tur_id="+$("#st").val());
		   function afterSuccess()
		   {
			   $("#file").empty();
		       $('#FileUploader').resetForm();  // reset form
		       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
		   }

		   $("p").find('a').click(function(){
				 var id = $(this).attr("id");
					alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
 <meta http-equiv="content-language" content="TR"/>
<?php 
$t="";
$yazilim_turu="Tüm Yazılımlar";
if(isset($_GET["t"]))
{
	$t=$_GET["t"];
	if($t==7)
	{
		$yazilim_turu="Paket Yazılımlar";
		
	}
	elseif($t==6)
	{
		$yazilim_turu="Kurumsal Yazılımlar";
		
	}
	elseif($t==5)
	{
		$yazilim_turu="Firma Yazılımlar";
		
	}
elseif($t==5)
	{
		$yazilim_turu="Tüm Yazılımlar";
		
	}
}

?>
<input type="hidden" id="st" name="st" value="<?=$t?>"/>			
<div id="sunucu_listesi">
<p class="baslik_blue"> 
<?php 
echo $yazilim_turu;
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){
	
	echo '<a style="float:right; margin-bottom:0px; font-size:10px;" title="Yeni Yazılım Ekle" href="#" id="index2.php?s=y_e"><img src="images/add.png" width="11px" height="11px"/></a>';
	}
}
?>
</p>
<div id="flow" class="dl">
 

</div>
</div>

<div id="sunucu_listesi_detay">
<p id="p">Yazılım Seçiniz</p>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Özellikler</a></li>
		<li><a href="#tabs-2">Dokümanlar</a></li>
		<li><a href="#tabs-3">Doküman Ekle</a></li>
	</ul>
	<div id="tabs-1">
	
	<?php 
	
//		include 'sunucular/sunucu_detay_getir.php';
	?>

	</div>
	<div id="tabs-2">
	<?php 
//	include 'sunucular/yazilim_listesi_sunucu_detay_getir.php';
	?>
	

	</div>
	<div id="tabs-3">
		
		<?php 	
			include 'yazilimlar/yazilim_kaynak_ekle_form.php';
		?>
	
	</div>
	

	
</div>

</div>
