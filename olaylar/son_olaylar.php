<?php 
ob_start();
include 'db/mysql_baglan.php';
$sql_son_olaylar="SELECT  olay_id,substring(baslik,1,30) as baslik,baslik as title FROM olaylar ORDER BY olay_id  DESC LIMIT 6";
$result=mysql_query($sql_son_olaylar,$link);
$class="odd";
?>
<div id="sonolaylar">
		<p class="baslik_blue">Son Olaylar <a   href="#"  id="index2.php?s=o_e" title=" Yeni Olay (event,hata,problem,çözüm) Ekle"><img src="images/add.png" width="11px" height="11px"/></a></p>
		<table class="sonolaylar"  summary="Son Olaylar">
 			<tbody>
<?php 
		while ($row=mysql_fetch_array($result))
		{
		
				 		echo '<tr class="'.$class.'"><td class="'.$class.'"><a href="#" title="'.$row["title"].'" id="index2.php?s=o_d2&oid='.$row["olay_id"].'">'.$row["baslik"].'...</a></td></tr>';
						if($class=="odd"){
							$class="even";
						}
						else{
							$class="odd";
						}
		}
?>


		   </tbody>
	   </table>
	 
	 	
	 
</div>






<?php 
include 'db/mysql_baglanma.php';
ob_end_flush();

?>