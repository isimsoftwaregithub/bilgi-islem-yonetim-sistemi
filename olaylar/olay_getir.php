
 <script type="text/javascript" >
	 $(document).ready(function(){
		
			 $(".goback").click(function(){
				 var id = $(this).attr("id");
					//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>
<?php

$olay_tip="111";
$olay_tip_id="0";
$anahtar_kelimeler="";
$link_goback="";
if(isset($_GET["olay_tip_ara"]))
{
	$olay_tip=$_GET["olay_tip_ara"];
}
if(isset($_GET["olay_tip_id"]))
{
	if($_GET["olay_tip_id"]!="undefined"){
	$olay_tip_id=$_GET["olay_tip_id"];
	}
}
if(isset($_GET["ara"]))
{
	$anahtar_kelimeler=$_GET["ara"];
}

if(isset($_GET['su'])){
	
	if(isset($_GET['t'])){
		
		$link_goback='<a href="#" class="goback" id="index2.php?s=s_l&t='.$_GET['t'].'" title="Önceki Sayfaya Geri Dön"><< Önceki Sayfa</a>';
		
	}
}
if(isset($_GET['du'])){
	
	
		
		$link_goback='<a href="#" class="goback" id="index2.php?s=d_l" title="Önceki Sayfaya Geri Dön"><< Önceki Sayfa</a>';
	
}
if(isset($_GET['vl'])){
	
	
		
		$link_goback='<a href="#" class="goback" id="index2.php?s=vt_l" title="Önceki Sayfaya Geri Dön"><< Önceki Sayfa</a>';
	
}
?>

<div id="olay_getir">
<p class="baslik_blue">Olaylar <?php echo $link_goback ?></p>

<iframe id="olay_sonuc" frameborder="no"  scrolling="no" src="olaylar/olay_getir_sonuc.php?olay_tip_ara=<?php echo $olay_tip ?>&olay_tip_id=<?php echo $olay_tip_id ?>&anahtar_kelime=<?php echo $anahtar_kelimeler?>"></iframe>
</div>