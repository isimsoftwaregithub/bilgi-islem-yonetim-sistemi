 <script type="text/javascript" >
	 $(document).ready(function(){
		  

		  
			
			 $("#a_d").find('a').click(function(){
		
				 var id = $(this).attr("id");
				//alert(id);
					$(".cnt").empty().html('<img src="images/loader3.gif" /><br />');
					$(".cnt").load(id);
				});

	});
	
</script>
<?php
ob_start();

if(isset($_GET["aid"]))
{	header('Content-Type: text/html; charset=ISO-8859-9');
	include '../db/mysql_baglan.php';
	$where="";
	$sql_agele="SELECT
	agele_adi,
	agele_serino,
	agele_marka,
	agele_ip,
	agele_notlar,
	agele_hizi
	FROM
	ag_elemanlari
	where agele_id=".$_GET["aid"];
	$result=mysql_query($sql_agele,$link);
	$row=mysql_fetch_array($result,MYSQL_BOTH);
	if ($row['agele_notlar']=="")
	{
		$not="Henüz bir not eklenmemiş";
	}
	else{
		$not=$row['agele_notlar'];
	}


echo '		
		<div style="width:100%;height:660px;border:0px;overflow:auto;" id="a_d"> <fieldset class="fieldset_blue">
		 <legend class="legend_blue">Notlar</legend>'.$not.'
	</fieldset> 

 <table class="sunucu_detay"  summary="Sunucu Detay Bilgileri">
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Adı</th><td class="even" vAlign="top" align="left">'.$row['agele_adi'].' </td></tr>
 <tr class="odd"> <th class="odd" vAlign="top" scope="row" align="left">Seri No</th><td class="odd" vAlign="top" align="left">'.$row['agele_serino'].'</td></tr>
 <tr class="even"> <th class="even" vAlign="top" scope="row" align="left">Marka</th><td class="even" vAlign="top" align="left">'.$row['agele_marka'].'</td></tr>
 <tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">IP</th><td class="odd" vAlign="top" align="left">'.$row['agele_ip'].' </td></tr>
 <tr class="even"><th class="even"  vAlign="top" scope="row" align="left">Hızı</th><td class="even" vAlign="top" align="left">'.$row['agele_hizi'].' </td></tr>

</table>';
session_start();
if( isset($_SESSION['login']) ) 
{
	if($_SESSION['login_yetki']=="1"){
	
		echo '<a title="Güncelle"  class="upload_button_blue" id="index2.php?s=ae_g&aeid='.$_GET["aid"].'" href="#">Güncelle</a>';
	}
}
echo '</div>
';
	
	include '../db/mysql_baglanma.php';
}
else
{
echo "Ağ Elemani Seçiniz";
}







	




			



ob_end_flush();

?>
<!--<tr class="odd"><th class="odd"  vAlign="top" scope="row" align="left">Sunucu Türü</th><td class="odd" vAlign="top" align="left">'.$row['sunucu_turu'].'</br> <a  href=index.php?s='.$s.'&sid='.$sid.' >'.$sbilgi.'</a> </td></tr>-->
