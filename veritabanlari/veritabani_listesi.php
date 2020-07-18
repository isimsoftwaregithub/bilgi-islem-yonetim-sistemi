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
			$(".dl").load("veritabanlari/veritabani_listesi_getir.php");
		   function afterSuccess()
		   {
			   $("#file").empty();
		       $('#FileUploader').resetForm();  // reset form
		       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
		   }
		   $("p").find('a').click(function(){
				 var id = $(this).attr("id");
				//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

		   $(".link").click(function(){
				 var id = $(this).attr("id");
					id=id+$("#t").val()+"&vl=2";
					//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});
	});
	
</script>

 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
 <meta http-equiv="content-language" content="TR"/>
			
<div id="sunucu_listesi">
<p class="baslik_blue">Veritabanları 
<?php 
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){
	
	echo '<a style="float:right; margin-bottom:0px; font-size:10px;" title="Yeni Veritabanı Ekle" href="#" id="index2.php?s=vt_e"><img src="images/add.png" width="11px" height="11px"/></a>';
	}
}
?>
</p>
<div id="flow" class="dl">
 

</div>
</div>

<div id="sunucu_listesi_detay">
<p id="p">Veritabani Seçiniz</p>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Özellikler</a></li>
		<li><a href="#tabs-2">Dokümanlar</a></li>
		<li><a href="#tabs-3">Doküman Ekle</a></li>
		<li><span title="Bu depolama unitesi ile ilgili olayları listele" class="link" id="index2.php?s=o_g&olay_tip_ara=2&ara=&olay_tip_id=" >Olaylar <img src="images/lnk.png"/></span></li>
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
			include 'veritabanlari/veritabani_kaynak_ekle_form.php';
		?>
	
	</div>
	

	
</div>

</div>
