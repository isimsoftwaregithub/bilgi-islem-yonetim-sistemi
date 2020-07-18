 		

 			<?php
 			 session_start();
 			 $cntleft=true;
 				if (!isset($_GET["s"])){
							include "dashboard/dash.php";
								
						}
						else{
							$sayfa = $_GET["s"];
						switch ($sayfa) {
							case "i":		
								include "dashboard/dash.php";
								break;
							case "":
								include "dashboard/dash.php";
								break;
						}
					}?>
				<div class="content_right">
					<?php 
					if( isset($_SESSION['login']) ) 
					{
						if (!isset($_GET["s"])){
							$sayfa="s";
						}
						else{
							$sayfa = $_GET["s"];
						switch ($sayfa) {
							case "s_l":
								include "sunucular/sunucu_listesi.php";
								break;
							case "s_e":
								include "sunucular/sunucu_ekle.php";
								break;
							case "s_g": 
								include "sunucular/sunucu_guncelle_form.php";
								break;
							case "s_a": 
								include "sunucular/sunucu_arsivle_form.php";
								break;
							case "s_la": 
								include "sunucular/sunucu_listesi_arsiv.php";
								break;
							case "s_ud": 
								include "sunucular/sunucu_up_down.php";
								break;
							case "o_e":
								include "olaylar/olay_ekle_form.php";
								break;
							case "o_g":
								include "olaylar/olay_getir.php";
								break;
							case "o_gu":
								include "olaylar/olay_guncelle_form.php";
								break;
							case "k_l":
								include "kaynaklar/kaynak_listesi.php";
								break;
							case "o_d":
								include 'olaylar/olay_detay.php';
								break;
							case "o_d2":
								include 'olaylar/olay_detay2.php';
								break;
							case "h_s":
								include "hata/hata.php";
								break;
							case "p_e":
								include "personel/personel_ekle_form.php";
								break;
							case "y_p":
								include "personel/personel_yeni_kayit.php";
								break;
							case "p_l":
								include "personel/personel_listesi.php";
								break;
							case "p_la":
								include "personel/personel_listesi_ayrilan.php";
								break;
							case "p_g":
								include "personel/personel_guncelle_form.php";
								break;
							case "p_g2":
								include "personel/personel_guncelle_form2.php";
								break;
							case "d_l":
								include "depolama_uniteleri/depuni_listesi.php";
								break;
								case "du_la":
								include "depolama_uniteleri/depuni_listesi_arsiv.php";
								break;
							case "du_e":
								include "depolama_uniteleri/yeni_depolama_unitesi_form.php";
								break;
							case "du_g":
								include "depolama_uniteleri/depolama_unitesi_guncelle_form.php";
								break;
							case "vt_l":
								include "veritabanlari/veritabani_listesi.php";
								break;
							case "a_e":
								include "ag_elemanlari/agelemani_listesi.php";
								break;
							case "ya_e":
								include "ag_elemanlari/yeni_ag_elemani_form.php";
								break;
							case "ae_g":
								include "ag_elemanlari/ag_elemani_guncelle_form.php";
								break;
							case "a_ep":
								include "ag_elemanlari/ag_elemani_port_bilgileri.php";
								break;
							case "gd_l":
								include "guvenlik_donanimlari/guvdon_listesi.php";
								break;
							case "gd_e":
								include "guvenlik_donanimlari/yeni_guvenlik_donanimi_form.php";
								break;
							case "gd_g":
								include "guvenlik_donanimlari/guvdon_guncelle_form.php";
								break;
							case "y_l":
								include "yazilimlar/yazilim_listesi.php";
								break;
							case "y_e":
								include "yazilimlar/yazilim_ekle_form.php";
								break;
							case "s_r":
								include "raporlar/sunucu_rapor.php";
								//$cntleft=false;
								break;
							case "vt_r":
								include "raporlar/veritabani_rapor.php";
								//$cntleft=false;
								break;
							case "ae_r":
								include "raporlar/ag_elemani_rapor.php";
								//$cntleft=false;
								break;
							case "f_e":
								include "firmalar/yeni_firma_ekle_form.php";
								break;
							case "fc_e":
								include "firmalar/yeni_firma_calisani_form.php";
								break;
							case "vc_s":
								include "sanallastirma/sanal_sunucular.php";
								break;
							case "ga_s":
								include "sanallastirma/get_all_sanal.php";
								break;
							case "i":
									break;
							default:
								include "hata/hata.php";
							break;	
						}
					}
				
				
					
				?>
 		</div>
 		
 		<?php 
 		if($cntleft)
			{
				?>
 		<div class="content_left" id="left">
		
		<?php
				if (!isset($_GET["s"]))
				{
							$sayfa="s";
				}
				else
				{
					if($_GET["s"]!="i")
					{
						
						if($_GET["s"]!="r"){
						
						if($_GET["s"]=="s_l"||$_GET["s"]=="s_g"||$_GET["s"]=="s_e")
						{
							include "sunucular/sunucu_listesi_sol_frame.php";
						}
						elseif($_GET["s"]=="y_l"||$_GET["s"]=="y_g"||$_GET["s"]=="y_e")
						{
							include 'yazilimlar/yazilim_listesi_sol_frame.php';
						}
						
						include_once 'olaylar/son_olaylar.php';	
						include "olaylar/olay_ara.php";
						}
					}		
						
				}
			}
					}
			 else{
					if (isset($_GET["s"])){
							if($_GET["s"]=="i")
							{
									
							}
							else {
								if($_GET["s"]!=""){
							?>
							<div id="hata">
							<fieldset class="fieldset_blue">
					 		<legend id="legend_red"><img src="images/error.png"/></legend>Giriş Yapınız<br/>
							</fieldset>
							</div>
							<?php 
								}
							}
								
						}
					
					?>
				
					
					<?php 
					
					}
					?>
					

 	
 		</div>
 		<?php 
				
					
 		
 		?>


 <script type="text/javascript" >
	$(document).ready(function(){
		$("#left").find('a').click(function(){
			var id = $(this).attr("id");
			$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
			$(".cnt").load(id);
		});
		
		
		
	});
</script>