<script type="text/javascript" >
	 $(document).ready(function(){
		 $('#olay_tip_ara').change(function(){
			
			  if($("#olay_tip_ara").val()=="0" || $("#olay_tip_ara").val()=="8" || $("#olay_tip_ara").val()=="111" ){
			 	$("#olay_tip_id_ara").empty().html('<img src="images/16x16.gif" /><br />');
			 	$("#olay_tip_id_ara").empty();
			  }
			  else{
				 	$("#olay_tip_id_ara").empty().html('<img src="images/16x16.gif" /><br />');
				 	$("#olay_tip_id_ara").load("olaylar/olay_tur_id_getir.php?tip_id="+$("#olay_tip_ara").val());  
			  }
			});
			
});
</script>
<div id="olay_ara">
		<p class="baslik_blue"><img class="img" src="images/search.png"/>Olay Ara</p>
		<div class="index2.php?s=o_g"  title="Olay Ara" id="olay_ekle2" >
					<table class="olay_ara"  summary="Olay Ara">
						<tr><td vAlign="top" align="left"><select name="olay_tip_ara" id="olay_tip_ara">
				<option value="111">Tümü</option>
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
						</td><td><div id="olay_tip_id_ara"></div></td></tr>
						<tr><td vAlign="top" align="left"><input type="text" name="ara" class="ara" size="25" id="ara" /></td></tr>
						<tr><td><button type="submit"  class="upload_button_blue"  title="Olay Ara" id="tx">Ara</button></td></tr>
						
					</table>

		</div>
</div>

<script type="text/javascript" >
		$(document).ready(function(){
			
			$("#tx").click(function(){
				
				var id = $("#olay_ekle2").attr("class");
			//	alert(id);
				var olay_tip_ara=$("#olay_tip_ara").val();
				var olay_tip_id=$("#olay_tip_id2").val();
				var ara=$("#ara").val();
				var datam=id+"&olay_tip_ara="+olay_tip_ara+"&olay_tip_id="+olay_tip_id+"&ara="+ara;
				
				$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
				//alert(datam);
				$(".cnt").load(datam);
//				$.ajax({
//					type: "POST",
//					url: id ,
//					data:datam,
//					success: function(data){
//						$(".cnt").load(data);
//					}
//				});

			});
		});
</script>






<?php 


?>