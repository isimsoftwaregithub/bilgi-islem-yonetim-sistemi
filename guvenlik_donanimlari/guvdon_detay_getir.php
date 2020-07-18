 <script type="text/javascript" >
	 $(document).ready(function(){
		  
				
//			$('a').click(function (){
//				alert("asdsadasdasdasd");
//			});
			
		 $("#d_d").find('a').click(function(){
	
			 var id = $(this).attr("id");
			//alert(id);
				$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
				$(".cnt").load(id);
			});
	  
		

	});
	
</script>
<?php
ob_start();

if(isset($_GET["gdid"]))
{	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$where="";
	$sql_guvdon="SELECT
	
	guvdon_adi,
	guvdon_serino,
	guvdon_ip,
	guvdon_notlar,
	aktif
	FROM
	guvenlik_donanimlari
	where guvdon_id=".$_GET["gdid"];
	$result=mysql_query($sql_guvdon,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	$not="";
	if($row['aktif']==0)
	{
		$not="<h2 style='color:red'>Bu güvenlik donanımı artık kullanılmamaktadır</h2>";
	}
	if ($row['guvdon_notlar']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['guvdon_notlar'];
	}


echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;" id="d_d"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['guvdon_adi'].' </td></tr>
 <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Seri No</th><td class="odd" vAlign="top" align="left">'.$row['guvdon_serino'].' </td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">IP</th><td class="even" vAlign="top" align="left">'.$row['guvdon_ip'].' </td></tr>

</table>';
session_start();
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){
		echo '<a title="Güncelle"  class="upload_button_blue" id="index2.php?s=gd_g&gdid='.$_GET["gdid"].'" href="#">Güncelle</a></div>';
	}
}

	
	include '../db/mysql_baglanma.php';
}
else
{
echo "Ağ Elemani Seçiniz";
}







	




			



ob_end_flush();

?>
<!--<tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_turu'].'</br> <a  href=index.php?s='.$s.'&sid='.$sid.' >'.$sbilgi.'</a> </td></tr>-->
