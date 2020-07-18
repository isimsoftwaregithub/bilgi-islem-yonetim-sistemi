
<script>
	 $(document).ready(function(){
			
			$('#personelekle').on('submit', function(e)
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
	       $('#personelekle').resetForm();  // reset form
	       $('#upload_button_blue').removeAttr('disabled'); //enable submit button
	   }		  
});
		
		



		    
		 
</script>
<div id="personel_ekle">

<p class="baslik_blue">Personel Yeni Kayıt</p>
<div id="theForm">
	<fieldset id="fieldset_blue">
		<legend id="legend_blue">Yeni Kayıt</legend>
		
		<form action="personel/personel_ekle.php" id="personelekle" enctype="multipart/form-data" method="post" >
			<table class="personel_ekle">
				<tr><th vAlign="top" scope="row" title="Personel Sicil No" align="left">Sicil No <span class="yıldız_red" title="Sicil Numaranızı Giriniz !">*</span></th><td title="Sicil Numaranızı Giriniz !" vAlign="top" align="left"><input title="Sicil Numaranızı Giriniz !" type="text" title="" name="sicilno" class="baslik" size="15" maxlength="4" id="sicilno" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Ad Soyad <span class="yıldız_red" title="Ad Soyad Bilgilerini Giriniz !">*</span></th><td vAlign="top" align="left" title="Ad Soyad Bilgilerini Giriniz !"><input type="text" title="Adınızı Giriniz !" maxlength="50" name="ad" class="ad" size="15" id="ad" />  <input type="text" title="Soyadınızı Giriniz" maxlength="50" name="soyad" class="soyad" size="15" id="soyad" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">E-Posta <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" maxlength="50" name="email" class="email" size="15" id="email" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Şifre <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="password" name="sifre" maxlength="8" class="sifre" size="15" id="sifre" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Görev <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><select name="gorev" id="gorev">				
				<option value="Şube Müdürü">Şube Müdürü</option>
				<option value="Birim Sorumlusu">Birim Sorumlusu</option>
				<option value="Sistem Bakımı">Sistem Bakımı</option>
				<option value="Sistem İşletimi">Sistem İşletimi</option>
				<option value="Sistem Kayıt ve Takip">Sistem Kayıt ve Takip</option>
				<option value="Sistem Yönetimi">Sistem Yönetimi</option>
				<option value="Veri Giriş Operatörü">Veri Giriş Operatörü</option>
				<option value="Veri Giriş Servis Sorumlusu">Veri Giriş Servis Sorumlusu</option>
				</select></td></tr>
				<tr><th vAlign="top" scope="row" align="left">IP 1 <span class="yıldız_red">*</span> / IP2</th><td vAlign="top" align="left"><input type="text" maxlength="15" name="ip1" class="ip1" size="15" id="ip1"  title="IP1" /> / <input type="text" title="IP2" name="ip2" class="ip2" size="15" id="ip2" maxlength="15" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Tel <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" name="tel" maxlength="25" class="sifre" size="15" id="tel" /></td></tr>

				<tr><th vAlign="top" scope="row" align="left"></th><td><button type="submit" id="upload_button_blue">Ekle</button> </td></tr>
			</table>
	
		<div id="output"></div>
				<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>
		</form>
		
	</fieldset>


</div>
</div>
