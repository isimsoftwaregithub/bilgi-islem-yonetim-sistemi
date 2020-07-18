
<div id="hata">
	<fieldset class="fieldset_blue">
 		<legend class="legend_blue"> <img src="images/error.png"/> </legend>Hata Oluştu! <br>
 		<?php 
			if (isset($_GET["hm"])){
				$sayfa = $_GET["hm"];
						switch ($sayfa) {
							case "1":
								echo "Kullanıcı Adı veya Şifre Hatalı !!!";
								break;
							case "2":
								echo "Giriş Yapınız!!!";
							case "3":
								echo "Bu işlemi yapmak için yetkiniz yeterli değil !!!";
							case "4":
								echo "Hatalı Bir İşlem Yaptınız !!!";
							break;
								default:echo "Giriş Yapınız!!!";
						}
					}
					
					
				?>
	
 		 
 	</fieldset>
 	</div>