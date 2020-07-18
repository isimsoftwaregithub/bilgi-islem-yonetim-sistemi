<link rel="stylesheet" href="../personel/css/personel_guncelle.css" type="text/css"/>

<?php

session_start();
if( isset($_SESSION['login']) ) 
{?>
		

<?php
	ob_start();

if(isset($_GET["uid"]))
{
	if($_GET["uid"]!=""){
		
		?>
			
		<?php 
		if($_SESSION['login_yetki']==1||$_SESSION['sicilno']==$_GET["uid"])
		{
			?>
			
			
			<?php 
		}	
		else{
			?>

			<?php
		}
	
	include '../db/mysql_baglan.php';
	$sql_personel="SELECT uye_id, sicilno,ad,soyad,email,sifre,ip1,ip2,yetki_id,aktif,gorev,tel,ayrilma_sebebi FROM uyeler WHERE sicilno='".$_GET["uid"]."';";
	$result=mysql_query($sql_personel,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
?>
<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>
<script>
	 $(document).ready(function(){
			
			

			if($("#aktif").val()=="0"){
				$("#ayrilma_sebebi").show();
			}else{
				$("#ayrilma_sebebi").hide();
			}

			$('#aktif').change(function(){
				
				if($("#aktif").val()=="0"){
					$("#ayrilma_sebebi").show();
				}else{
					$("#ayrilma_sebebi").hide();
				}
			});
	
			
			  
});
		
		



		    
		 
</script>
<div id="personel_guncelle">

<p class="baslik_blue">Personel Güncelle</p>
<div id="form">
	<fieldset class="fieldset_blue">
		<legend class="legend_blue">Bilgiler</legend>
		
		<form action="personel_guncelle.php" id="personelguncelle" enctype="multipart/form-data" method="post" >
		<input type="hidden" name="uyeid" value="<?php echo $row['uye_id']?>"/>
			<table class="personel_guncelle">
				<tr><th vAlign="top" scope="row" title="Personel Sicil No" align="left">Sicil No <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="" name="sicilno" class="baslik" size="20" maxlength="4" id="sicilno" value="<?php echo $row['sicilno']?>" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Ad Soyad <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" title="Ad" maxlength="50" name="ad" class="ad" size="20" id="ad" value="<?php echo $row['ad']?>" />  <input type="text" title="Soyad"  maxlength="50" name="soyad" class="soyad" size="20" id="soyad" value="<?php echo $row['soyad']?>" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Şifre <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="password" name="sifre" maxlength="8" class="sifre" size="20" id="sifre" value="<?php echo $row['sifre']?>" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left">E-Posta <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" maxlength="50" name="email" class="email" size="20" id="email" value="<?php echo $row['email']?>"/></td></tr>
				<?php if($_SESSION['login_yetki']==1){?>	
				<tr><th vAlign="top" scope="row" align="left">Görev <span class="yıldız_red">*</span></th><td vAlign="top" align="left">
				<select name="gorev" id="gorev">			
				<option value="Şube Müdürü" <?=$row['gorev'] == 'Şube Müdürü' ? ' selected="selected"' : '';?> >Şube Müdürü</option>
				<option value="Birim Sorumlusu" <?=$row['gorev'] == 'Birim Sorumlusu' ? ' selected="selected"' : '';?>>Birim Sorumlusu</option>
				<option value="Sistem Bakımı" <?=$row['gorev'] == 'Sistem Bakımı' ? ' selected="selected"' : '';?>>Sistem Bakımı</option>
				<option value="Sistem İşletimi" <?=$row['gorev'] == 'Sistem İşletimi' ? ' selected="selected"' : '';?>>Sistem İşletimi</option>
				<option value="Sistem Kayıt ve Takip" <?=$row['gorev'] == 'Sistem Kayıt ve Takip' ? ' selected="selected"' : '';?>>Sistem Kayıt ve Takip</option>
				<option value="Sistem Yönetimi" <?=$row['gorev'] == 'Sistem Yönetimi' ? ' selected="selected"' : '';?>>Sistem Yönetimi</option>
				<option value="Veri Giriş Operatörü" <?=$row['gorev'] == 'Veri Giriş Operatörü' ? ' selected="selected"' : '';?>>Veri Giriş Operatörü</option>
				<option value="Veri Giriş Servis Sorumlusu" <?=$row['gorev'] == 'Veri Giriş Servis Sorumlusu' ? ' selected="selected"' : '';?>>Veri Giriş Servis Sorumlusu</option>
				</select></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Yetki <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><select name="yetki" id="yetki">
				<option value="2" <?=$row['yetki_id'] == '2' ? ' selected="selected"' : '';?>>User</option>
				<option value="1" <?=$row['yetki_id'] == '1' ? ' selected="selected"' : '';?>>Admin</option>
				</select>
				</td></tr>
				<tr><th vAlign="top" scope="row" align="left">Aktif <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><select name="aktif" id="aktif">
				<option value="1" <?=$row['aktif'] == '1' ? ' selected="selected"' : '';?>>Evet</option>
				<option value="0" <?=$row['aktif'] == '0' ? ' selected="selected"' : '';?>>Hayır</option>
				</select>
				<select name="ayrilma_sebebi" id="ayrilma_sebebi">
				<option value="1" <?=$row['ayrilma_sebebi'] == '1' ? ' selected="selected"' : '';?>>Birim Değişikliği</option>
				<option value="2" <?=$row['ayrilma_sebebi'] == '2' ? ' selected="selected"' : '';?>>Kurum Değişikliği</option>
				<option value="3" <?=$row['ayrilma_sebebi'] == '3' ? ' selected="selected"' : '';?>>Emekliye Ayrılma</option>
				</select>
				</td></tr>
				<?php }?>
				<tr><th vAlign="top" scope="row" align="left">IP 1 <span class="yıldız_red">*</span> / IP2</th><td vAlign="top" align="left"><input type="text" maxlength="15" name="ip1" class="ip1" size="20" id="ip1"  title="IP1" value="<?php echo $row['ip1']?>"/> / <input type="text" title="IP2" name="ip2" class="ip2" size="20" id="ip2" maxlength="15" value="<?php echo $row['ip2']?>"/></td></tr>
				<tr><th vAlign="top" scope="row" align="left">Tel <span class="yıldız_red">*</span></th><td vAlign="top" align="left"><input type="text" name="tel" maxlength="25" class="tel" size="20" id="tel" value="<?php echo $row['tel']?>" /></td></tr>
				<tr><th vAlign="top" scope="row" align="left"></th><td><button type="submit" class="upload_button_blue">Güncelle</button> </td></tr>
			</table>
					
		
		<div id="output"></div>
		<p class="not"><span class="yıldız_red">*</span> : Zorunlu Alan</p>
		</form>
		
	</fieldset>
	<?php 
 		$link_sam = odbc_connect("insankaynaklari", "firtina", "sam06yeli28");
 		$sql_sam="SELECT g.emeklisicilno as 'Emekli Sicilno', s.kazanilmisderece as 'Derece',s.kazanilmiskademe as 'Kademe',s.kazanilmisekgosterge as 'Ek Gösterge' from INSANKAYNAKLARI..sicilozetinewtbl s
					LEFT JOIN INSANKAYNAKLARI..genelbilgilertbl g on  g.sicilno=s.sicilno
					WHERE cid=(SELECT max(cid) from INSANKAYNAKLARI..sicilozetinewtbl s where s.sicilno=".$_GET["uid"].") and s.sicilno=".$_GET["uid"].";
 		"; 
 		$result_1 = odbc_exec($link_sam, $sql_sam) ; 
 		?>
 		<div style="float:left;font-size:11px;">
 		<?php 
 		odbc_result_all($result_1,'class=""');
 		odbc_close_all(); 
	?>
	</div>
</div>
</div>
<!---->
<?php 
	
include '../db/mysql_baglanma.php';
ob_end_flush();
}
else{?>
	<div id="personel_ekle">
		<p class="baslik_blue">Personel Güncelle</p>
		<fieldset id="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Personel Seçiniz !!!
 		</fieldset>
 		</div>
 		<?php 
}
}
else{
	
	?>
	<div id="personel_ekle">
		<p class="baslik_blue">Personel Güncelle</p>
		<fieldset id="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Personel Seçiniz !!!
 		</fieldset>
 		</div>
	<?php 
}
}
else{
		?>
		<div id="personel_ekle">
		<p class="baslik_blue">Personel Güncelle</p>
		<fieldset id="fieldset_blue">
 		<legend id="legend_red">Uyarı</legend>Personel Güncellemek için oturum açınız.	
 		</fieldset>
 		</div>
 <?php 
	}
?>