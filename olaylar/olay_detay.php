		
		<script type="text/javascript" src="../js/jquery-1.9.0.js"></script>

<script type="text/javascript" >

function open_popup(href) {

	var url=href;
	//window.showModalDialog(href, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=300px;dialogWidth=650px;dialogLeft=550px;dialogTop=300px;");
	window.open(url, "_blank", 'width=800,height=605,location=no,menubar=no,titlebar=no,status=no,scrollbars=yes,resizable=no,screenX=500,screenY=220,centerscreen=yes');
	//window.showModalDialog(url, "","toolbar=no;location=no;directories=no;status=no;menubar=no;scrollbars=yes;resizable=no;copyhistory=no;dialogHeight=570px;dialogWidth=490px;dialogLeft=400px;dialogTop=200px;");
}
	
	</script>

<script type="text/javascript" >


	 $(document).ready(function()
	{

		 $("#ekler").empty().html('<img src="../images/16x16.gif" /><br />');
		 $("#ekler").load("olay_ek_getir.php?oid="+<?php echo $_GET["oid"]?>);
	 });
	</script>
<link rel="stylesheet" href="css/olay_detay.css" type="text/css"/>

<?php
ob_start();
include '../db/mysql_baglan.php';
$olay_id=$_GET["oid"];
$sql_olay_detay="SELECT o.olay_id,o.baslik, o.icerik ,o.anahtar_kelimeler,o.eklenme_tarihi,u.ad,u.soyad,u.sicilno
	  			 FROM olaylar o LEFT JOIN uyeler u on u.sicilno=o.kisi_id
	  			 WHERE olay_id=".$olay_id;
$result=mysql_query($sql_olay_detay,$link);
$row_olay_detay=mysql_fetch_array($result,MYSQL_BOTH);
$img_guncelle="";
session_start();	
		if( isset($_SESSION['login']))
			{
				
				if($_SESSION['sicilno']==$row_olay_detay["sicilno"]||$_SESSION['login_yetki']=="1")
				{
					$img_guncelle='<img title="Güncelle" src="../images/update.png"/>';
				}
			}
?>
<div id="olay_detay">
<div id="flow">
<p class="baslik_blue">Olay Detay</p>
<table class="olay_detay">
<thead>
<tr><th><?php echo $row_olay_detay["baslik"]?></th><th class="tarih"><?php echo $row_olay_detay["eklenme_tarihi"]?><p style="cursor:hand;cursor:pointer;" class="olay_ozet" onclick="open_popup('olay_guncelle_form.php?oid=<?php echo $row_olay_detay["olay_id"]?>')" ><?php echo $img_guncelle?></p></th></tr>
</thead>
<tbody>
<tr><td class="icrk" ><?php echo $row_olay_detay["icerik"]?></td></tr>
<tr><td class="ekler"><fieldset class="fieldset_blue"><legend class="legend_blue">Ekler</legend><div id="ekler"></div></fieldset></td></tr>
<tr><td class="anahtar">Anahtar Kelimeler ; <?php echo ' '.$row_olay_detay["anahtar_kelimeler"]?></td><td class="kisi"><?php echo $row_olay_detay["ad"].' '.$row_olay_detay["soyad"] ?></td></tr>


</tbody>	

</table>

</div>
</div>
<?php 
include '../db/mysql_baglanma.php';
ob_end_flush();
?>