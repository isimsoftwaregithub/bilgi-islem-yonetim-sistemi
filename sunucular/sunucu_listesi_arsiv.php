 <script type="text/javascript" >
	 $(document).ready(function(){
		  
		   
		   $( "#tabs" ).tabs({
				
		   		event: "mouseover"
				
				
			});

			  
		  $( "#tabs" ).hide();
		  $(".sl").html('<div style="padding:10px"><img src="images/ajax-loader.gif" alt="Please Wait"/> <span>Yükleniyor...</span></div>');
		   $( ".sl" ).load("sunucular/sunucu_listesi_getir_arsiv.php?tur_id="+$("#st").val());
		 
		  

		  
			
			 $("p").find('a').click(function(){
				 var id = $(this).attr("id");
				//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});
			 $(".link").click(function(){
				 var id = $(this).attr("id");
					id=id+$("#sid").val()+"&su=1&t="+$("#st").val();
				//	alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<meta http-equiv="content-language" content="TR"/>
<?php 
$t="";
$sunucu_tur="Tüm Sunucular";
if(isset($_GET["t"]))
{
	$t=$_GET["t"];
	if($t==3)
	{
		$sunucu_tur="Fiziksel Sunucular";
	}
	elseif($t==2)
	{
		$sunucu_tur="Sanal Sunucular";
	}
	elseif($t==1)
	{
		$sunucu_tur="Sanallaştırma Sunucuları";
	}
	else{
		$sunucu_tur="Tüm Sunucular";
	}
}

?>
<input type="hidden" id="st" name="st" value="<?=$t?>"/>
			
<div id="sunucu_listesi">
<p class="baslik_blue">
<?php echo $sunucu_tur;?></p>
<div id="flow" class="sl">
 
</div>
</div>

<div id="sunucu_listesi_detay">
<p id="p">Sunucu Seçiniz</p>
<div id="tabs">
	<ul >
		<li><a href="#tabs-1">Özellikler</a></li>
		<li><a href="#tabs-2">Yazılımlar</a></li>
		<li><a href="#tabs-3">Dokümanlar</a></li>
		
		<li><span title="Bu sunucu ile ilgili olayları listele" class="link" id="index2.php?s=o_g&olay_tip_ara=1&ara=&olay_tip_id=" >Olaylar <img src="images/lnk.png"/></span></li>
		
	</ul>
	<div id="tabs-1">
	


	</div>
	<div id="tabs-2">

	

	</div>
	<div id="tabs-3">
		

	
	</div>
	

	
</div>

</div>
